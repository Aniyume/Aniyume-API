<?php

namespace App\Services;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AnilibriaService
{
    private string $baseUrl;
    private string $cdnUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.anilibria.base_url', 'https://anilibria.top/api/v1');
        $this->cdnUrl  = rtrim(config('services.anilibria.cdn_url', 'https://cache-rfn.libria.fun'), '/');
    }

    /**
     * Search release by Russian or English title.
     * Returns first matching release array, or null.
     */
    public function findByTitle(string $titleRu, ?string $titleEn = null): ?array
    {
        $query = $titleRu;

        $cacheKey = 'anilibria_search_' . md5($query);

        return Cache::remember($cacheKey, 3600 * 2, function () use ($query, $titleEn) {
            $result = $this->searchCatalog($query);

            if (!$result && $titleEn) {
                $result = $this->searchCatalog($titleEn);
            }

            return $result;
        });
    }

    /**
     * Get full release data (including episodes) by Anilibria release ID.
     */
    public function getRelease(int $releaseId): ?array
    {
        $cacheKey = "anilibria_release_{$releaseId}";

        return Cache::remember($cacheKey, 3600, function () use ($releaseId) {
            try {
                $response = Http::timeout(15)
                    ->retry(2, 500)
                    ->withHeaders(['Accept' => 'application/json'])
                    ->get("{$this->baseUrl}/anime/releases/{$releaseId}");

                return $response->successful() ? $response->json() : null;
            } catch (\Exception $e) {
                return null;
            }
        });
    }

    /**
     * Get formatted episodes array for a release ID.
     */
    public function getEpisodes(int $releaseId): array
    {
        $release = $this->getRelease($releaseId);
        if (!$release) {
            return [];
        }

        $releaseEpisodes = $release['episodes'] ?? [];
        $episodes = [];
        
        foreach ($releaseEpisodes as $item) {
            $formatted = $this->formatEpisode($item, $releaseId);
            if ($formatted['player_url']) {
                $episodes[] = $formatted;
            }
        }
            
        return $episodes;
    }

    /**
     * Fetch recently updated releases (for ongoing sync).
     * Returns array of release IDs updated today.
     */
    public function fetchRecentlyUpdated(): array
    {
        try {
            $response = Http::timeout(15)
                ->retry(2, 500)
                ->withHeaders(['Accept' => 'application/json'])
                ->get("{$this->baseUrl}/anime/releases/latest", ['limit' => 100]);

            if (!$response->successful()) {
                Log::error('Anilibria: failed to fetch latest releases', ['status' => $response->status()]);
                return [];
            }

            return $response->json() ?? [];
        } catch (\Exception $e) {
            Log::error('Anilibria: exception fetching latest releases', ['trace' => $e->getMessage()]);
            return [];
        }
    }

    // ────────────────────────────────────────────────────────────────

    private function searchCatalog(string $query): ?array
    {
        $clean = trim(preg_replace('/[^\p{L}\p{N}\s\-]/u', '', $query));
        if (empty($clean)) {
            return null;
        }

        try {
            $response = Http::timeout(15)
                ->retry(2, 500)
                ->withHeaders(['Accept' => 'application/json'])
                ->get("{$this->baseUrl}/anime/catalog/releases", [
                    'f[search]' => $clean,
                    'limit'     => 10,
                    'page'      => 1,
                ]);

            if (!$response->successful()) {
                return null;
            }

            $list = $response->json('data', []);
            if (empty($list)) {
                return null;
            }

            // Normalize strings for strict exact matching
            $normalize = function(?string $str) {
                if (!$str) return '';
                $str = mb_strtolower($str);
                $str = str_replace('ё', 'е', $str);
                return trim(preg_replace('/[^\p{L}\p{N}]/u', '', $str));
            };

            $queryClean = $normalize($query);

            foreach ($list as $item) {
                $nameRu = $normalize($item['name']['main'] ?? '');
                $nameEn = $normalize($item['name']['english'] ?? '');
                $nameAlt = $normalize($item['name']['alternative'] ?? '');

                if ($nameRu === $queryClean || $nameEn === $queryClean || $nameAlt === $queryClean) {
                    return $item;
                }
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function formatEpisode(array $item, int $releaseId): array
    {
        $num = (int) ($item['ordinal'] ?? $item['sort_order'] ?? 1);

        // Pick best available HLS quality and prepend CDN URL
        $hlsPath = $item['hls_1080'] ?? $item['hls_720'] ?? $item['hls_480'] ?? null;
        $url = $hlsPath
            ? (str_starts_with($hlsPath, 'http') ? $hlsPath : "{$this->cdnUrl}{$hlsPath}")
            : null;

        // Skip times (opening / ending)
        $skips = null;
        $opening = $item['opening'] ?? [];
        $ending  = $item['ending']  ?? [];
        if (!empty($opening['start']) || !empty($ending['start'])) {
            $skips = [
                'opening' => [$opening['start'] ?? 0, $opening['stop'] ?? 0],
                'ending'  => [$ending['start']  ?? 0, $ending['stop']  ?? 0],
            ];
        }

        // Preview thumbnail
        $preview = $item['preview']['src']
            ?? $item['preview']['thumbnail']
            ?? $item['preview']['optimized']['thumbnail']
            ?? null;

        return [
            'episode_number'     => $num,
            'season_number'      => 1,
            'title'              => $item['name'] ?? $item['name_english'] ?? "Серия {$num}",
            'player_url'         => $url,
            'duration'           => isset($item['duration']) ? (int) $item['duration'] : null,
            'external_id'        => (string) $releaseId,
            'external_episode_id'=> $item['id'] ?? null,
            'source'             => 'anilibria',
            'translator'         => 'AniLibria',
            'translation_type'   => 'dub',
            'quality'            => '1080p',
            'priority'           => 10,
            'skip_times'         => $skips,
            'poster_url'         => $preview,
            'aired_at'           => $item['updated_at'] ?? null,
        ];
    }
}
