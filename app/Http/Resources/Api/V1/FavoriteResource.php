<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'anime_id' => $this->anime_id,
            'created_at' => $this->created_at,
            'anime' => [
                'id' => $this->anime->id,
                'title' => $this->anime->title,
                'slug' => $this->anime->slug,
                'poster_url' => $this->anime->poster_url,
                'rating' => $this->anime->rating,
                'year' => $this->anime->year,
                'status' => $this->anime->status,
                'type' => $this->anime->type,
            ],
        ];
    }
}
