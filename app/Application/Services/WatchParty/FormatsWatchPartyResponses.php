<?php

namespace App\Application\Services\WatchParty;

use App\Models\WatchPartyMessage;
use App\Models\WatchPartyRoom;

trait FormatsWatchPartyResponses
{
    protected function formatRoom(WatchPartyRoom $room): array
    {
        return [
            'id' => $room->id,
            'code' => $room->code,
            'join_url' => '/watch-party/'.$room->code,
            'is_active' => $room->is_active,
            'is_private' => $room->is_private,
            'max_participants' => $room->max_participants,
            'episode_number' => $room->episode_number,
            'current_time' => $room->current_time,
            'is_playing' => $room->is_playing,
            'anime' => $room->relationLoaded('anime') ? [
                'id' => $room->anime->id,
                'title' => $room->anime->title,
                'poster_url' => $room->anime->poster_url,
                'slug' => $room->anime->slug,
            ] : null,
            'host' => $room->relationLoaded('host') ? [
                'id' => $room->host->id,
                'name' => $room->host->name,
                'avatar' => $this->nullableAvatarUrl($room->host->avatar),
            ] : null,
            'participants' => $room->relationLoaded('activeParticipants')
                ? $room->activeParticipants->map(fn ($p) => [
                    'id' => $p->user->id,
                    'name' => $p->user->name,
                    'avatar' => $this->nullableAvatarUrl($p->user->avatar),
                ])->values()
                : [],
            'participants_count' => $room->relationLoaded('activeParticipants')
                ? $room->activeParticipants->count()
                : null,
            'created_at' => $room->created_at->toISOString(),
        ];
    }

    protected function formatMessage(WatchPartyMessage $message): array
    {
        return [
            'id' => $message->id,
            'user_id' => $message->user_id,
            'user_name' => $message->user->name,
            'user_avatar' => $this->nullableAvatarUrl($message->user->avatar),
            'message' => $message->message,
            'type' => $message->type,
            'created_at' => $message->created_at->toISOString(),
        ];
    }

    protected function nullableAvatarUrl(?string $avatar): ?string
    {
        return $avatar ? '/api-storage/avatars/'.$avatar : null;
    }

    protected function broadcastAvatarUrl(?string $avatar): string
    {
        return $avatar ? '/api-storage/avatars/'.$avatar : '';
    }
}
