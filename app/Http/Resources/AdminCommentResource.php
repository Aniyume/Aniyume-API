<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminCommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'is_approved' => (bool) $this->is_approved,
            'status' => $this->is_approved ? 'approved' : 'rejected',
            'parent_id' => $this->parent_id,
            'likes_count' => (int) ($this->likes_count ?? 0),
            'dislikes_count' => (int) ($this->dislikes_count ?? 0),
            'admin_hearted' => (bool) $this->admin_hearted_at,
            'admin_hearted_at' => $this->admin_hearted_at?->toISOString(),
            'admin_hearted_by' => $this->admin_hearted_by,
            'user' => $this->whenLoaded('user', fn () => $this->user ? [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'avatar' => $this->user->avatar,
                'is_banned' => (bool) ($this->user->is_banned ?? false),
            ] : null),
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
