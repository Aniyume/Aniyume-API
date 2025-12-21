<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserStatisticsController extends Controller
{
    public function getStatistics($userId = null): JsonResponse
    {
        $user = $userId ? \App\Models\User::findOrFail($userId) : Auth::user();

        $statistics = [
            'status_counts' => $this->getStatusCounts($user->id),
            'episodes_watched' => $this->getTotalEpisodesWatched($user->id),
            'total_watch_time' => $this->getTotalWatchTime($user->id),
            'recent_ratings' => $this->getRecentRatings($user->id, 3),
            'watch_dynamics' => $this->getWatchDynamics($user->id, 10),
            'recently_watched' => $this->getRecentlyWatched($user->id, 5),
            'counts' => [
                'comments' => $user->comments()->count(),
                'videos' => $user->videos()->count(),
                'collections' => $user->collections()->count(),
                'friends' => $user->friends()->count(),
            ],
        ];

        return response()->json($statistics);
    }

    private function getStatusCounts(int $userId): array
    {
        $counts = DB::table('anime_user')
            ->where('user_id', $userId)
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return [
            'watching' => $counts->get('watching', 0),
            'planned' => $counts->get('planned', 0),
            'completed' => $counts->get('completed', 0),
            'on_hold' => $counts->get('on_hold', 0),
            'dropped' => $counts->get('dropped', 0),
        ];
    }

    private function getTotalEpisodesWatched(int $userId): int
    {
        return DB::table('anime_user')
            ->where('user_id', $userId)
            ->sum('episodes_watched');
    }

    private function getTotalWatchTime(int $userId): int
    {
        return DB::table('anime_user')
            ->join('anime', 'anime_user.anime_id', '=', 'anime.id')
            ->where('anime_user.user_id', $userId)
            ->sum(DB::raw('anime_user.episodes_watched * anime.duration'));
    }

    private function getRecentRatings(int $userId, int $limit): array
    {
        return DB::table('ratings')
            ->join('anime', 'ratings.anime_id', '=', 'anime.id')
            ->where('ratings.user_id', $userId)
            ->orderBy('ratings.created_at', 'desc')
            ->limit($limit)
            ->select([
                'anime.id as anime_id',
                'anime.title',
                'anime.poster_url',
                'ratings.score',
                'ratings.review',
                'ratings.created_at',
            ])
            ->get()
            ->toArray();
    }

    private function getWatchDynamics(int $userId, int $days): array
    {
        $dynamics = DB::table('watch_history')
            ->where('user_id', $userId)
            ->where('watched_at', '>=', now()->subDays($days))
            ->select(
                DB::raw('DATE(watched_at) as date'),
                DB::raw('COUNT(DISTINCT episode_id) as episodes_count')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date')
            ->toArray();

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $result[] = [
                'date' => $date,
                'episodes_count' => $dynamics[$date]->episodes_count ?? 0,
            ];
        }

        return $result;
    }

    private function getRecentlyWatched(int $userId, int $limit): array
    {
        return DB::table('watch_history')
            ->join('episodes', 'watch_history.episode_id', '=', 'episodes.id')
            ->join('anime', 'episodes.anime_id', '=', 'anime.id')
            ->leftJoin('anime_user', function ($join) use ($userId) {
                $join->on('anime_user.anime_id', '=', 'anime.id')
                    ->where('anime_user.user_id', '=', $userId);
            })
            ->where('watch_history.user_id', $userId)
            ->orderBy('watch_history.watched_at', 'desc')
            ->limit($limit)
            ->select([
                'anime.id as anime_id',
                'anime.title',
                'anime.poster_url',
                'episodes.episode_number',
                'anime_user.episodes_watched',
                'anime.episodes_count as total_episodes',
                'watch_history.watched_at',
            ])
            ->get()
            ->toArray();
    }
}
