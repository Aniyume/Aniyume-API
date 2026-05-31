<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminRatingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rating' => (float) $this->rating,
            'user' => $this->whenLoaded('user', fn () => $this->user ? [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'is_banned' => (bool) ($this->user->is_banned ?? false),
            ] : null),
            'anime' => $this->whenLoaded('anime', fn () => $this->anime ? [
                'id' => $this->anime->id,
                'title' => $this->anime->title,
                'slug' => $this->anime->slug,
                'poster_url' => $this->anime->poster_url,
                'rating' => $this->anime->rating,
            ] : null),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
