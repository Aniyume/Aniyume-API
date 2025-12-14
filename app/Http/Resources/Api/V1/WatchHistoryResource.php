<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WatchHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'anime_id' => $this->anime_id,
            'episode_id' => $this->episode_id,
            'progress' => $this->progress,
            'completed' => $this->completed,
            'watched_at' => $this->watched_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'anime' => [
                'id' => $this->anime->id,
                'title' => $this->anime->title,
                'slug' => $this->anime->slug,
                'poster_url' => $this->anime->poster_url,
            ],
            'episode' => $this->episode ? [
                'id' => $this->episode->id,
                'episode_number' => $this->episode->episode_number,
                'season_number' => $this->episode->season_number,
                'title' => $this->episode->title,
            ] : null,
        ];
    }
}
