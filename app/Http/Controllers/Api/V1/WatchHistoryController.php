<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWatchHistoryRequest;
use App\Http\Requests\UpdateWatchHistoryRequest;
use App\Http\Resources\Api\V1\WatchHistoryResource;
use App\Models\WatchHistory;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(StoreWatchHistoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $watchHistory = WatchHistory::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'anime_id' => $request->validated('anime_id'),
                    'episode_id' => $request->validated('episode_id'),
                ],
                [
                    'progress' => $request->validated('progress') ?? 0,
                    'completed' => $request->validated('completed') ?? false,
                    'watched_at' => now(),
                ]
            );

            if ($watchHistory->wasRecentlyCreated) {
                $anime = Anime::find($request->validated('anime_id'));
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
            ], 500);
        }
    }

    public function update(UpdateWatchHistoryRequest $request, WatchHistory $watchHistory)
    {
        $this->authorize('update', $watchHistory);

        $watchHistory->update([
            'progress' => $request->validated('progress') ?? $watchHistory->progress,
            'completed' => $request->validated('completed') ?? $watchHistory->completed,
            'watched_at' => now(),
        ]);

        $watchHistory->load(['anime', 'episode']);
        return new WatchHistoryResource($watchHistory);
    }

    public function destroy(Request $request, WatchHistory $watchHistory)
    {
        $this->authorize('delete', $watchHistory);

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
