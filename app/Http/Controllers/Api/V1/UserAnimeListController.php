<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAnimeStatusRequest;
use App\Models\Anime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserAnimeListController extends Controller
{
    public function updateStatus(Anime $anime, UpdateAnimeStatusRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        if ($validated['status'] === 'not_watching') {
            $user->animes()->detach($anime->id);

            return response()->json([
                'message' => 'Status removed successfully',
                'status' => 'not_watching',
            ]);
        }

        $user->animes()->syncWithoutDetaching([
            $anime->id => [
                'status' => $validated['status'],
                'episodes_watched' => 0,
                'updated_at' => now(),
            ],
        ]);

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $validated['status'],
        ]);
    }

    public function getUserStatus(Anime $anime): JsonResponse
    {
        $user = Auth::user();

        $status = $user->animes()
            ->where('anime_id', $anime->id)
            ->first();

        return response()->json([
            'status' => $status ? $status->pivot->status : 'not_watching',
            'episodes_watched' => $status ? $status->pivot->episodes_watched : 0,
            'last_watched_at' => $status ? $status->pivot->last_watched_at : null,
        ]);
    }

    public function updateEpisodesWatched(Anime $anime, int $episodesWatched): JsonResponse
    {
        $user = Auth::user();

        $user->animes()
            ->where('anime_id', $anime->id)
            ->updateExistingPivot($anime->id, [
                'episodes_watched' => $episodesWatched,
                'last_watched_at' => now(),
            ]);

        return response()->json([
            'message' => 'Episodes watched updated successfully',
            'episodes_watched' => $episodesWatched,
        ]);
    }

    public function getList(?string $status = null): JsonResponse
    {
        $user = Auth::user();

        $query = $user->animes();

        if ($status && $status !== 'all') {
            $query->wherePivot('status', $status);
        }

        $list = $query
            ->orderByPivot('updated_at', 'desc')
            ->paginate(20);

        return response()->json($list);
    }
}
