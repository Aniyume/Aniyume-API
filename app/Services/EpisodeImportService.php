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

    protected int $processed = 0;

    protected int $created = 0;

    protected int $updated = 0;

    protected int $skipped = 0;

    protected int $errors = 0;

    protected float $startTime;

    public function __construct()
    {
        $this->kodikToken = config('services.kodik.token');
    }

    public function importForSingleAnime(Anime $anime, bool $update = false): void
    {
        try {
            Log::info('Attempting episode import', [
                'anime_id' => $anime->id,
                'title' => $anime->title,
                'shikimori_id' => $anime->shikimori_id,
            ]);

            $episodes = [];

            // Try Kodik by Shikimori ID first
            if ($anime->shikimori_id) {
                Log::info('Fetching from Kodik by Shikimori ID', ['shikimori_id' => $anime->shikimori_id]);
                $episodes = $this->fetchFromKodikByShikimori($anime);
                Log::info('Kodik by Shikimori result', ['episodes_count' => count($episodes)]);
            }

            // Try Kodik by title if no results
            if (empty($episodes)) {
                Log::info('Fetching from Kodik by title', ['title' => $anime->title]);
                $episodes = $this->fetchFromKodik($anime);
                Log::info('Kodik by title result', ['episodes_count' => count($episodes)]);
            }

            // Try AniLibria as fallback
            if (empty($episodes)) {
                Log::info('Fetching from AniLibria', ['title' => $anime->title]);
                $episodes = $this->fetchFromAniLibria($anime);
                Log::info('AniLibria result', ['episodes_count' => count($episodes)]);
            }

            if (empty($episodes)) {
                Log::warning('No episodes found for anime', [
                    'anime_id' => $anime->id,
                    'title' => $anime->title,
                ]);
                $this->skipped++;
            } else {
                Log::info('Storing episodes', [
                    'anime_id' => $anime->id,
                    'episodes_count' => count($episodes),
                ]);
                $this->storeEpisodes($anime, $episodes, $update);
            }

            $this->processed++;

        } catch (\Throwable $e) {
            $this->errors++;
            Log::error('Episode import error', [
                'anime_id' => $anime->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
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

        echo "\nStarting episodes import (Kodik -> AniLibria)...\n";
        echo "Total anime: {$total}\n\n";

        $query->orderBy('id')->chunk(100, function ($animes) use ($total, &$processedLocal, $update) {
            foreach ($animes as $anime) {
                $processedLocal++;
                echo "\rProcessing {$processedLocal}/{$total} [{$anime->id}] {$anime->title}";

                $this->importForSingleAnime($anime, $update);

                // Small delay to avoid rate limiting
                usleep(500000); // 0.5 second
            }
        });

        echo "\n\n";
        $this->printStats();
    }

    protected function fetchFromKodikByShikimori(Anime $anime): array
    {
        if (! $this->kodikToken || ! $anime->shikimori_id) {
            Log::info('Skipping Kodik by Shikimori', [
                'has_token' => ! empty($this->kodikToken),
                'has_shikimori_id' => ! empty($anime->shikimori_id),
            ]);

            return [];
        }

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->withHeaders([
                    'User-Agent' => 'AniYumeBot/1.0',
                    'Accept' => 'application/json',
                ])
                ->get($this->kodikUrl, [
                    'token' => $this->kodikToken,
                    'shikimori_id' => $anime->shikimori_id,
                    'with_episodes' => 'true',
                    'limit' => 1,
                ]);

            if (! $response->ok()) {
                Log::warning('Kodik API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            $results = $response->json('results') ?? [];

            if (empty($results)) {
                return [];
            }

            return $this->parseKodikEpisodes($results[0]);

        } catch (\Exception $e) {
            Log::error('Kodik fetch error', [
                'anime_id' => $anime->id,
                'error' => $e->getMessage(),
            ]);

            return [];
        }
    }

    protected function fetchFromKodik(Anime $anime): array
    {
        if (! $this->kodikToken) {
            return [];
        }

        $title = $this->normalizeTitle($anime->title);

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->withHeaders([
                    'User-Agent' => 'AniYumeBot/1.0',
                    'Accept' => 'application/json',
                ])
                ->get($this->kodikUrl, [
                    'token' => $this->kodikToken,
                    'title' => $title,
                    'types' => 'anime,anime-serial',
                    'with_episodes' => 'true',
                    'limit' => 10,
                ]);

            if (! $response->ok()) {
                return [];
            }

            $results = $response->json('results') ?? [];

            if (empty($results)) {
                return [];
            }

            // Take the first result with most episodes
            usort($results, function ($a, $b) {
                $countA = isset($a['episodes']) ? count($a['episodes'], COUNT_RECURSIVE) : 0;
                $countB = isset($b['episodes']) ? count($b['episodes'], COUNT_RECURSIVE) : 0;

                return $countB <=> $countA;
            });

            return $this->parseKodikEpisodes($results[0]);

        } catch (\Exception $e) {
            Log::error('Kodik title fetch error', [
                'anime_id' => $anime->id,
                'error' => $e->getMessage(),
            ]);

            return [];
        }
    }

    protected function parseKodikEpisodes(array $result): array
    {
        if (! isset($result['episodes']) || ! is_array($result['episodes'])) {
            return [];
        }

        $episodes = [];
        $poster = $result['screenshots'][0] ?? null;

        foreach ($result['episodes'] as $episodeNumber => $episodeItems) {
            if (! is_array($episodeItems)) {
                continue;
            }

            foreach ($episodeItems as $variant) {
                $episodes[] = [
                    'episode_number' => (int) $episodeNumber,
                    'season_number' => $variant['season'] ?? null,
                    'title' => $variant['title'] ?? "Серия {$episodeNumber}",
                    'player_url' => $variant['link'] ?? null,
                    'player_iframe' => $variant['iframe_src'] ?? null,
                    'external_id' => $result['id'] ?? null,
                    'external_source' => 'kodik',
                    'external_episode_id' => $variant['id'] ?? null,
                    'aired_at' => null,
                    'release_date' => null,
                    'duration' => null,
                    'thumbnail_url' => $variant['screenshot'] ?? null,
                    'poster_url' => $poster,
                    'translator' => $result['translation']['title'] ?? null,
                    'translation_type' => $result['translation']['type'] ?? null,
                    'quality' => $result['quality'] ?? null,
                    'source' => 'kodik',
                    'priority' => 10,
                ];
                break; // Only take first translation per episode
            }
        }

        return $episodes;
    }

    protected function fetchFromAniLibria(Anime $anime): array
    {
        $title = $this->normalizeTitle($anime->title);

        try {
            $response = Http::timeout(20)
                ->retry(3, 1000)
                ->withHeaders([
                    'User-Agent' => 'AniYumeBot/1.0',
                    'Accept' => 'application/json',
                ])
                ->get($this->anilibriaUrl, [
                    'search' => $title,
                    'playlist_type' => 'object',
                    'filter' => 'id,code,names,player,posters',
                ]);

            if (! $response->ok()) {
                return [];
            }

            $data = $response->json();

            if (! is_array($data) || ! isset($data['player']['playlist'])) {
                return [];
            }

            $playlist = $data['player']['playlist'];
            $poster = $data['posters']['original']['url'] ?? null;

            $episodes = [];

            foreach ($playlist as $key => $item) {
                $num = $item['episode'] ?? (int) $key;

                $hls = $item['hls'] ?? null;
                $hlsPlaylist = is_array($hls) ? ($hls['fhd'] ?? $hls['hd'] ?? $hls['sd'] ?? null) : null;

                $episodes[] = [
                    'episode_number' => (int) $num,
                    'season_number' => null,
                    'title' => $item['name'] ?? "Серия {$num}",
                    'player_url' => $hlsPlaylist,
                    'player_iframe' => null,
                    'external_id' => $data['id'] ?? null,
                    'external_source' => 'anilibria',
                    'external_episode_id' => ($data['id'] ?? 'anilibria').':'.$num,
                    'aired_at' => null,
                    'release_date' => null,
                    'duration' => null,
                    'thumbnail_url' => $item['preview'] ?? null,
                    'poster_url' => $poster,
                    'translator' => 'AniLibria',
                    'translation_type' => 'voice',
                    'quality' => 'hls',
                    'source' => 'anilibria',
                    'priority' => 5,
                ];
            }

            return $episodes;

        } catch (\Exception $e) {
            Log::error('AniLibria fetch error', [
                'anime_id' => $anime->id,
                'error' => $e->getMessage(),
            ]);

            return [];
        }
    }

    protected function storeEpisodes(Anime $anime, array $episodes, bool $update): void
    {
        foreach ($episodes as $data) {
            try {
                $existing = Episode::where('anime_id', $anime->id)
                    ->where('episode_number', $data['episode_number'])
                    ->where('source', $data['source'])
                    ->first();

                if ($existing) {
                    if ($update) {
                        $existing->update($data);
                        $this->updated++;
                    } else {
                        $this->skipped++;
                    }
                } else {
                    Episode::create(array_merge(
                        ['anime_id' => $anime->id],
                        $data
                    ));
                    $this->created++;
                }
            } catch (\Throwable $e) {
                $this->errors++;
                Log::error('Failed to store episode', [
                    'anime_id' => $anime->id,
                    'episode_number' => $data['episode_number'],
                    'message' => $e->getMessage(),
                ]);
            }
        }
    }

    protected function normalizeTitle(string $title): string
    {
        $title = preg_replace('/[^\p{L}\p{N}\s\-]/u', '', $title);
        $title = preg_replace('/\s+/', ' ', $title);

        return trim($title);
    }

    protected function printStats(): void
    {
        $duration = round(microtime(true) - $this->startTime, 2);

        echo "+-----------------+----------------+\n";
        echo "| Metric          | Value          |\n";
        echo "+-----------------+----------------+\n";
        echo '| Total Processed | '.str_pad($this->processed, 14)."|\n";
        echo '| Created         | '.str_pad($this->created, 14)."|\n";
        echo '| Updated         | '.str_pad($this->updated, 14)."|\n";
        echo '| Skipped         | '.str_pad($this->skipped, 14)."|\n";
        echo '| Errors          | '.str_pad($this->errors, 14)."|\n";
        echo '| Duration        | '.str_pad($duration.' s', 14)."|\n";
        echo "+-----------------+----------------+\n";
    }
}
