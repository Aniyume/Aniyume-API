<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'anime_id' => $this->anime_id,
            'comment' => $this->comment,
            'is_approved' => $this->is_approved,
            'parent_id' => $this->parent_id,
            'likes_count' => (int) ($this->likes_count ?? $this->reactions_count_like ?? 0),
            'dislikes_count' => (int) ($this->dislikes_count ?? $this->reactions_count_dislike ?? 0),
            'viewer_reaction' => $this->viewer_reaction ?? null,
            'admin_hearted' => (bool) $this->admin_hearted_at,
            'admin_hearted_at' => $this->admin_hearted_at?->toISOString(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'avatar' => $this->user->avatar,
            ]),
            'anime' => $this->whenLoaded('anime', fn () => [
                'id' => $this->anime->id,
                'title' => $this->anime->title,
                'slug' => $this->anime->slug,
                'poster_url' => $this->anime->poster_url,
            ]),
            'replies' => $this->whenLoaded('replies', fn () => CommentResource::collection($this->replies)->resolve($request)),
        ];
    }
}
