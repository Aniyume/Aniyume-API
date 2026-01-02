<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AnimeResource;
use App\Http\Resources\EpisodeResource;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

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
     * @queryParam status string Статус (finished, releasing). Example: finished
     * @queryParam year integer Год выпуска. Example: 2023
     * @queryParam search string Поиск по названию или слагу. Example: Attack
     * @queryParam sort string Сортировка (rating, popularity, newest, title). Example: rating
     */
    public function index(Request $request)
    {
        $query = Anime::query()
            ->with(['tags'])
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('year'), fn ($q) => $q->where('year', $request->year))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($subQ) use ($request) {
                    $subQ->where('title', 'ILIKE', "%{$request->search}%")
                        ->orWhere('slug', 'ILIKE', "%{$request->search}%");
                });
            });

        if ($request->has('sort')) {
            $sortMap = [
                'rating' => ['rating', 'DESC'],
                'popularity' => ['popularity', 'DESC'],
                'newest' => ['aired_from', 'DESC'],
                'title' => ['title', 'ASC'],
            ];

            $sort = $sortMap[$request->sort] ?? ['id', 'ASC'];
            $query->orderByRaw("{$sort[0]} {$sort[1]} NULLS LAST");
        } else {
            $query->orderBy('id', 'ASC');
        }

        $anime = $query->paginate(20);

        return AnimeResource::collection($anime);
    }

    /**
     * Детальная информация об аниме
     *
     * @urlParam anime integer ID аниме. Example: 3
     */
    public function show(Anime $anime)
    {
        $anime->load(['tags', 'episodes']);
        return new AnimeResource($anime);
    }

    /**
     * Список эпизодов аниме
     *
     * @urlParam anime integer ID аниме. Example: 3
     */
    public function episodes(Anime $anime)
    {
        $episodes = $anime->episodes()
            ->orderBy('season_number')
            ->orderBy('episode_number')
            ->paginate(50);

        return EpisodeResource::collection($episodes);
    }

    /**
     * Информация о конкретном эпизоде
     *
     * @urlParam anime integer ID аниме. Example: 3
     * @urlParam episode integer ID эпизода. Example: 550
     */
    public function episode(Anime $anime, Episode $episode)
    {
        if ($episode->anime_id !== $anime->id) {
            abort(404);
        }

        return new EpisodeResource($episode);
    }

    /**
     * Поиск аниме (алиас списка)
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Обновить статус просмотра
     *
     * Изменяет статус аниме в списке пользователя (требуется авторизация).
     *
     * @authenticated
     * @urlParam anime integer ID аниме. Example: 3
     * @bodyParam status string required Статус (watching, planned, completed, on_hold, dropped). Example: watching
     */
    public function updateStatus(Request $request, Anime $anime)
    {
        $user = $request->user();
        $status = $request->input('status');
        $validStatuses = ['watching', 'planned', 'completed', 'on_hold', 'dropped'];

        if ($status && !in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 422);
        }

        try {
            if ($status === null) {
                $user->animes()->detach($anime->id);
            } else {
                $user->animes()->syncWithoutDetaching([
                    $anime->id => ['status' => $status, 'updated_at' => now()],
                ]);
            }

            return response()->json(['success' => true, 'status' => $status]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
     * Статус аниме у текущего пользователя
     *
     * @authenticated
     */
    public function getUserStatus(Request $request, Anime $anime)
    {
        $user = $request->user();
        $pivot = \DB::table('anime_user')
            ->where('user_id', $user->id)
            ->where('anime_id', $anime->id)
            ->first();

        return response()->json([
            'status' => $pivot?->status,
            'found' => $pivot !== null,
        ]);
    }
}
