<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAnimeStatusRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Список аниме пользователя
 *
 * Управление личным списком аниме (статусы "Смотрю", "В планах" и т.д.)
 * @authenticated
 */
class UserAnimeListController extends Controller
{
    /**
     * Получить мой список аниме
     *
     * Возвращает аниме из списка пользователя, отфильтрованные по статусу.
     * @urlParam status string Статус (watching, planned, completed, on_hold, dropped, all). Example: watching
     * @queryParam per_page integer Количество записей. Example: 100
     */
    public function getList(Request $request, ?string $status = null): JsonResponse
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 100);

        $query = $user->animeList();

        if ($status && $status !== 'all') {
            $validStatuses = ['watching', 'planned', 'completed', 'on_hold', 'dropped'];
            if (in_array($status, $validStatuses)) {
                $query->wherePivot('status', $status);
            }
        }

        $anime = $query->paginate($perPage);

        $data = $anime->getCollection()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'title_russian' => $item->title_russian,
                'poster_url' => $item->poster_url,
                'status' => $item->pivot->status,
                'episodes_watched' => $item->pivot->episodes_watched,
            ];
        });

        return response()->json([
            'data' => $data,
            'pagination' => [
                'total' => $anime->total(),
                'current_page' => $anime->currentPage(),
                'last_page' => $anime->lastPage(),
            ],
        ]);
    }

    /**
     * Статус конкретного аниме в моем списке
     * @urlParam anime integer ID аниме. Example: 3
     */
    public function getUserStatus(Request $request, int $anime): JsonResponse
    {
        $user = $request->user();

        $userAnime = $user->animeList()
            ->where('anime_id', $anime)
            ->first();

        if (!$userAnime) {
            return response()->json([
                'status' => 'not_watching',
                'episodes_watched' => 0,
            ]);
        }

        return response()->json([
            'status' => $userAnime->pivot->status,
            'episodes_watched' => $userAnime->pivot->episodes_watched,
        ]);
    }

    /**
     * Обновить статус аниме
     * @urlParam anime integer ID аниме. Example: 3
     * @bodyParam status string required Статус (watching, planned, completed, on_hold, dropped, not_watching). Example: watching
     */
    public function updateStatus(UpdateAnimeStatusRequest $request, int $anime): JsonResponse
    {
        $user = $request->user();
        $status = $request->input('status');

        if ($status === 'not_watching') {
            $user->animeList()->detach($anime);
            return response()->json([
                'message' => 'Anime removed from list',
                'status' => 'not_watching',
            ]);
        }

        $user->animeList()->syncWithoutDetaching([
            $anime => [
                'status' => $status,
            ],
        ]);

        return response()->json([
            'message' => 'Status updated',
            'status' => $status,
        ]);
    }

    /**
     * Обновить количество просмотренных серий
     * @urlParam anime integer ID аниме. Example: 3
     * @urlParam episodesWatched integer Количество серий. Example: 12
     */
    public function updateEpisodesWatched(Request $request, int $anime, int $episodesWatched): JsonResponse
    {
        $user = $request->user();

        if ($episodesWatched < 0) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => [
                    'episodes_watched' => ['Episodes watched must be greater or equal 0.'],
                ],
            ], 422);
        }

        $userAnime = $user->animeList()
            ->where('anime_id', $anime)
            ->first();

        if (!$userAnime) {
            return response()->json(['message' => 'Anime not in list'], 404);
        }

        $user->animeList()->updateExistingPivot($anime, [
            'episodes_watched' => $episodesWatched,
        ]);

        return response()->json([
            'message' => 'Episodes watched updated',
            'episodes_watched' => $episodesWatched,
        ]);
    }
}
