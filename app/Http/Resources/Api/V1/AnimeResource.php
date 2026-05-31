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
            'slug' => $this->slug,
            'description' => $this->description,
            'poster_url' => $this->poster_url,
            'rating' => $this->rating,
            'year' => $this->year,
            'status' => $this->status,
            'type' => $this->type,
            'number_of_episodes' => $this->number_of_episodes,
            'episodes_count' => (int) ($this->episodes_count ?? 0),
            'aired_from' => $this->formatDate($this->aired_from),
            'aired_to' => $this->formatDate($this->aired_to),
            'nsfw_flag' => $this->nsfw_flag,
            'popularity' => $this->popularity,
            'favorites' => $this->favorites,
            'external_id' => $this->external_id,
            'external_source' => $this->external_source,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    private function formatDate($date): ?string
    {
        if (! $date) {
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
