<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class AdminUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'custom_status' => $this->custom_status,
            'selected_profile_frame' => $this->selected_profile_frame ?: 'none',
            'admin_granted_profile_frames' => \Illuminate\Support\Facades\DB::table('user_profile_frames')
                ->where('user_id', $this->id)
                ->pluck('frame_key')
                ->values()
                ->all(),
            'roles' => $this->whenLoaded('roles', fn () => $this->roles->pluck('name')->values()->all(), []),
            'permissions' => ['admin.access'],
            'is_admin' => $this->hasRole('admin'),
            'is_online' => (bool) ($this->is_online ?? false),
            'is_premium' => (bool) ($this->is_premium ?? false),
            'is_active' => (bool) ($this->is_active ?? true),
            'is_banned' => (bool) ($this->is_banned ?? false),
            'ban_reason' => $this->ban_reason ?? null,
            'ban_expires_at' => $this->ban_expires_at?->toISOString(),
            'last_login_at' => $this->last_login_at?->toISOString(),
            'comments_count' => $this->comments_count ?? null,
            'ratings_count' => $this->ratings_count ?? null,
            'favorites_count' => $this->favorites_count ?? null,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
