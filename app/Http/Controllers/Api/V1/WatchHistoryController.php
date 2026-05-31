<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Actions\WatchHistory\SyncWatchProgressAction;
use App\Application\Queries\WatchHistoryQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateWatchHistoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group История просмотров
 *
 * @authenticated
 */
class WatchHistoryController extends Controller
{
    public function __construct(
        private readonly WatchHistoryQuery $watchHistoryQuery,
        private readonly SyncWatchProgressAction $syncWatchProgress,
    ) {}

    /**
     * Список истории
     */
    public function index(Request $request): JsonResponse
    {
        $history = $this->watchHistoryQuery->paginatedForUser($request->user()->id);

        return response()->json([
            'data' => $history->items(),
            'pagination' => [
                'total' => $history->total(),
                'per_page' => $history->perPage(),
                'current_page' => $history->currentPage(),
                'last_page' => $history->lastPage(),
            ],
        ]);
    }

    /**
     * Сохранить прогресс просмотра
     *
     * @bodyParam episode_id integer required ID эпизода. Example: 550
     * @bodyParam progress integer required Время в секундах. Example: 120
     * @bodyParam completed boolean Флаг завершения. Example: false
     */
    public function store(UpdateWatchHistoryRequest $request): JsonResponse
    {
        $watchHistory = $this->syncWatchProgress->execute(
            $request->user()->id,
            $request->validated()
        );

        return response()->json([
            'message' => 'Time recorded',
            'total_playtime' => $watchHistory->watch_time,
            'progress' => $watchHistory->progress,
        ], 200);
    }

    /**
     * Детали записи истории
     *
     * @urlParam id integer ID записи в истории. Example: 10
     */
    public function show(Request $request, $id): JsonResponse
    {
        $watchHistory = $this->watchHistoryQuery->findForUser($request->user()->id, (int) $id);

        return response()->json($watchHistory);
    }

    /**
     * Удалить из истории
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        $watchHistory = $this->watchHistoryQuery->findForUser($request->user()->id, (int) $id);

        $watchHistory->deleteOrFail();

        return response()->json(['message' => 'Watch history removed'], 200);
    }

    /**
     * История по конкретному аниме
     *
     * @urlParam animeId integer ID аниме. Example: 3
     */
    public function getByAnime(Request $request, $animeId): JsonResponse
    {
        $watchHistory = $this->watchHistoryQuery->forAnime($request->user()->id, (int) $animeId);

        if ($watchHistory->isEmpty()) {
            return response()->json([
                'anime_id' => $animeId,
                'history' => [],
                'last_watched' => null,
                'last_episode' => null,
                'total_watched' => 0,
            ]);
        }

        $lastWatched = $watchHistory->first();

        return response()->json([
            'anime_id' => $animeId,
            'history' => $watchHistory,
            'last_watched' => $lastWatched->watched_at,
            'last_episode' => $lastWatched->episode?->episode_number,
            'total_watched' => $watchHistory->count(),
        ]);
    }

    /**
     * Последний просмотренный эпизод аниме
     *
     * @urlParam animeId integer ID аниме. Example: 3
     */
    public function getLastWatchedEpisode(Request $request, $animeId): JsonResponse
    {
        $lastWatched = $this->watchHistoryQuery->lastWatchedForAnime($request->user()->id, (int) $animeId);

        if (! $lastWatched) {
            return response()->json([
                'anime_id' => $animeId,
                'last_episode' => null,
                'episode_id' => null,
                'watched_at' => null,
                'progress' => null,
            ]);
        }

        return response()->json([
            'anime_id' => $animeId,
            'last_episode' => $lastWatched->episode->episode_number,
            'episode_id' => $lastWatched->episode_id,
            'watched_at' => $lastWatched->watched_at,
            'progress' => $lastWatched->progress,
        ]);
    }
}
