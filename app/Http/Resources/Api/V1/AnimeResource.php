<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'title_en' => $this->title_en,
            'title_jp' => $this->title_jp,
            'description' => $this->description,
            'poster_url' => $this->poster_url,
            'cover_url' => $this->cover_url,
            'rating' => $this->rating,
            'year' => $this->release_year,
            'status' => $this->status,
            'type' => $this->type,
            'number_of_episodes' => $this->episodes_count,
            'duration' => $this->duration,
            'aired_from' => $this->formatDate($this->aired_from),
            'aired_to' => $this->formatDate($this->aired_to),
            'popularity' => $this->popularity,
            'favorites' => $this->favorites_count,
            'external_id' => $this->external_id,
            'external_source' => $this->shikimori_id ? 'shikimori' : null,
            'views_count' => $this->views_count,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'episodes' => EpisodeResource::collection($this->whenLoaded('episodes')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    private function formatDate($date): ?string
    {
        if (!$date) {
            return null;
        }

        if ($date instanceof Carbon) {
            return $date->format('Y-m-d');
        }

        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
