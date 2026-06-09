<?php

namespace App\Application\Actions\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Models\User;
use App\Models\WatchPartyParticipant;
use App\Models\WatchPartyRoom;

class CreateRoomAction
{
    use FormatsWatchPartyResponses;

    public function execute(User $user, array $data): array
    {
        $maxParticipants = $user->is_premium ? 10 : 2;

        WatchPartyRoom::where('host_user_id', $user->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $room = WatchPartyRoom::create([
            'code' => WatchPartyRoom::generateCode(),
            'anime_id' => $data['anime_id'],
            'episode_number' => $data['episode_number'],
            'host_user_id' => $user->id,
            'max_participants' => min($maxParticipants, $data['max_participants'] ?? $maxParticipants),
            'is_private' => $data['is_private'] ?? false,
            'is_playing' => false,
            'current_time' => 0,
        ]);

        WatchPartyParticipant::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'is_active' => true,
        ]);

        return [
            'room' => $this->formatRoom($room),
            'join_url' => '/watch-party/'.$room->code,
        ];
    }
}
