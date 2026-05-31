<?php

namespace App\Services;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Support\Facades\Log;

class EpisodeImportService
{
    public int $processed = 0;

    public int $created = 0;

    public int $updated = 0;

    public int $skipped = 0;

    public int $errors = 0;

    protected float $startTime;

    protected bool $anilibriaEnabled = true;

    protected bool $kodikEnabled = true;

    protected bool $onlyMissing = false;

    protected VideoCdnService $videoCdnService;

    protected AnilibriaService $anilibriaService;

    protected KodikService $kodikService;

    public function __construct(
        VideoCdnService $videoCdnService,
        AnilibriaService $anilibriaService,
        KodikService $kodikService
    ) {
        $this->videoCdnService = $videoCdnService;
        $this->anilibriaService = $anilibriaService;
        $this->kodikService = $kodikService;
    }

    public function setAvailableSources(bool $anilibria, bool $kodik): void
    {
        $this->anilibriaEnabled = $anilibria;
        $this->kodikEnabled = $kodik;
    }

    public function setOnlyMissing(bool $onlyMissing): void
    {
        $this->onlyMissing = $onlyMissing;
    }

    /**
     * Reset (delete) episodes from the database.
     *
     * @return int Number of deleted episodes
     */
    public function resetEpisodes(?string $source = null): int
    {
        if ($source) {
            return Episode::where('source', $source)->delete();
        }

        $count = Episode::count();
        Episode::truncate();

        return $count;
    }

    public function importForSingleAnime(Anime $anime, bool $update = false): void
    {
        try {
            // Skip anime that already have episodes when --only-missing is set
            if ($this->onlyMissing && $anime->episodes()->exists()) {
                $this->skipped++;
                $this->processed++;

                return;
            }

            $episodes = [];

            // PRIORITY 1: Anilibria (No ads, HLS, internal player)
            if ($this->anilibriaEnabled) {
                if ($anime->anilibria_id) {
                    $episodes = $this->anilibriaService->getEpisodes((int) $anime->anilibria_id);
                } else {
                    $found = $this->anilibriaService->findByTitle($anime->title, $anime->title_en);
                    if ($found) {
                        $anime->update(['anilibria_id' => $found['id']]);
                        $episodes = $this->anilibriaService->getEpisodes((int) $found['id']);
                    }
                }
            }

            // PRIORITY 2: Kodik (Broad coverage, requires premium for no ads)
            if ($this->kodikEnabled && empty($episodes)) {
                $kodikData = $anime->shikimori_id
                    ? $this->kodikService->searchByShikimoriId($anime->shikimori_id)
                    : $this->kodikService->searchByTitle($anime->title);
                if (! empty($kodikData)) {
                    // To prevent franchise mish-mash (e.g. Naruto mixed with Boruto or Shippuden),
                    // we must enforce that all processed Kodik translations belong to the exact same anime entity.
                    $targetShikimoriId = $kodikData[0]['shikimori_id'] ?? null;
                    $targetTitle = mb_strtolower(trim($kodikData[0]['title'] ?? $kodikData[0]['title_orig'] ?? ''));

                    // Process ALL Kodik results (different translations/dubs) that belong to the SAME anime
                    foreach ($kodikData as $kodikResult) {
                        $currentShiki = $kodikResult['shikimori_id'] ?? null;
                        $currentTitle = mb_strtolower(trim($kodikResult['title'] ?? $kodikResult['title_orig'] ?? ''));

                        $isSameAnime = false;
                        if ($targetShikimoriId && $currentShiki) {
                            $isSameAnime = ((string) $currentShiki === (string) $targetShikimoriId);
                        } else {
                            $isSameAnime = ($currentTitle === $targetTitle);
                        }

                        if ($isSameAnime) {
                            $kodikEpisodes = $this->formatKodikEpisodes($kodikResult);
                            $episodes = array_merge($episodes, $kodikEpisodes);
                        }
                    }
                }
            }

            // PRIORITY 3: VideoCDN (Last resort)
            if (empty($episodes)) {
                $episodes = $this->fetchFromVideoCdn($anime);
            }

            // Persistence
            if (empty($episodes)) {
                $this->skipped++;
            } else {
                $this->storeEpisodes($anime, $episodes, $update);
            }

            $this->processed++;
        } catch (\Throwable $e) {
            $this->errors++;
            dump([
                'anime_id' => $anime->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => collect(explode("\n", $e->getTraceAsString()))->take(5)->toArray(),
            ]);
            Log::error('Episode import error', [
                'anime_id' => $anime->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public function import(bool $update = false, ?int $limit = null, int $offset = 0): void
    {
        $this->startTime = microtime(true);
        $query = Anime::query();

        if ($offset > 0) {
            $query->offset($offset);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        $processedLocal = 0;

        $query->orderBy('id', 'asc')->chunk(100, function ($animes) use (&$processedLocal, $update) {
            foreach ($animes as $anime) {
                $processedLocal++;
                $this->importForSingleAnime($anime, $update);
            }
        });

        $this->printStats();
    }

    protected function fetchFromVideoCdn(Anime $anime): array
    {
        if ($anime->shikimori_id) {
            $episodes = $this->videoCdnService->getEpisodesByShikimoriId($anime->shikimori_id);
            if (! empty($episodes)) {
                return $episodes;
            }
        }

        return $this->videoCdnService->getEpisodesByTitle($anime->title);
    }

    protected function formatKodikEpisodes(array $animeData): array
    {
        $episodes = [];
        $seasons = $animeData['seasons'] ?? [];

        foreach ($seasons as $seasonNumber => $seasonData) {
            $episodesData = $seasonData['episodes'] ?? [];

            foreach ($episodesData as $episodeNumber => $link) {
                // Ensure HTTPS explicitly, as Next.js iframe requires it
                if (str_starts_with($link, '//')) {
                    $link = 'https:'.$link;
                }

                $link = $this->kodikService->buildPlayerUrl($link);

                $episodes[] = [
                    'episode_number' => (int) $episodeNumber,
                    'season_number' => (int) $seasonNumber,
                    'title' => $animeData['material_data']['title'] ?? "Серия {$episodeNumber}",
                    'player_iframe' => "<iframe src=\"{$link}\" frameborder=\"0\" allowfullscreen></iframe>",
                    'player_url' => $link, // Keep it for backwards compatibility and fallback
                    'external_id' => $animeData['id'] ?? null,
                    'source' => 'kodik',
                    'translator' => cloneKodikTranslator($animeData['translation'] ?? []),
                    'translation_type' => $animeData['translation']['type'] ?? 'voice',
                    'quality' => 'auto',
                    'priority' => 5, // Medium priority, lower than Anilibria but higher than VideoCdn
                ];
            }
        }

        // Sometimes kodik returns a movie with single link:
        if (empty($episodes) && isset($animeData['link'])) {
            $link = str_starts_with($animeData['link'], '//') ? 'https:'.$animeData['link'] : $animeData['link'];
            $episodes[] = [
                'episode_number' => 1,
                'season_number' => 1,
                'title' => $animeData['material_data']['title'] ?? 'Фильм',
                'player_iframe' => "<iframe src=\"{$link}\" frameborder=\"0\" allowfullscreen></iframe>",
                'player_url' => $link,
                'external_id' => $animeData['id'] ?? null,
                'source' => 'kodik',
                'translator' => cloneKodikTranslator($animeData['translation'] ?? []),
                'translation_type' => $animeData['translation']['type'] ?? 'voice',
                'quality' => 'auto',
                'priority' => 5,
            ];
        }

        return $episodes;
    }

    protected function storeEpisodes(Anime $anime, array $episodes, bool $update): void
    {
        foreach ($episodes as $data) {
            try {
                $episodeData = array_merge(['anime_id' => $anime->id], $data);

                $source = $data['source'] ?? null;
                $translator = $data['translator'] ?? ($data['translation_name'] ?? null);

                // Idempotent matching: anime + source + season + episode + translator.
                // Fallback to anime + episode + translator for legacy rows without source/season.
                $existingQuery = Episode::where('anime_id', $anime->id)
                    ->where('episode_number', $data['episode_number']);

                if (isset($data['season_number'])) {
                    $existingQuery->where('season_number', $data['season_number']);
                }

                if ($source) {
                    $existingQuery->where('source', $source);
                }

                if ($translator) {
                    $existingQuery->where('translator', $translator);
                }

                $existing = $existingQuery->first();

                if ($existing) {
                    if ($update) {
                        $existing->update($episodeData);
                        $this->updated++;
                    } else {
                        $this->skipped++;
                    }
                } else {
                    // Last guard against duplicates caused by older imports with missing source/season.
                    $legacyDuplicate = Episode::where('anime_id', $anime->id)
                        ->where('episode_number', $data['episode_number'])
                        ->when($translator, fn ($query) => $query->where('translator', $translator))
                        ->first();

                    if ($legacyDuplicate) {
                        if ($update) {
                            $legacyDuplicate->update($episodeData);
                            $this->updated++;
                        } else {
                            $this->skipped++;
                        }
                    } else {
                        Episode::create($episodeData);
                        $this->created++;
                    }
                }
            } catch (\Throwable $e) {
                $this->errors++;
                Log::error('Episode store error', ['error' => $e->getMessage(), 'data' => $data]);
            }
        }
    }

    protected function normalizeTitle(string $title): string
    {
        $title = preg_replace('/[^\p{L}\p{N}\s\-]/u', '', $title);

        return trim(preg_replace('/\s+/', ' ', $title));
    }

    protected function printStats(): void
    {
        $duration = round(microtime(true) - $this->startTime, 2);
        Log::info("Import stats: Processed: {$this->processed}, Created: {$this->created}, Updated: {$this->updated}, Skipped: {$this->skipped}, Duration: {$duration}s");
    }
}

function cloneKodikTranslator($t)
{
    return $t['title'] ?? 'Kodik';
}
