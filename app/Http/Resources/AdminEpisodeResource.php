<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminEpisodeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'anime_id' => $this->anime_id,
            'episode_number' => $this->episode_number,
            'season_number' => $this->season_number,
            'title' => $this->title,
            'player_url' => $this->player_url,
            'player_iframe' => $this->player_iframe,
            'aired_at' => $this->aired_at?->toISOString(),
            'release_date' => $this->release_date?->toDateString(),
            'duration' => $this->duration,
            'thumbnail_url' => $this->thumbnail_url,
            'translator' => $this->translator,
            'translation_type' => $this->translation_type,
            'quality' => $this->quality,
            'source' => $this->source,
            'priority' => $this->priority,
            'anime' => $this->whenLoaded('anime', fn () => $this->anime ? [
                'id' => $this->anime->id,
                'title' => $this->anime->title,
                'slug' => $this->anime->slug,
                'poster_url' => $this->anime->poster_url,
            ] : null),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
