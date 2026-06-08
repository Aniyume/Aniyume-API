<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KodikService
{
    private string $baseUrl;

    private ?string $apiToken;

    /**
     * Fallback domains to try if primary fails.
     * Kodik frequently rotates their API domains.
     */
    private array $fallbackDomains = [
        'https://kodikapi.com',
        'https://kodik.info',
    ];

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.kodik.base_url', 'https://kodikapi.com'), '/');
        $this->apiToken = config('services.kodik.token', '');

        if (empty($this->apiToken)) {
            $this->apiToken = $this->fetchDynamicToken();
        }
    }

    public function searchByShikimoriId(?int $shikimoriId): array
    {
        if (! $shikimoriId) {
            return [];
        }

        $cacheKey = "kodik_anime_{$shikimoriId}";

        return Cache::remember($cacheKey, 3600, function () use ($shikimoriId) {
            $params = [
                'shikimori_id' => $shikimoriId,
                'with_episodes' => true,
                'with_material_data' => true,
            ];

            if ($this->apiToken) {
                $params['token'] = $this->apiToken;
            }

            $response = $this->requestWithFallback('/search', $params);

            return $response ?? [];
        });
    }

    /**
     * Search all translations for an anime by Shikimori ID.
     * Returns ALL Kodik results (different dubs/subs) not just the first one.
     */
    public function searchAllTranslations(?int $shikimoriId): array
    {
        if (! $shikimoriId) {
            return [];
        }

        $cacheKey = "kodik_all_translations_{$shikimoriId}";

        return Cache::remember($cacheKey, 3600, function () use ($shikimoriId) {
            $params = [
                'shikimori_id' => $shikimoriId,
                'with_episodes' => true,
                'with_episodes_data' => true,
                'with_material_data' => true,
            ];

            if ($this->apiToken) {
                $params['token'] = $this->apiToken;
            }

            return $this->requestWithFallback('/search', $params) ?? [];
        });
    }

    public function getEpisodes(string $kodikId): array
    {
        $data = $this->searchByKodikId($kodikId);

        if (empty($data)) {
            return [];
        }

        $episodes = [];
        $anime = $data[0];
        $seasons = $anime['seasons'] ?? [];

        foreach ($seasons as $seasonNumber => $seasonData) {
            $episodesData = $seasonData['episodes'] ?? [];

            foreach ($episodesData as $episodeNumber => $link) {
                // Remove protocol so we can reliably add https
                $link = str_replace(['http:', 'https:'], '', $link);
                if (str_starts_with($link, '//')) {
                    $link = 'https:'.$link;
                }

                // Add hide_premium and only_episode flags
                $link = $this->buildPlayerUrl($link);

                $episodes[] = [
                    'episode' => (int) $episodeNumber,
                    'season' => (int) $seasonNumber,
                    'title' => $anime['material_data']['title'] ?? "Episode {$episodeNumber}",
                    'link' => $link,
                    'translation' => [
                        'id' => $anime['translation']['id'] ?? null,
                        'title' => $anime['translation']['title'] ?? 'Unknown',
                        'type' => $anime['translation']['type'] ?? 'voice',
                    ],
                ];
            }
        }

        return $episodes;
    }

    /**
     * Формирует URL для плеера с нужными GET параметрами
     */
    public function buildPlayerUrl(string $url): string
    {
        $parsedUrl = parse_url($url);
        $query = [];

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $query);
        }

        // Если указать этот параметр, кнопка "Следующая серия" пропадет внутри плеера
        $query['only_episode'] = 'true';

        // Скрывает блок Kodik "Премиум" если у нас есть корректный токен
        // На самом токене должна быть активирована услуга "Белый список (без рекламы)"
        if (config('services.kodik.hide_ads', false)) {
            $query['hide_premium'] = 'true';
        }

        $newQuery = http_build_query($query);

        $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'].'://' : 'https://';
        $host = $parsedUrl['host'] ?? '';
        $path = $parsedUrl['path'] ?? '';

        return $scheme.$host.$path.'?'.$newQuery;
    }

    /**
     * Build a Kodik iframe source for a specific anime and episode.
     * Used for live fallback when no episodes are in the DB.
     */
    public function buildEpisodeIframeUrl(int $shikimoriId, int $episodeNumber): ?string
    {
        $results = $this->searchByShikimoriId($shikimoriId);
        if (empty($results)) {
            return null;
        }

        // Take the first result (highest quality/most popular translation)
        $anime = $results[0];
        $seasons = $anime['seasons'] ?? [];

        foreach ($seasons as $seasonData) {
            $episodes = $seasonData['episodes'] ?? [];
            if (isset($episodes[$episodeNumber])) {
                $link = $episodes[$episodeNumber];
                if (str_starts_with($link, '//')) {
                    $link = 'https:'.$link;
                }

                return $this->buildPlayerUrl($link);
            }
        }

        // For movies — single link
        if (isset($anime['link']) && $episodeNumber === 1) {
            $link = str_starts_with($anime['link'], '//') ? 'https:'.$anime['link'] : $anime['link'];

            return $this->buildPlayerUrl($link);
        }

        return null;
    }

    private function searchByKodikId(string $kodikId): array
    {
        $params = [
            'id' => $kodikId,
            'with_episodes' => true,
            'with_material_data' => true,
        ];

        if ($this->apiToken) {
            $params['token'] = $this->apiToken;
        }

        return $this->requestWithFallback('/search', $params) ?? [];
    }

    public function searchByTitle(string $title, ?string $titleEn = null, ?int $year = null, ?string $type = null): array
    {
        return $this->searchByTitles(array_filter([$title, $titleEn]), $year, $type);
    }

    public function searchByTitles(array $titles, ?int $year = null, ?string $type = null): array
    {
        $queries = array_values(array_unique(array_filter($titles)));
        $results = [];

        foreach ($queries as $query) {
            $params = [
                'title' => $query,
                'with_episodes' => true,
                'with_episodes_data' => true,
                'with_material_data' => true,
                'limit' => 20,
                'types' => $type === 'movie' ? 'anime' : 'anime-serial,anime',
            ];

            if ($year) {
                $params['year'] = $year;
            }

            if ($this->apiToken) {
                $params['token'] = $this->apiToken;
            }

            $results = array_merge($results, $this->requestWithFallback('/search', $params) ?? []);
        }

        $seen = [];
        $results = array_values(array_filter($results, function ($item) use (&$seen) {
            $key = (string) ($item['id'] ?? md5(($item['title'] ?? '').($item['link'] ?? '')));
            if (isset($seen[$key])) {
                return false;
            }
            $seen[$key] = true;

            return $this->countEpisodes($item) > 0 || ! empty($item['link']);
        }));

        usort($results, function ($a, $b) use ($queries, $year) {
            $aScore = $this->matchScore($a, $queries, $year);
            $bScore = $this->matchScore($b, $queries, $year);

            if ($aScore !== $bScore) {
                return $bScore <=> $aScore;
            }

            $aEpisodes = $this->countEpisodes($a);
            $bEpisodes = $this->countEpisodes($b);

            return $bEpisodes <=> $aEpisodes;
        });

        return $results;
    }

    /**
     * Make HTTP request with fallback to alternative domains.
     */
    private function requestWithFallback(string $path, array $params): ?array
    {
        $domains = array_unique(array_merge([$this->baseUrl], $this->fallbackDomains));

        foreach ($domains as $domain) {
            try {
                $response = Http::timeout(15)
                    ->retry(2, 1000)
                    ->get("{$domain}{$path}", $params);

                if ($response->successful()) {
                    return $response->json('results', []);
                }
            } catch (\Throwable $e) {
                Log::debug("Kodik request failed for domain {$domain}: {$e->getMessage()}");

                continue;
            }
        }

        Log::warning("Kodik: all domains failed for {$path}", ['params' => array_diff_key($params, ['token' => ''])]);

        return null;
    }

    private function countEpisodes(array $anime): int
    {
        $count = 0;
        $seasons = $anime['seasons'] ?? [];

        foreach ($seasons as $season) {
            $count += count($season['episodes'] ?? []);
        }

        return $count;
    }

    private function matchScore(array $anime, array $wantedTitles, ?int $year): int
    {
        $score = 0;
        $candidateTitles = array_filter([
            $anime['title'] ?? null,
            $anime['title_orig'] ?? null,
            $anime['other_title'] ?? null,
            $anime['material_data']['title'] ?? null,
            $anime['material_data']['anime_title'] ?? null,
            $anime['material_data']['title_en'] ?? null,
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

        $candidateYear = $anime['year'] ?? $anime['material_data']['year'] ?? null;
        if ($year && $candidateYear) {
            $delta = abs((int) $candidateYear - $year);
            $score += match (true) {
                $delta === 0 => 30,
                $delta === 1 => 10,
                default => -20,
            };
        }

        $score += min($this->countEpisodes($anime), 50);

        return $score;
    }

    private function normalizeTitle(string $title): string
    {
        $title = mb_strtolower($title);
        $title = str_replace('ё', 'е', $title);

        return trim(preg_replace('/[^\p{L}\p{N}]+/u', '', $title));
    }

    /**
     * Fetch a dynamic token from Kodik's player script if an official one is not provided.
     * Caches the token for 24 hours to avoid rate limits.
     */
    private function fetchDynamicToken(): ?string
    {
        return Cache::remember('kodik_dynamic_token', 86400, function () {
            try {
                $response = Http::withoutVerifying()
                    ->timeout(10)
                    ->get('https://kodik-add.com/add-players.min.js?v=2');

                if ($response->successful()) {
                    if (preg_match('/token="([^"]+)"/', $response->body(), $matches)) {
                        Log::info('Successfully fetched dynamic Kodik token.');

                        return $matches[1];
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch dynamic Kodik token: '.$e->getMessage());
            }

            return null;
        });
    }
}
