<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserStatisticsService
{
    public function getStatistics(int $userId): array
    {
        $totalSeconds = $this->getTotalWatchTime($userId);

        return [
            'status_counts' => $this->getStatusCounts($userId),
            'episodes_watched' => $this->getTotalEpisodesWatched($userId),
            'total_watch_time' => $this->formatWatchTime($totalSeconds),
            'recent_ratings' => $this->getRecentRatings($userId, 3),
            'watch_dynamics' => $this->getWatchDynamics($userId, 10),
            'recently_watched' => $this->getRecentlyWatched($userId, 5),
            'comments_count' => $this->getTotalCommentsCount($userId),
        ];
    }

    public function getWatchEpisodesSummary(int $userId, int $days = 10): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        $dynamics = DB::table('watch_history')
            ->where('user_id', $userId)
            ->where('watched_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(watched_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('DATE(watched_at)'))
            ->get()
            ->keyBy('date');

        $episodesPerDay = [];
        $totalInPeriod = 0;

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = isset($dynamics[$date]) ? (int) $dynamics[$date]->count : 0;

            $episodesPerDay[] = [
                'date' => $date,
                'episodes_count' => $count,
            ];

            $totalInPeriod += $count;
        }

        $todayDate = Carbon::now()->format('Y-m-d');
        $totalToday = isset($dynamics[$todayDate]) ? (int) $dynamics[$todayDate]->count : 0;

        return [
            'total_episodes_today' => $totalToday,
            'episodes_per_day_last_10_days' => $episodesPerDay,
            'average_episodes_last_10_days' => $days > 0 ? round($totalInPeriod / $days, 2) : 0,
        ];
    }

    private function getStatusCounts(int $userId): array
    {
        $counts = DB::table('anime_user')
            ->where('user_id', $userId)
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return [
            'watching' => $counts['watching'] ?? 0,
            'planned' => $counts['planned'] ?? 0,
            'completed' => $counts['completed'] ?? 0,
            'on_hold' => $counts['on_hold'] ?? 0,
            'dropped' => $counts['dropped'] ?? 0,
        ];
    }

    private function getTotalEpisodesWatched(int $userId): int
    {
        $total = DB::table('anime_user')
            ->where('user_id', $userId)
            ->sum('episodes_watched');

        return (int) ($total ?? 0);
    }

 private function getTotalWatchTime(int $userId): int
{
    $total = DB::table('watch_history')
        ->where('user_id', $userId)
        ->sum('watch_time');

    return (int) ($total ?? 0);
}

    private function formatWatchTime(int $totalSeconds): array
    {
        $days = intdiv($totalSeconds, 60 * 60 * 24);
        $hours = intdiv($totalSeconds % (60 * 60 * 24), 60 * 60);
        $minutes = intdiv($totalSeconds % (60 * 60), 60);

        return [
            'total_seconds' => $totalSeconds,
            'days' => $days,
            'hours' => $hours,
            'minutes' => $minutes,
        ];
    }

    private function getRecentRatings(int $userId, int $limit): array
    {
        $ratings = DB::table('ratings')
            ->join('anime', 'ratings.anime_id', '=', 'anime.id')
            ->where('ratings.user_id', $userId)
            ->orderBy('ratings.created_at', 'desc')
            ->limit($limit)
            ->select([
                'anime.id as anime_id',
                'anime.title',
                'anime.poster_url',
                'ratings.rating',
                'ratings.created_at',
            ])
            ->get();

        return $ratings ? $ratings->toArray() : [];
    }

    private function getWatchDynamics(int $userId, int $days): array
    {
        $dynamics = DB::table('watch_history')
            ->where('user_id', $userId)
            ->where('watched_at', '>=', Carbon::now()->subDays($days))
            ->select(
                DB::raw('DATE(watched_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('DATE(watched_at)'))
            ->get()
            ->keyBy('date');

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = isset($dynamics[$date]) ? (int) $dynamics[$date]->count : 0;

            $result[] = [
                'date' => $date,
                'count' => $count,
            ];
        }

        return $result;
    }

    private function getRecentlyWatched(int $userId, int $limit): array
    {
        $watched = DB::table('watch_history')
            ->join('anime', 'watch_history.anime_id', '=', 'anime.id')
            ->where('watch_history.user_id', $userId)
            ->select([
                'anime.id as anime_id',
                'anime.title',
                'anime.poster_url',
                'watch_history.watched_at',
            ])
            ->orderBy('watch_history.watched_at', 'desc')
            ->limit(100)
            ->get()
            ->unique('anime_id')
            ->take($limit)
            ->values();

        return $watched ? $watched->toArray() : [];
    }

    private function getTotalCommentsCount(int $userId): int
    {
        return DB::table('comments')->where('user_id', $userId)->count();
    }
}
