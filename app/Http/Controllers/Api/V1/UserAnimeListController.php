<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAnimeStatusRequest;
use App\Models\Anime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAnimeListController extends Controller
{
    public function updateStatus(Anime $anime, UpdateAnimeStatusRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        if ($validated['status'] === 'not_watching') {
            DB::table('anime_user')
                ->where('user_id', $user->id)
                ->where('anime_id', $anime->id)
                ->delete();

            return response()->json([
                'message' => 'Status removed successfully',
                'status' => 'not_watching',
            ]);
        }

        DB::table('anime_user')->updateOrInsert(
            ['user_id' => $user->id, 'anime_id' => $anime->id],
            [
                'status' => $validated['status'],
                'episodes_watched' => 0,
                'updated_at' => now(),
            ]
        );

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $validated['status'],
        ]);
    }

    public function getUserStatus(Anime $anime): JsonResponse
    {
        $user = Auth::user();

        $status = DB::table('anime_user')
            ->where('user_id', $user->id)
            ->where('anime_id', $anime->id)
            ->first();

        return response()->json([
            'status' => $status ? $status->status : 'not_watching',
            'episodes_watched' => $status ? $status->episodes_watched : 0,
            'last_watched_at' => $status ? $status->last_watched_at : null,
        ]);
    }

    public function updateEpisodesWatched(Anime $anime, int $episodesWatched): JsonResponse
    {
        $user = Auth::user();

        DB::table('anime_user')
            ->where('user_id', $user->id)
            ->where('anime_id', $anime->id)
            ->update([
                'episodes_watched' => $episodesWatched,
                'last_watched_at' => now(),
                'updated_at' => now(),
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