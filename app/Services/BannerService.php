<?php

namespace App\Services;

use App\Models\Anime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BannerService
{
    protected string $apiUrl = 'https://graphql.anilist.co';

    protected static array $requestBuffer = [];

    /**
     * Get banner and cover URLs for a given anime.
     *
     * @return array{banner: ?string, cover: ?string}
     */
    public function getBanner(Anime $anime): array
    {
        if (! empty($anime->cover_url)) {
            return [
                'banner' => $anime->cover_url,
                'cover' => $anime->poster_url,
                'source' => $anime->cover_source,
            ];
        }

        $cacheKey = "anime_banner_{$anime->id}";

        return Cache::remember($cacheKey, now()->addDays(3), function () use ($anime) {
            return $this->fetchFromAnilist($anime);
        });
    }

    /**
     * Internal fetch logic with deduplication and error handling.
     */
    protected function fetchFromAnilist(Anime $anime): array
    {
        $idMal = $anime->shikimori_id ? (int) $anime->shikimori_id : null;
        $idAniList = ($anime->external_source === 'anilist' && $anime->external_id)
            ? (int) $anime->external_id
            : null;

        if (! $idMal && ! $idAniList) {
            return ['banner' => null, 'cover' => null];
        }

        // Request Deduplication in current process
        $dedupKey = $idAniList ? "ani_{$idAniList}" : "mal_{$idMal}";
        if (isset(self::$requestBuffer[$dedupKey])) {
            return self::$requestBuffer[$dedupKey];
        }

        $variables = ['type' => 'ANIME'];
        if ($idMal) {
            $variables['idMal'] = $idMal;
        }
        if ($idAniList) {
            $variables['id'] = $idAniList;
        }

        if (empty($variables['idMal']) && empty($variables['id'])) {
            return ['banner' => null, 'cover' => null];
        }

        $query = '
            query ($idMal: Int, $id: Int) {
                Media (idMal: $idMal, id: $id, type: ANIME) {
                    bannerImage
                    coverImage {
                        extraLarge
                    }
                }
            }
        ';

        try {
            $response = Http::timeout(10)->post($this->apiUrl, [
                'query' => $query,
                'variables' => $variables,
            ]);

            if ($response->failed()) {
                // Negative caching for 4 hours on API failure
                Cache::put("anime_banner_{$anime->id}", ['banner' => null, 'cover' => null], now()->addHours(4));

                return ['banner' => null, 'cover' => null];
            }

            $data = $response->json();
            $media = $data['data']['Media'] ?? null;

            $result = [
                'banner' => $media['bannerImage'] ?? null,
                'cover' => $media['coverImage']['extraLarge'] ?? null,
            ];

            self::$requestBuffer[$dedupKey] = $result;

            return $result;

        } catch (\Exception $e) {
            Log::error("BannerService: Failed to fetch banner for Anime #{$anime->id}", [
                'error' => $e->getMessage(),
            ]);

            return ['banner' => null, 'cover' => null];
        }
    }
}
