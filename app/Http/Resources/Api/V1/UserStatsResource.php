<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStatsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'watch_history' => [
                'total_watched' => $this->watchHistory()->count(),
                'completed_episodes' => $this->watchHistory()->where('completed', true)->count(),
                'unique_anime' => $this->watchHistory()->distinct('anime_id')->count('anime_id'),
                'recent_watches' => $this->getRecentWatches(),
            ],
            'favorites' => [
                'total' => $this->favorites()->count(),
                'list' => $this->getFavoritesList(),
            ],
            'ratings' => [
                'total' => $this->ratings()->count(),
                'average' => round($this->ratings()->avg('rating') ?? 0, 1),
                'distribution' => $this->getRatingDistribution(),
            ],
            'comments' => [
                'total' => $this->comments()->count(),
                'recent' => $this->getRecentComments(),
            ],
        ];
    }

    private function getRecentWatches(): array
    {
        return $this->watchHistory()
            ->with('anime:id,title,slug,poster_url')
            ->orderBy('watched_at', 'desc')
            ->limit(5)
            ->get()
            ->map(fn ($item) => [
                'anime' => [
                    'id' => $item->anime->id,
                    'title' => $item->anime->title,
                    'slug' => $item->anime->slug,
                    'poster_url' => $item->anime->poster_url,
                ],
                'watched_at' => $item->watched_at?->toISOString(),
                'completed' => $item->completed,
            ])
            ->all();
    }

    private function getFavoritesList(): array
    {
        return $this->favorites()
            ->with('anime:id,title,slug,poster_url,rating,year')
            ->latest()
            ->limit(10)
            ->get()
            ->map(fn ($item) => [
                'id' => $item->anime->id,
                'title' => $item->anime->title,
                'slug' => $item->anime->slug,
                'poster_url' => $item->anime->poster_url,
                'rating' => $item->anime->rating,
                'year' => $item->anime->year,
            ])
            ->all();
    }

    private function getRatingDistribution(): array
    {
        $distribution = $this->ratings()
            ->selectRaw('FLOOR(rating) as rating_group, COUNT(*) as count')
            ->groupBy('rating_group')
            ->orderBy('rating_group', 'desc')
            ->get()
            ->pluck('count', 'rating_group')
            ->toArray();

        return $distribution;
    }

    private function getRecentComments(): array
    {
        return $this->comments()
            ->with('anime:id,title,slug')
            ->latest()
            ->limit(5)
            ->get()
            ->map(fn ($item) => [
                'anime' => [
                    'id' => $item->anime->id,
                    'title' => $item->anime->title,
                    'slug' => $item->anime->slug,
                ],
                'comment' => $item->comment,
                'created_at' => $item->created_at?->toISOString(),
            ])
            ->all();
    }
}
