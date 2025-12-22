<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function getFullProfile(Request $request)
    {
        $user = $request->user();

        $statsRaw = DB::table('anime_user')
            ->where('user_id', $user->id)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        $stats = [
            'watching' => $statsRaw['watching'] ?? 0,
            'planned' => $statsRaw['planned'] ?? 0,
            'completed' => $statsRaw['completed'] ?? 0,
            'on_hold' => $statsRaw['on_hold'] ?? 0,
            'dropped' => $statsRaw['dropped'] ?? 0,
        ];

        $totalEpisodes = DB::table('watch_history')->where('user_id', $user->id)->count();
        $totalMinutes = $totalEpisodes * 24;
        $days = floor($totalMinutes / 1440);
        $hours = floor(($totalMinutes % 1440) / 60);

        $dynamics = [];
        for ($i = 9; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = DB::table('watch_history')
                ->where('user_id', $user->id)
                ->whereDate('watched_at', $date)
                ->count();

            $dynamics[] = [
                'date' => Carbon::parse($date)->format('d.m'),
                'count' => $count,
            ];
        }

        $recent = DB::table('watch_history')
            ->join('anime', 'watch_history.anime_id', '=', 'anime.id')
            ->where('watch_history.user_id', $user->id)
            ->select('watch_history.*', 'anime.title', 'anime.poster_url')
            ->orderBy('watch_history.watched_at', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar,
                'custom_status' => $user->custom_status,
                'comments_count' => DB::table('comments')->where('user_id', $user->id)->count(),
                'friends_count' => 0,
            ],
            'stats' => $stats,
            'total_episodes' => $totalEpisodes,
            'total_time' => [
                'days' => $days,
                'hours' => $hours,
            ],
            'dynamics' => $dynamics,
            'recent' => $recent,
        ]);
    }
}