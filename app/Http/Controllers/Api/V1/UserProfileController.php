<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserStatsResource;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function stats(Request $request)
    {
        return new UserStatsResource($request->user());
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
                ->get()
                ->map(fn($item) => [
                    'date' => $item->date,
                    'count' => $item->count,
                ]),
            'comments' => $user->comments()
                ->where('created_at', '>=', now()->subDays($days))
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get()
                ->map(fn($item) => [
                    'date' => $item->date,
                    'count' => $item->count,
                ]),
            'ratings' => $user->ratings()
                ->where('created_at', '>=', now()->subDays($days))
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get()
                ->map(fn($item) => [
                    'date' => $item->date,
                    'count' => $item->count,
                ]),
        ];

        return response()->json($activity);
    }
}
