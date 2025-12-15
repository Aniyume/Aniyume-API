<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'anime_id' => $this->anime_id,
            'title' => $this->title,
            'episode_number' => $this->episode_number,
            'season_number' => $this->season_number,
            'duration' => $this->duration,
            'aired_date' => $this->aired_date,
            'translator' => $this->translator,
            'translation_type' => $this->translation_type,
            'quality' => $this->quality,
            'player_url' => $this->player_url,
            'player_iframe' => $this->player_iframe,
            'thumbnail_url' => $this->thumbnail_url,
            'poster_url' => $this->poster_url,
            'description' => $this->description,
            'source' => $this->source,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'anime' => [
                'id' => $this->anime->id,
                'title' => $this->anime->title,
                'slug' => $this->anime->slug,
                'poster_url' => $this->anime->poster_url,
            ],
        ];
    }
}
