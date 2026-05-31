<?php

namespace App\Http\Resources;

use App\Models\Anime;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'reason' => $this->reason,
            'details' => $this->details,
            'status' => $this->status,
            'target_type' => $this->target_type,
            'target_id' => $this->target_id,
            'target' => $this->targetPayload(),
            'reporter' => $this->whenLoaded('reporter', fn () => $this->reporter ? [
                'id' => $this->reporter->id,
                'name' => $this->reporter->name,
                'email' => $this->reporter->email,
            ] : null),
            'admin' => $this->whenLoaded('admin', fn () => $this->admin ? [
                'id' => $this->admin->id,
                'name' => $this->admin->name,
                'email' => $this->admin->email,
            ] : null),
            'resolution_note' => $this->resolution_note,
            'resolved_at' => $this->resolved_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    private function targetPayload(): ?array
    {
        if (! $this->relationLoaded('target') || ! $this->target) {
            return null;
        }

        return match (true) {
            $this->target instanceof User => [
                'id' => $this->target->id,
                'name' => $this->target->name,
                'email' => $this->target->email,
                'type' => 'user',
            ],
            $this->target instanceof Comment => [
                'id' => $this->target->id,
                'comment' => $this->target->comment,
                'type' => 'comment',
            ],
            $this->target instanceof Anime => [
                'id' => $this->target->id,
                'title' => $this->target->title,
                'slug' => $this->target->slug,
                'type' => 'anime',
            ],
            default => ['id' => $this->target->getKey(), 'type' => class_basename($this->target)],
        };
    }
}
