<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateWatchHistoryRequest;
use App\Models\Episode;
use App\Models\WatchHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WatchHistoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $history = WatchHistory::where('user_id', $request->user()->id)
            ->with(['episode', 'episode.anime', 'anime'])
            ->orderByDesc('watched_at')
            ->paginate(20);

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

    public function store(UpdateWatchHistoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $userId = $request->user()->id;
        $episode = Episode::findOrFail($validated['episode_id']);

        $watchHistory = WatchHistory::updateOrCreate(
            ['user_id' => $userId, 'episode_id' => $validated['episode_id']],
            [
                'anime_id' => $episode->anime_id,
                'progress' => $validated['progress'] ?? 0,
                'completed' => $validated['completed'] ?? false,
                'watched_at' => now(),
            ]
        );

        return response()->json([
            'message' => 'Watch history recorded',
            'data' => $watchHistory,
        ], 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $watchHistory = WatchHistory::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->with('episode', 'anime')
            ->firstOrFail();

        return response()->json($watchHistory);
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $watchHistory = WatchHistory::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $watchHistory->delete();
        return response()->json(['message' => 'Watch history removed'], 200);
    }

    public function getByAnime(Request $request, $animeId): JsonResponse
    {
        $watchHistory = WatchHistory::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->with('episode')
            ->orderByDesc('watched_at')
            ->get();

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

    public function getLastWatchedEpisode(Request $request, $animeId): JsonResponse
    {
        $lastWatched = WatchHistory::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->with('episode')
            ->orderByDesc('watched_at')
            ->first();

        if (!$lastWatched) {
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
