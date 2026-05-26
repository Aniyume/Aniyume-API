<?php

namespace App\Application\Queries;

use App\Models\WatchHistory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WatchHistoryQuery
{
    public function paginatedForUser(int $userId, int $perPage = 20): LengthAwarePaginator
    {
        return WatchHistory::query()
            ->where('user_id', $userId)
            ->with(['episode', 'episode.anime', 'anime'])
            ->orderByDesc('watched_at')
            ->paginate($perPage);
    }

    public function findForUser(int $userId, int $historyId): WatchHistory
    {
        return WatchHistory::query()
            ->where('user_id', $userId)
            ->where('id', $historyId)
            ->with('episode', 'anime')
            ->firstOrFail();
    }

    public function forAnime(int $userId, int $animeId): Collection
    {
        return WatchHistory::query()
            ->where('user_id', $userId)
            ->where('anime_id', $animeId)
            ->with('episode')
            ->orderByDesc('watched_at')
            ->get();
    }

    public function lastWatchedForAnime(int $userId, int $animeId): ?WatchHistory
    {
        return WatchHistory::query()
            ->where('user_id', $userId)
            ->where('anime_id', $animeId)
            ->with('episode')
            ->orderByDesc('watched_at')
            ->first();
    }
}
