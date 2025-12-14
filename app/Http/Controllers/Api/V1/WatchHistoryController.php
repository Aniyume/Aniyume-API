<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\WatchHistoryResource;
use App\Models\WatchHistory;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WatchHistoryController extends Controller
{
    public function index(Request $request)
    {
        $history = WatchHistory::with(['anime', 'episode'])
            ->where('user_id', $request->user()->id)
            ->orderBy('watched_at', 'desc')
            ->paginate(20);

        return WatchHistoryResource::collection($history);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anime_id' => 'required|exists:anime,id',
            'episode_id' => 'required|exists:episodes,id',
            'progress' => 'nullable|integer|min:0',
            'completed' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $watchHistory = WatchHistory::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'anime_id' => $request->anime_id,
                    'episode_id' => $request->episode_id,
                ],
                [
                    'progress' => $request->progress ?? 0,
                    'completed' => $request->completed ?? false,
                    'watched_at' => now(),
                ]
            );

            if ($watchHistory->wasRecentlyCreated) {
                $anime = Anime::find($request->anime_id);
                $anime->increment('viewed_count');
                $anime->increment('popularity');
            }

            DB::commit();

            $watchHistory->load(['anime', 'episode']);
            return new WatchHistoryResource($watchHistory);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to add to watch history',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, WatchHistory $watchHistory)
    {
        if ($watchHistory->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'progress' => 'nullable|integer|min:0',
            'completed' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $watchHistory->update([
            'progress' => $request->progress ?? $watchHistory->progress,
            'completed' => $request->completed ?? $watchHistory->completed,
            'watched_at' => now(),
        ]);

        $watchHistory->load(['anime', 'episode']);
        return new WatchHistoryResource($watchHistory);
    }

    public function destroy(Request $request, WatchHistory $watchHistory)
    {
        if ($watchHistory->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $watchHistory->delete();

        return response()->json([
            'message' => 'Watch history deleted successfully'
        ], 200);
    }

    public function getByAnime(Request $request, $animeId)
    {
        $history = WatchHistory::with(['episode'])
            ->where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->orderBy('watched_at', 'desc')
            ->get();

        return WatchHistoryResource::collection($history);
    }
}
