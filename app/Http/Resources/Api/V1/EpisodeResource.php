<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
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
            'external_id' => $this->external_id,
            'external_source' => $this->external_source,
            'external_episode_id' => $this->external_episode_id,
            'aired_at' => $this->formatDateTime($this->aired_at),
            'release_date' => $this->formatDate($this->release_date),
            'duration' => $this->duration,
            'thumbnail_url' => $this->thumbnail_url,
            'poster_url' => $this->poster_url,
            'translator' => $this->translator,
            'translation_type' => $this->translation_type,
            'quality' => $this->quality,
            'source' => $this->source,
            'priority' => $this->priority,
            'anime' => new AnimeResource($this->whenLoaded('anime')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    private function formatDateTime($dateTime): ?string
    {
        if (! $dateTime) {
            return null;
        }

        return $dateTime instanceof Carbon ? $dateTime->toISOString() : Carbon::parse($dateTime)->toISOString();
    }

    private function formatDate($date): ?string
    {
        if (! $date) {
            return null;
        }

        return $date instanceof Carbon ? $date->format('Y-m-d') : Carbon::parse($date)->format('Y-m-d');
    }
}
