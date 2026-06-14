<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\ContactMessage */
class AdminContactMessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'category' => $this->category,
            'subject' => $this->subject,
            'message' => $this->message,
            'status' => $this->status,
            'photo' => $this->photo ? [
                'name' => $this->photo_name,
                'mime' => $this->photo_mime,
                'size' => $this->photo_size,
                'url' => "/api/v1/admin/contacts/{$this->id}/photo",
            ] : null,
            'admin_note' => $this->admin_note,
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'user' => $this->whenLoaded('user', fn () => $this->user ? ['id' => $this->user->id, 'name' => $this->user->name, 'email' => $this->user->email] : null),
            'admin' => $this->whenLoaded('admin', fn () => $this->admin ? ['id' => $this->admin->id, 'name' => $this->admin->name, 'email' => $this->admin->email] : null),
            'resolved_at' => $this->resolved_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
