<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AnimeResource;
use App\Models\Anime;
use App\Models\Episode;
use App\Services\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

/**
 * @group Публичные данные
 *
 * Эндпоинты для получения информации об аниме.
 */
class AnimeController extends Controller
{
    /**
     * Список аниме
     *
     * Получение списка всех аниме с фильтрацией и поиском.
     *
     * @queryParam type string Тип аниме (tv, movie, etc). Example: tv
     * @queryParam status string Статус (planned, ongoing, finished, paused). Example: finished
     * @queryParam year integer Год выпуска. Example: 2023
     * @queryParam search string Поиск по названию или слагу. Example: Attack
     * @queryParam sort string Сортировка (rating, popularity, newest, title). Example: rating
     */
    public function index(Request $request)
    {
        if ($request->has('is_schedule')) {
            return app(\App\Http\Controllers\Api\V1\ScheduleController::class)->index();
        }

        $query = Anime::query()
            ->with(['tags'])
            ->withCount('episodes')
            // На публичном сайте показываем только тайтлы, которые реально можно смотреть.
            ->whereHas('episodes')
            ->when($request->filled('type'), function ($q) use ($request) {
                $q->where('type', $request->type);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $statusAliases = [
                    'releasing' => 'ongoing',
                    'upcoming' => 'planned',
                    'anons' => 'planned',
                ];
                $status = $statusAliases[$request->status] ?? $request->status;

                $q->where('status', $status);
            })
            ->when($request->filled('year'), function ($q) use ($request) {
                $q->where('year', $request->year);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = '%'.mb_strtolower((string) $request->search).'%';

                $q->where(function ($subQ) use ($search) {
                    $subQ->whereRaw('LOWER(title) LIKE ?', [$search])
                        ->orWhereRaw('LOWER(slug) LIKE ?', [$search]);
                });
            });

        if ($request->filled('genre')) {
            $genreSlug = $request->genre;

            $query->whereHas('tags', function ($q) use ($genreSlug) {
                $q->where('slug', $genreSlug);
            });
        }

        $sort = $request->sort;
        if (! $sort || $sort === 'smart') {
            // Улучшенная умная сортировка
            // 1. Деприоритет тега "Детское" (чтобы китайские мультики не лезли в начало)
            $query->orderByRaw('CASE WHEN EXISTS (
                SELECT 1 FROM anime_tag 
                JOIN tags ON tags.id = anime_tag.tag_id 
                WHERE anime_tag.anime_id = anime.id AND tags.name = \'Детское\'
            ) THEN 1 ELSE 0 END');

            // 2. Приоритет тем, у кого есть хоть какой-то рейтинг или популярность (отсеиваем ноунейм импорты)
            $query->orderByRaw('CASE WHEN (popularity > 0 OR rating > 0) THEN 0 ELSE 1 END');

            // 3. Сначала свежие годы, но в рамках одного года — популярные
            $query->orderBy('year', 'DESC')
                ->orderBy('popularity', 'DESC')
                ->orderBy('rating', 'DESC')
                ->orderBy('id', 'DESC');
        } else {
            $sortMap = [
                'rating' => ['rating', 'DESC'],
                'popularity' => ['popularity', 'DESC'],
                'newest' => ['aired_from', 'DESC'],
                'title' => ['title', 'ASC'],
            ];

            $s = $sortMap[$sort] ?? ['id', 'ASC'];
            $query->orderByRaw($s[0].' '.$s[1].' NULLS LAST');
        }

        $perPage = (int) $request->integer('per_page', 20);
        $perPage = max(1, min($perPage, 100));

        $anime = $query->paginate($perPage);

        return AnimeResource::collection($anime);
    }

    /**
     * Детальная информация об аниме
     *
     * @urlParam anime integer ID аниме. Example: 3
     */
    public function show(Anime $anime)
    {
        $anime->load(['tags']);
        $maxEpisode = Episode::query()->where('anime_id', '=', $anime->id)->max('episode_number');
        $anime->episodes_count = $maxEpisode ?: 0;

        return new AnimeResource($anime);
    }

    /**
     * Статистика сообщества
     *
     * Возвращает количество пользователей с разными статусами для этого аниме.
     */
    public function getCommunityStats(Anime $anime)
    {
        return response()->json($anime->getCommunityStats());
    }

    /**
     * Получение баннера из AniList
     *
     * Возвращает баннер и обложку (из кеша или API).
     */
    public function getBanner(Anime $anime, BannerService $bannerService)
    {
        $result = $bannerService->getBanner($anime);

        return response()->json($result);
    }

    /**
     * Рекомендации для аниме
     *
     * Возвращает связанные (сиквелы/приквелы) и похожие по жанрам аниме.
     *
     * @group Публичные данные
     *
     * @urlParam anime integer ID аниме. Example: 3
     *
     * @response { "has_official_related": true, "related": [...], "similar": [...] }
     */
    public function getRecommendations(Anime $anime)
    {
        $related = [];
        $hasOfficialRelated = false;

        // 1. Try to get related anime from Shikimori API
        if ($anime->shikimori_id) {
            try {
                $response = Http::timeout(5)
                    ->withHeaders(['User-Agent' => 'Aniyume/1.0'])
                    ->get("https://shikimori.io/api/animes/{$anime->shikimori_id}/related");

                if ($response->successful()) {
                    $relatedData = collect($response->json())
                        ->filter(fn ($item) => ! empty($item['anime']))
                        ->values();

                    $shikimoriIds = $relatedData
                        ->map(fn ($item) => (int) $item['anime']['id'])
                        ->toArray();

                    if (! empty($shikimoriIds)) {
                        $relationType = [];
                        foreach ($relatedData as $item) {
                            $relationType[(int) $item['anime']['id']] = $item['relation'] ?? null;
                        }

                        $foundAnime = Anime::query()->whereIn('shikimori_id', $shikimoriIds, 'and', false)
                            ->whereHas('episodes')
                            ->limit(10)
                            ->get();

                        $related = $foundAnime->map(function ($a) use ($relationType) {
                            return [
                                'id' => $a->id,
                                'title' => $a->title,
                                'poster_url' => $a->poster_url,
                                'type' => $a->type,
                                'rating' => $a->rating,
                                'year' => $a->year,
                                'relation_type' => $relationType[(int) $a->shikimori_id] ?? null,
                            ];
                        })->toArray();

                        if (! empty($related)) {
                            $hasOfficialRelated = true;
                        }
                    }
                }
            } catch (\Exception $e) {
                $related = [];
            }
        }

        // 2. Get current anime tag IDs
        $tagIds = $anime->tags()->pluck('tags.id')->toArray();

        // 3. Exclude IDs
        $excludeIds = array_merge(
            [$anime->id],
            array_column($related, 'id')
        );

        // 4. Similar by tags
        $similar = [];
        if (! empty($tagIds)) {
            $similar = $this->getSimilarByTags($tagIds, $excludeIds, 5, 0);
        }

        // 5. Fallback: if related is empty, fill both from tags
        if (empty($related)) {
            $hasOfficialRelated = false;
            if (! empty($tagIds)) {
                $allByTags = $this->getSimilarByTags($tagIds, [$anime->id], 10, 0);
                $related = array_slice($allByTags, 0, 5);
                $similar = array_slice($allByTags, 5, 5);
            }
        }

        return response()->json([
            'has_official_related' => $hasOfficialRelated,
            'related' => $related,
            'similar' => $similar,
        ]);
    }

    /**
     * Find anime with most matching tags via SQL JOIN + GROUP BY.
     */
    private function getSimilarByTags(array $tagIds, array $excludeIds, int $limit, int $offset): array
    {
        $animeRows = DB::table('anime')
            ->join('anime_tag', 'anime.id', '=', 'anime_tag.anime_id')
            ->whereIn('anime_tag.tag_id', $tagIds)
            ->whereNotIn('anime.id', $excludeIds)
            ->whereExists(function ($query) {
                $query->selectRaw('1')
                    ->from('episodes')
                    ->whereColumn('episodes.anime_id', 'anime.id');
            })
            ->groupBy('anime.id')
            ->orderByRaw('COUNT(*) DESC')
            ->offset($offset)
            ->limit($limit)
            ->select('anime.id')
            ->pluck('id');

        if ($animeRows->isEmpty()) {
            return [];
        }

        return Anime::query()->whereIn('id', $animeRows->all(), 'and', false)
            ->get()
            ->map(fn ($a) => [
                'id' => $a->id,
                'title' => $a->title,
                'poster_url' => $a->poster_url,
                'type' => $a->type,
                'rating' => $a->rating,
                'year' => $a->year,
                'relation_type' => null,
            ])
            ->toArray();
    }
}
