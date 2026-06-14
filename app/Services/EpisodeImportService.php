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

    protected bool $videoCdnEnabled = true;

    protected bool $allAnimeEnabled = true;

    protected bool $externalPlayersEnabled = true;

    protected bool $onlyMissing = false;

    protected VideoCdnService $videoCdnService;

    protected AnilibriaService $anilibriaService;

    protected KodikService $kodikService;

    protected EpisodeLookupMetadataService $metadataService;

    protected ExternalPlayerService $externalPlayerService;

    protected AllAnimeService $allAnimeService;

    protected SettingService $settings;

    public function __construct(
        VideoCdnService $videoCdnService,
        AnilibriaService $anilibriaService,
        KodikService $kodikService,
        EpisodeLookupMetadataService $metadataService,
        ExternalPlayerService $externalPlayerService,
        AllAnimeService $allAnimeService,
        SettingService $settings
    ) {
        $this->videoCdnService = $videoCdnService;
        $this->anilibriaService = $anilibriaService;
        $this->kodikService = $kodikService;
        $this->metadataService = $metadataService;
        $this->externalPlayerService = $externalPlayerService;
        $this->allAnimeService = $allAnimeService;
        $this->settings = $settings;
    }

    public function setAvailableSources(bool $anilibria, bool $kodik): void
    {
        $this->anilibriaEnabled = $anilibria;
        $this->kodikEnabled = $kodik;
    }

    public function setFallbackSources(bool $videoCdn, bool $allAnime, bool $externalPlayers): void
    {
        $this->videoCdnEnabled = $videoCdn;
        $this->allAnimeEnabled = $allAnime;
        $this->externalPlayersEnabled = $externalPlayers;
    }

    public function setOnlyMissing(bool $onlyMissing): void
    {
        $this->onlyMissing = $onlyMissing;
    }

    public function forceEnableAllAnime(): void
    {
        $this->allAnimeService->forceEnable();
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
            $titleCandidates = $this->metadataService->titleCandidates($anime);

            // PRIORITY 1: Anilibria (No ads, HLS, internal player)
            if ($this->anilibriaEnabled) {
                if ($anime->anilibria_id) {
                    $episodes = $this->anilibriaService->getEpisodes((int) $anime->anilibria_id);
                } else {
                    $found = null;
                    foreach ($titleCandidates as $candidateTitle) {
                        $found = $this->anilibriaService->findByTitle($candidateTitle, null);
                        if ($found) {
                            break;
                        }
                    }
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
                    : $this->kodikService->searchByTitles($titleCandidates, $anime->year, $anime->type);

                if (empty($kodikData) && $anime->shikimori_id) {
                    $kodikData = $this->kodikService->searchByTitles($titleCandidates, $anime->year, $anime->type);
                }

                if (! empty($kodikData)) {
                    $episodes = array_merge($episodes, $this->collectKodikEpisodes($kodikData));
                }
            }

            // PRIORITY 3: VideoCDN (Last resort)
            if ($this->videoCdnEnabled && empty($episodes)) {
                $episodes = $this->fetchFromVideoCdn($anime);
            }

            // PRIORITY 4: AllAnime fallback based on ani-cli scraping flow.
            // Disabled by default via ALLANIME_ENABLED=false because direct HLS links may break/CORS-block.
            if ($this->allAnimeEnabled && empty($episodes)) {
                $episodes = $this->allAnimeService->getEpisodesForAnime($anime, $titleCandidates);
            }

            // PRIORITY 5: Configured iframe aggregators / no-name voiceovers.
            // Disabled by default until URL templates are configured by admin.
            if ($this->externalPlayersEnabled && empty($episodes)) {
                $episodes = $this->externalPlayerService->getEpisodes($anime, $titleCandidates);
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

        // Do not use chunk() here: Laravel's chunk pagination applies its own
        // offset/limit for every page and can override the batch offset above.
        // The scheduled importer relies on a cursor offset, so load exactly the
        // requested batch and process it deterministically.
        $query->orderBy('id', 'asc')->get()->each(function (Anime $anime) use ($update) {
            $this->importForSingleAnime($anime, $update);
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

        return $this->videoCdnService->getEpisodesByTitles($this->metadataService->titleCandidates($anime), $anime->year, $anime->type);
    }

    protected function collectKodikEpisodes(array $kodikData): array
    {
        $settings = $this->settings->all();
        $importAllTranslations = (bool) ($settings['episodes.import_all_translations'] ?? true);
        $maxTranslations = max(0, (int) ($settings['episodes.max_kodik_translations'] ?? 25));
        $includeSubtitles = (bool) ($settings['episodes.include_kodik_subtitles'] ?? true);
        $preferredTranslators = is_array($settings['episodes.preferred_translators'] ?? null)
            ? $settings['episodes.preferred_translators']
            : [];

        $target = $kodikData[0] ?? [];
        $targetShikimoriId = $target['shikimori_id'] ?? null;
        $targetTitle = mb_strtolower(trim($target['title'] ?? $target['title_orig'] ?? ''));

        $sameAnime = array_values(array_filter($kodikData, function (array $kodikResult) use ($targetShikimoriId, $targetTitle) {
            $currentShiki = $kodikResult['shikimori_id'] ?? null;
            $currentTitle = mb_strtolower(trim($kodikResult['title'] ?? $kodikResult['title_orig'] ?? ''));

            if ($targetShikimoriId && $currentShiki) {
                return (string) $currentShiki === (string) $targetShikimoriId;
            }

            return $currentTitle !== '' && $currentTitle === $targetTitle;
        }));

        $sameAnime = array_values(array_filter($sameAnime, function (array $kodikResult) use ($includeSubtitles) {
            $type = $kodikResult['translation']['type'] ?? 'voice';

            return $includeSubtitles || $type !== 'subtitles';
        }));

        usort($sameAnime, function (array $a, array $b) use ($preferredTranslators) {
            $aTranslator = cloneKodikTranslator($a['translation'] ?? []);
            $bTranslator = cloneKodikTranslator($b['translation'] ?? []);
            $aPreferred = $this->translatorPriority($aTranslator, $preferredTranslators);
            $bPreferred = $this->translatorPriority($bTranslator, $preferredTranslators);

            if ($aPreferred !== $bPreferred) {
                return $aPreferred <=> $bPreferred;
            }

            return $this->countKodikEpisodes($b) <=> $this->countKodikEpisodes($a);
        });

        if (! $importAllTranslations) {
            $sameAnime = array_slice($sameAnime, 0, 1);
        } elseif ($maxTranslations > 0) {
            $sameAnime = array_slice($sameAnime, 0, $maxTranslations);
        }

        $episodes = [];
        foreach ($sameAnime as $index => $kodikResult) {
            $episodes = array_merge($episodes, $this->formatKodikEpisodes($kodikResult, 5 + $index));
        }

        return $episodes;
    }

    private function translatorPriority(string $translator, array $preferredTranslators): int
    {
        foreach ($preferredTranslators as $index => $preferred) {
            if (mb_strtolower($translator) === mb_strtolower((string) $preferred)) {
                return $index;
            }
        }

        return 999;
    }

    private function countKodikEpisodes(array $animeData): int
    {
        $count = 0;
        foreach (($animeData['seasons'] ?? []) as $seasonData) {
            $count += count($seasonData['episodes'] ?? []);
        }

        return $count ?: (! empty($animeData['link']) ? 1 : 0);
    }

    protected function formatKodikEpisodes(array $animeData, int $priority = 5): array
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
                    'priority' => $priority, // Lower than AniLibria, higher than VideoCDN/external.
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
                'priority' => $priority,
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
                        ->when($source, fn ($query) => $query->where('source', $source))
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
