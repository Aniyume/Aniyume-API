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

        $existingEntry = DB::table('anime_user')
            ->where('user_id', $user->id)
            ->where('anime_id', $anime->id)
            ->first();

        $data = [
            'status' => $validated['status'],
            'updated_at' => now(),
        ];

        if ($validated['status'] === 'not_watching') {
            if ($existingEntry) {
                DB::table('anime_user')
                    ->where('user_id', $user->id)
                    ->where('anime_id', $anime->id)
                    ->delete();

                return response()->json([
                    'message' => 'Status removed successfully',
                    'status' => 'not_watching',
                ]);
            }
        } else {
            if ($existingEntry) {
                DB::table('anime_user')
                    ->where('user_id', $user->id)
                    ->where('anime_id', $anime->id)
                    ->update($data);
            } else {
                DB::table('anime_user')->insert([
                    'user_id' => $user->id,
                    'anime_id' => $anime->id,
                    'status' => $validated['status'],
                    'episodes_watched' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

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

        $query = DB::table('anime_user')
            ->join('anime', 'anime_user.anime_id', '=', 'anime.id')
            ->where('anime_user.user_id', $user->id);

        if ($status && $status !== 'all') {
            $query->where('anime_user.status', $status);
        }

        $list = $query->select([
            'anime.*',
            'anime_user.status',
            'anime_user.episodes_watched',
            'anime_user.last_watched_at',
        ])
            ->orderBy('anime_user.updated_at', 'desc')
            ->paginate(20);

        return response()->json($list);
    }
}
