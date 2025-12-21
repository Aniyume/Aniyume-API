<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\WatchHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WatchHistoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $history = WatchHistory::where('user_id', auth()->id())
            ->with(['episode', 'episode.anime'])
            ->orderByDesc('updated_at')
            ->paginate(20);

        return response()->json($history);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'episode_id' => 'required|integer|exists:episodes,id',
            'watched_seconds' => 'nullable|integer|min:0',
        ]);

        $episode = Episode::findOrFail($validated['episode_id']);

        $watchHistory = WatchHistory::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'episode_id' => $validated['episode_id'],
            ],
            [
                'anime_id' => $episode->anime_id,
                'watched_seconds' => $validated['watched_seconds'] ?? 0,
                'watched_at' => now(),
            ]
        );

        return response()->json($watchHistory->load('episode', 'episode.anime'), 201);
    }

    public function show($id): JsonResponse
    {
        $watchHistory = WatchHistory::where('user_id', auth()->id())
            ->where('id', $id)
            ->with('episode', 'episode.anime')
            ->firstOrFail();

        return response()->json($watchHistory);
    }

    public function destroy($id): JsonResponse
    {
        $watchHistory = WatchHistory::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $watchHistory->delete();

        return response()->json(['message' => 'Removed from watch history']);
    }

    public function getByAnime($anime_id): JsonResponse
    {
        $watchHistory = WatchHistory::where('user_id', auth()->id())
            ->where('anime_id', $anime_id)
            ->with('episode')
            ->orderByDesc('watched_at')
            ->get();

        if ($watchHistory->isEmpty()) {
            return response()->json([
                'anime_id' => $anime_id,
                'history' => [],
                'last_watched' => null,
                'last_episode' => null,
            ]);
        }

        $lastWatched = $watchHistory->first();

        return response()->json([
            'anime_id' => $anime_id,
            'history' => $watchHistory,
            'last_watched' => $lastWatched->watched_at,
            'last_episode' => $lastWatched->episode->episode_number ?? null,
            'total_watched' => $watchHistory->count(),
        ]);
    }

    public function getLastWatchedEpisode($anime_id): JsonResponse
    {
        $lastWatched = WatchHistory::where('user_id', auth()->id())
            ->where('anime_id', $anime_id)
            ->with('episode')
            ->orderByDesc('watched_at')
            ->first();

        if (! $lastWatched) {
            return response()->json([
                'anime_id' => $anime_id,
                'last_episode' => null,
                'watched_at' => null,
            ]);
        }

        return response()->json([
            'anime_id' => $anime_id,
            'last_episode' => $lastWatched->episode->episode_number,
            'episode_id' => $lastWatched->episode_id,
            'watched_at' => $lastWatched->watched_at,
            'watched_seconds' => $lastWatched->watched_seconds,
        ]);
    }
}
