<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VideoCdnService
{
    private string $baseUrl = 'https://videocdn.tv/api';

    private ?string $apiToken;

    public function __construct()
    {
        $this->apiToken = config('services.videocdn.token', env('VIDEOCDN_TOKEN', ''));
    }

    public function getEpisodesByShikimoriId(string $shikimoriId): array
    {
        if (! $this->apiToken || ! $shikimoriId) {
            return [];
        }

        // Check both movies and tv-series endpoints
        $endpoints = ['/anime-tv-series', '/animes'];

        foreach ($endpoints as $endpoint) {
            $data = $this->fetchFromApi($endpoint, ['shikimori_id' => $shikimoriId]);

            if (! empty($data)) {
                return $this->parseVideoCdnEpisodes($data[0]);
            }
        }

        return [];
    }

    public function getEpisodesByTitle(string $title): array
    {
        if (! $this->apiToken) {
            return [];
        }

        $title = trim(preg_replace('/[^\p{L}\p{N}\s\-]/u', '', $title));

        $endpoints = ['/anime-tv-series', '/animes'];

        foreach ($endpoints as $endpoint) {
            $data = $this->fetchFromApi($endpoint, ['title' => $title, 'limit' => 3]);

            if (! empty($data)) {
                return $this->parseVideoCdnEpisodes($data[0]);
            }
        }

        return [];
    }

    private function fetchFromApi(string $endpoint, array $params): array
    {
        $params['api_token'] = $this->apiToken;

        try {
            $response = Http::timeout(30)->retry(2, 500)->get("{$this->baseUrl}{$endpoint}", $params);

            if ($response->ok() && $response->json('result')) {
                $data = $response->json('data', []);

                return $data;
            }
        } catch (\Exception $e) {
            Log::error('VideoCDN API Error: '.$e->getMessage());
        }

        return [];
    }

    private function parseVideoCdnEpisodes(array $item): array
    {
        $episodes = [];
        $externalId = $item['id'] ?? null;

        // Is it a movie/single episode?
        if (isset($item['iframe_src']) && ! isset($item['episodes'])) {
            $episodes[] = [
                'episode_number' => 1,
                'season_number' => 1,
                'title' => $item['ru_title'] ?? $item['orig_title'] ?? 'Full Movie',
                'player_url' => $this->ensureHttps($item['iframe_src']),
                'external_id' => $externalId,
                'source' => 'videocdn',
                'translation_name' => 'Original/Sub',
                'translation_type' => 'voice',
                'quality' => 'auto',
            ];

            return $episodes;
        }

        // TV-series fallback
        // VideoCDN gives an iframe_src. Wait, VideoCDN API gives episodes property in 'episodes' array.
        // Actually, TV Series in VideoCDN usually returns exactly 1 `iframe_src` that contains the whole season with a built-in episode selector.
        // But the user's system stores episode by episode.
        // Let's create an abstraction: if `episodes` list is provided, parse it.
        // If only `iframe_src` is provided for TV Series, we generate fake sequential episodes? No, we return exactly 1 episode and rename it "All Episodes".

        if (isset($item['episodes']) && is_array($item['episodes'])) {
            foreach ($item['episodes'] as $epFolder) {
                // Usually VideoCDN episodes array is nested per season.
                foreach ($epFolder['episodes'] ?? [] as $ep) {
                    $episodes[] = [
                        'episode_number' => (int) ($ep['num'] ?? 1),
                        'season_number' => (int) ($epFolder['num'] ?? 1),
                        'title' => $ep['title'] ?? 'Серия '.($ep['num'] ?? 1),
                        'player_url' => $this->ensureHttps($ep['iframe_src'] ?? $item['iframe_src']),
                        'external_id' => $externalId,
                        'source' => 'videocdn',
                        'translation_name' => $epFolder['translation'] ?? 'Default',
                        'translation_type' => 'voice',
                        'quality' => 'auto',
                    ];
                }
            }
        } else {
            // Just pass iframe directly. Next.js AnimePlayer uses iframe src.
            // If we just save 1 episode per season:
            $episodes[] = [
                'episode_number' => 1,
                'season_number' => 1,
                'title' => $item['ru_title'] ?? 'Все серии',
                'player_url' => $this->ensureHttps($item['iframe_src']),
                'external_id' => $externalId,
                'source' => 'videocdn',
                'translation_name' => 'Default',
                'translation_type' => 'voice',
                'quality' => 'auto',
            ];
        }

        return $episodes;
    }

    private function ensureHttps(string $url): string
    {
        if (strpos($url, '//') === 0) {
            return 'https:'.$url;
        }

        return $url;
    }
}
