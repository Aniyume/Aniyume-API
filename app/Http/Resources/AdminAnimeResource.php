<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminAnimeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'poster_url' => $this->poster_url,
            'rating' => $this->rating !== null ? (float) $this->rating : null,
            'status' => $this->status,
            'type' => $this->type,
            'year' => $this->year,
            'nsfw_flag' => (bool) $this->nsfw_flag,
            'external_id' => $this->external_id,
            'external_source' => $this->external_source,
            'episodes_count' => $this->episodes_count ?? $this->number_of_episodes,
            'number_of_episodes' => $this->number_of_episodes,
            'tags' => $this->whenLoaded('tags', fn () => $this->tags->map(fn ($tag) => [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
            ])->values()->all(), []),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
