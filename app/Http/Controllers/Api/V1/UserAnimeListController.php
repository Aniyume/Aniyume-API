<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAnimeStatusRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAnimeListController extends Controller
{
    public function getList(Request $request, ?string $status = null): JsonResponse
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 20);

        $query = $user->animeList()->with('pivot');

        if ($status) {
            $validStatuses = ['watching', 'planned', 'completed', 'on_hold', 'dropped'];
            if (!in_array($status, $validStatuses)) {
                return response()->json([
                    'message' => 'Invalid status',
                    'valid_statuses' => $validStatuses,
                ], 400);
            }
            $query->wherePivot('status', $status);
        }

        $anime = $query->paginate($perPage);

        $data = $anime->map(function ($item) {
            return [
                'anime_id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'poster_url' => $item->poster_url,
                'status' => $item->pivot->status,
                'episodes_watched' => $item->pivot->episodes_watched,
                'last_watched_at' => $item->pivot->last_watched_at,
            ];
        })->values();

        return response()->json([
            'data' => $data,
            'pagination' => [
                'total' => $anime->total(),
                'per_page' => $anime->perPage(),
                'current_page' => $anime->currentPage(),
                'last_page' => $anime->lastPage(),
            ],
        ]);
    }

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
                'last_watched_at' => null,
            ]);
        }

        return response()->json([
            'status' => $userAnime->pivot->status,
            'episodes_watched' => $userAnime->pivot->episodes_watched,
            'last_watched_at' => $userAnime->pivot->last_watched_at,
        ]);
    }

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
