<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function stats(Request $request)
    {
        $user = $request->user();

        $stats = [
            'watch_history' => [
                'total_watched' => $user->watchHistory()->count(),
                'completed_episodes' => $user->watchHistory()->where('completed', true)->count(),
                'unique_anime' => $user->watchHistory()->distinct('anime_id')->count('anime_id'),
                'recent_watches' => $user->watchHistory()
                    ->with('anime:id,title,slug,poster_url')
                    ->orderBy('watched_at', 'desc')
                    ->limit(5)
                    ->get()
                    ->map(fn($item) => [
                        'anime' => $item->anime,
                        'watched_at' => $item->watched_at,
                        'completed' => $item->completed,
                    ]),
            ],
            'favorites' => [
                'total' => $user->favorites()->count(),
                'list' => $user->favorites()
                    ->with('anime:id,title,slug,poster_url,rating,year')
                    ->latest()
                    ->limit(10)
                    ->get()
                    ->map(fn($item) => $item->anime),
            ],
            'ratings' => [
                'total' => $user->ratings()->count(),
                'average' => round($user->ratings()->avg('rating'), 1),
                'distribution' => $user->ratings()
                    ->select(DB::raw('FLOOR(rating) as rating_group, COUNT(*) as count'))
                    ->groupBy('rating_group')
                    ->orderBy('rating_group', 'desc')
                    ->get()
                    ->pluck('count', 'rating_group'),
            ],
            'comments' => [
                'total' => $user->comments()->count(),
                'recent' => $user->comments()
                    ->with('anime:id,title,slug')
                    ->latest()
                    ->limit(5)
                    ->get()
                    ->map(fn($item) => [
                        'anime' => $item->anime,
                        'comment' => $item->comment,
                        'created_at' => $item->created_at,
                    ]),
            ],
        ];

        return response()->json($stats);
    }

    public function activity(Request $request)
    {
        $user = $request->user();
        $days = $request->get('days', 30);

        $activity = [
            'watch_history' => $user->watchHistory()
                ->where('watched_at', '>=', now()->subDays($days))
                ->selectRaw('DATE(watched_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get(),
            'comments' => $user->comments()
                ->where('created_at', '>=', now()->subDays($days))
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get(),
            'ratings' => $user->ratings()
                ->where('created_at', '>=', now()->subDays($days))
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get(),
        ];

        return response()->json($activity);
    }
}
