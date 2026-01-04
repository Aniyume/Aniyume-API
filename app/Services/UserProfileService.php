<?php

namespace App\Services;

use App\Models\User;
use App\Models\WatchHistory;
use Illuminate\Support\Facades\DB;

class UserProfileService
{
    public function getFullProfile(User $user): array
    {
        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'bio' => $user->bio,
                'custom_status' => $user->custom_status,
                'created_at' => $user->created_at,
            ],
            'stats' => $this->getAnimeStats($user->id),
            'watch_time' => $this->getWatchTime($user->id),
            'watch_dynamics' => $this->getWatchDynamics($user->id, 10),
            'recently_watched' => $this->getRecentlyWatched($user->id, 5),
            'counts' => [
                'anime_watching' => $this->countByStatus($user->id, 'watching'),
                'anime_planned' => $this->countByStatus($user->id, 'planned'),
                'anime_completed' => $this->countByStatus($user->id, 'completed'),
                'anime_on_hold' => $this->countByStatus($user->id, 'on_hold'),
                'anime_dropped' => $this->countByStatus($user->id, 'dropped'),
                'favorites' => $user->favorites()->count(),
                'ratings' => $user->ratings()->count(),
                'watch_history' => $user->watchHistory()->count(),
                 'comments' => DB::table('comments')->where('user_id', $user->id)->count(),
            ],
        ];
    }

    private function getAnimeStats(int $userId): array
    {
        $stats = DB::table('anime_user')
            ->where('user_id', $userId)
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return [
            'watching' => $stats->get('watching', 0),
            'planned' => $stats->get('planned', 0),
            'completed' => $stats->get('completed', 0),
            'on_hold' => $stats->get('on_hold', 0),
            'dropped' => $stats->get('dropped', 0),
        ];
    }

    private function countByStatus(int $userId, string $status): int
    {
        return DB::table('anime_user')
            ->where('user_id', $userId)
            ->where('status', $status)
            ->count();
    }

private function getWatchTime(int $userId): array
{
    $totalSeconds = WatchHistory::where('user_id', $userId)->sum('watch_time') ?? 0;
    $days = floor($totalSeconds / 86400);
    $hours = floor(($totalSeconds % 86400) / 3600);
    $minutes = floor(($totalSeconds % 3600) / 60);

    return [
        'total_seconds' => $totalSeconds,
        'days' => $days,
        'hours' => $hours,
        'minutes' => $minutes,
    ];
}

    private function getWatchDynamics(int $userId, int $days): array
    {
        $dynamics = DB::table('watch_history')
            ->where('user_id', $userId)
            ->where('watched_at', '>=', now()->subDays($days))
            ->select(
                DB::raw('DATE(watched_at) as date'),
                DB::raw('COUNT(*) as episodes_count')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date');

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $result[] = [
                'date' => $date,
                'episodes_count' => $dynamics->get($date)?->episodes_count ?? 0,
            ];
        }

        return $result;
    }

    private function getRecentlyWatched(int $userId, int $limit): array
    {
        return DB::table('watch_history')
            ->join('anime', 'watch_history.anime_id', '=', 'anime.id')
            ->leftJoin('episodes', 'watch_history.episode_id', '=', 'episodes.id')
            ->where('watch_history.user_id', $userId)
            ->select([
                'anime.id as anime_id',
                'anime.title',
                'anime.poster_url',
                'episodes.episode_number',
                'watch_history.watched_at as last_watched_at',
            ])
            ->orderBy('watch_history.watched_at', 'desc')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function updateProfile(User $user, array $data): User
    {
        $user->update(array_filter($data, fn ($value) => $value !== null));
        return $user->fresh();
    }

public function updateAvatar(User $user, string $avatarPath): User
{
    $user->update(['avatar' => $avatarPath]);
    return $user->fresh();
}
}
