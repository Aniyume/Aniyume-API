<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'roles' => $this->whenLoaded('roles', fn () => $this->roles->pluck('name')->values()->all(), []),
            'permissions' => ['admin.access'],
            'is_admin' => $this->hasRole('admin'),
            'is_banned' => (bool) ($this->is_banned ?? false),
            'ban_reason' => $this->ban_reason ?? null,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
