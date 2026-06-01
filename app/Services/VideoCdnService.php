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

    public function getEpisodesByTitle(string $title, ?string $titleEn = null, ?int $year = null, ?string $type = null): array
    {
        return $this->getEpisodesByTitles(array_filter([$title, $titleEn]), $year, $type);
    }

    public function getEpisodesByTitles(array $titles, ?int $year = null, ?string $type = null): array
    {
        if (! $this->apiToken) {
            return [];
        }

        $titles = array_values(array_unique(array_filter($titles)));
        $endpoints = $type === 'movie' ? ['/animes', '/anime-tv-series'] : ['/anime-tv-series', '/animes'];
        $best = null;
        $bestScore = PHP_INT_MIN;

        foreach ($endpoints as $endpoint) {
            foreach ($titles as $queryTitle) {
                $cleanTitle = trim(preg_replace('/[^\p{L}\p{N}\s\-]/u', '', $queryTitle));
                $data = $this->fetchFromApi($endpoint, ['title' => $cleanTitle, 'limit' => 10]);

                foreach ($data as $item) {
                    $episodes = $this->parseVideoCdnEpisodes($item);
                    if (empty($episodes)) {
                        continue;
                    }

                    $score = $this->matchScore($item, $titles, $year) + min(count($episodes), 50);
                    if ($score > $bestScore) {
                        $bestScore = $score;
                        $best = $episodes;
                    }
                }
            }
        }

        return $best ?? [];
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

    private function matchScore(array $item, array $wantedTitles, ?int $year): int
    {
        $score = 0;
        $candidateTitles = array_filter([
            $item['ru_title'] ?? null,
            $item['orig_title'] ?? null,
            $item['title'] ?? null,
        ]);

        foreach ($wantedTitles as $wanted) {
            $wantedNormalized = $this->normalizeTitle($wanted);
            foreach ($candidateTitles as $candidate) {
                $candidateNormalized = $this->normalizeTitle((string) $candidate);
                if ($wantedNormalized !== '' && $candidateNormalized !== '') {
                    if ($candidateNormalized === $wantedNormalized) {
                        $score += 100;
                    } elseif (str_contains($candidateNormalized, $wantedNormalized) || str_contains($wantedNormalized, $candidateNormalized)) {
                        $score += 40;
                    }
                }
            }
        }

        $candidateYear = $item['year'] ?? $item['start_year'] ?? null;
        if ($year && $candidateYear) {
            $delta = abs((int) $candidateYear - $year);
            $score += match (true) {
                $delta === 0 => 30,
                $delta === 1 => 10,
                default => -20,
            };
        }

        return $score;
    }

    private function normalizeTitle(string $title): string
    {
        $title = mb_strtolower($title);
        $title = str_replace('ё', 'е', $title);

        return trim(preg_replace('/[^\p{L}\p{N}]+/u', '', $title));
    }
}
