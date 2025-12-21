<?php

namespace App\Services;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EpisodeImportService
{
    protected string $kodikUrl = 'https://kodikapi.com/search';

    protected ?string $kodikToken;

    protected string $anilibriaUrl = 'https://api.anilibria.tv/v3/title';

    public int $processed = 0;

    public int $created = 0;

    public int $updated = 0;

    public int $skipped = 0;

    public int $errors = 0;

    protected float $startTime;

    public function __construct()
    {
        $this->kodikToken = config('services.kodik.token');
    }

    public function importForSingleAnime(Anime $anime, bool $update = false): void
    {
        try {
            $episodes = [];

            if ($anime->shikimori_id) {
                $episodes = $this->fetchFromKodikByShikimori($anime);
            }

            if (empty($episodes)) {
                $episodes = $this->fetchFromKodik($anime);
            }

            if (empty($episodes)) {
                $episodes = $this->fetchFromAniLibria($anime);
            }

            if (empty($episodes)) {
                $this->skipped++;
            } else {
                $this->storeEpisodes($anime, $episodes, $update);
            }

            $this->processed++;
        } catch (\Throwable $e) {
            $this->errors++;
            Log::error('Episode import error', [
                'anime_id' => $anime->id,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function import(bool $update = false, ?int $limit = null): void
    {
        $this->startTime = microtime(true);
        $query = Anime::query();

        if ($limit !== null) {
            $query->limit($limit);
        }

        $total = $query->count();
        $processedLocal = 0;

        $query->orderBy('id')->chunk(100, function ($animes) use (&$processedLocal, $update) {
            foreach ($animes as $anime) {
                $processedLocal++;
                $this->importForSingleAnime($anime, $update);
            }
        });

        $this->printStats();
    }

    protected function fetchFromKodikByShikimori(Anime $anime): array
    {
        if (! $this->kodikToken || ! $anime->shikimori_id) {
            return [];
        }

        $response = Http::timeout(30)
            ->retry(3, 500)
            ->get($this->kodikUrl, [
                'token' => $this->kodikToken,
                'shikimori_id' => $anime->shikimori_id,
                'with_episodes' => 'true',
                'with_material_data' => 'true',
            ]);

        if (! $response->ok()) {
            return [];
        }

        $results = $response->json('results') ?? [];

        return $this->parseKodikResults($results);
    }

    protected function fetchFromKodik(Anime $anime): array
    {
        if (! $this->kodikToken) {
            return [];
        }

        $title = $this->normalizeTitle($anime->title);

        $response = Http::timeout(30)
            ->retry(3, 500)
            ->get($this->kodikUrl, [
                'token' => $this->kodikToken,
                'title' => $title,
                'types' => 'anime,anime-serial',
                'with_episodes' => 'true',
                'limit' => 5,
            ]);

        if (! $response->ok()) {
            return [];
        }

        $results = $response->json('results') ?? [];

        return $this->parseKodikResults($results);
    }

    private function parseKodikResults(array $results): array
    {
        $episodes = [];
        foreach ($results as $result) {
            if (! isset($result['seasons'])) {
                continue;
            }

            foreach ($result['seasons'] as $seasonNum => $seasonData) {
                foreach ($seasonData['episodes'] as $epNum => $link) {
                    $episodes[] = [
                        'episode_number' => (int) $epNum,
                        'season_number' => (int) $seasonNum,
                        'title' => $result['material_data']['title'] ?? "Серия {$epNum}",
                        'player_url' => $link,
                        'external_id' => $result['id'],
                        'source' => 'kodik',
                        'translation_name' => $result['translation']['title'] ?? 'Unknown',
                        'translation_type' => $result['translation']['type'] ?? 'voice',
                        'quality' => $result['quality'] ?? '720p',
                    ];
                }
            }
        }

        return $episodes;
    }

    protected function fetchFromAniLibria(Anime $anime): array
    {
        $title = $this->normalizeTitle($anime->title);

        $response = Http::timeout(20)
            ->get($this->anilibriaUrl, [
                'search' => $title,
                'playlist_type' => 'object',
            ]);

        if (! $response->ok()) {
            return [];
        }

        $data = $response->json();
        if (! isset($data['player']['playlist'])) {
            return [];
        }

        $episodes = [];
        foreach ($data['player']['playlist'] as $item) {
            $num = $item['episode'] ?? 0;
            $episodes[] = [
                'episode_number' => (int) $num,
                'season_number' => 1,
                'title' => $item['name'] ?? "Серия {$num}",
                'player_url' => $item['hls']['fhd'] ?? $item['hls']['hd'] ?? null,
                'external_id' => $data['id'] ?? null,
                'source' => 'anilibria',
                'translation_name' => 'AniLibria',
                'translation_type' => 'voice',
                'quality' => 'hls',
            ];
        }

        return $episodes;
    }

    protected function storeEpisodes(Anime $anime, array $episodes, bool $update): void
    {
        foreach ($episodes as $data) {
            try {
                $episodeData = array_merge(['anime_id' => $anime->id], $data);
                unset($episodeData['translation_name']);

                $existing = Episode::where('anime_id', $anime->id)
                    ->where('episode_number', $data['episode_number'])
                    ->where('translator', $data['translation_name'] ?? 'Unknown')
                    ->first();

                if ($existing) {
                    if ($update) {
                        $existing->update($episodeData);
                        $this->updated++;
                    } else {
                        $this->skipped++;
                    }
                } else {
                    Episode::create($episodeData);
                    $this->created++;
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
        Log::info("Import stats: Processed: {$this->processed}, Created: {$this->created}, Updated: {$this->updated}, Duration: {$duration}s");
    }
}
