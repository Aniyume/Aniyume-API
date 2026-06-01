<?php

namespace App\Services;

use App\Models\Anime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EpisodeLookupMetadataService
{
    /**
     * Build a wider list of titles for episode providers that do not support Shikimori IDs.
     * These services are metadata-only: they improve matching in Kodik/VideoCDN and future providers.
     */
    public function titleCandidates(Anime $anime): array
    {
        $titles = [
            $anime->title,
            $anime->title_en,
            $anime->title_jp,
            $anime->slug ? str_replace('-', ' ', $anime->slug) : null,
        ];

        if ($anime->shikimori_id) {
            $titles = array_merge($titles, $this->fromShikimori((int) $anime->shikimori_id));
        }

        $titles = array_merge($titles, $this->fromAniList($anime), $this->fromKitsu($anime));

        return collect($titles)
            ->filter(fn ($title) => is_string($title) && trim($title) !== '')
            ->map(fn ($title) => trim((string) $title))
            ->unique(fn ($title) => $this->normalizeTitle($title))
            ->values()
            ->take(12)
            ->all();
    }

    private function fromShikimori(int $shikimoriId): array
    {
        return Cache::remember("episode_lookup_shikimori_{$shikimoriId}", 86400, function () use ($shikimoriId) {
            try {
                $response = Http::timeout(10)
                    ->retry(2, 500)
                    ->withHeaders(['User-Agent' => 'Aniyume/1.0'])
                    ->get("https://shikimori.one/api/animes/{$shikimoriId}");

                if (! $response->successful()) {
                    return [];
                }

                $data = $response->json();

                return [
                    $data['russian'] ?? null,
                    $data['name'] ?? null,
                    ...($data['english'] ?? []),
                    ...($data['japanese'] ?? []),
                    ...($data['synonyms'] ?? []),
                ];
            } catch (\Throwable) {
                return [];
            }
        });
    }

    private function fromAniList(Anime $anime): array
    {
        $search = $anime->title_en ?: $anime->title;
        if (! $search) {
            return [];
        }

        $cacheKey = 'episode_lookup_anilist_'.md5($search.'|'.$anime->year.'|'.$anime->type);

        return Cache::remember($cacheKey, 86400, function () use ($anime, $search) {
            try {
                $query = <<<'GRAPHQL'
query ($search: String, $seasonYear: Int, $format: MediaFormat) {
  Media(search: $search, seasonYear: $seasonYear, type: ANIME, format: $format) {
    title { romaji english native userPreferred }
    synonyms
  }
}
GRAPHQL;

                $format = match ($anime->type) {
                    'movie' => 'MOVIE',
                    'ova' => 'OVA',
                    'ona' => 'ONA',
                    default => null,
                };

                $response = Http::timeout(10)
                    ->retry(2, 500)
                    ->post('https://graphql.anilist.co', [
                        'query' => $query,
                        'variables' => [
                            'search' => $search,
                            'seasonYear' => $anime->year,
                            'format' => $format,
                        ],
                    ]);

                if (! $response->successful()) {
                    return [];
                }

                $media = $response->json('data.Media', []);

                return [
                    $media['title']['romaji'] ?? null,
                    $media['title']['english'] ?? null,
                    $media['title']['native'] ?? null,
                    $media['title']['userPreferred'] ?? null,
                    ...($media['synonyms'] ?? []),
                ];
            } catch (\Throwable) {
                return [];
            }
        });
    }

    private function fromKitsu(Anime $anime): array
    {
        $search = $anime->title_en ?: $anime->title;
        if (! $search) {
            return [];
        }

        $cacheKey = 'episode_lookup_kitsu_'.md5($search.'|'.$anime->year);

        return Cache::remember($cacheKey, 86400, function () use ($anime, $search) {
            try {
                $response = Http::timeout(10)
                    ->retry(2, 500)
                    ->get('https://kitsu.io/api/edge/anime', [
                        'filter[text]' => $search,
                        'page[limit]' => 5,
                    ]);

                if (! $response->successful()) {
                    return [];
                }

                $items = $response->json('data', []);
                $best = collect($items)->sortByDesc(function ($item) use ($anime) {
                    $attributes = $item['attributes'] ?? [];
                    $year = isset($attributes['startDate']) ? (int) substr($attributes['startDate'], 0, 4) : null;

                    return $year && $anime->year && $year === (int) $anime->year ? 1 : 0;
                })->first();

                $attributes = $best['attributes'] ?? [];
                $titles = $attributes['titles'] ?? [];

                return [
                    $attributes['canonicalTitle'] ?? null,
                    $titles['en'] ?? null,
                    $titles['en_jp'] ?? null,
                    $titles['ja_jp'] ?? null,
                    ...($attributes['abbreviatedTitles'] ?? []),
                ];
            } catch (\Throwable) {
                return [];
            }
        });
    }

    private function normalizeTitle(string $title): string
    {
        $title = mb_strtolower($title);
        $title = str_replace('ё', 'е', $title);

        return trim(preg_replace('/[^\p{L}\p{N}]+/u', '', $title));
    }
}
