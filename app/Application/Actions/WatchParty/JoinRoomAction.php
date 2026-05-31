<?php

namespace App\Application\Actions\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Models\User;
use App\Models\WatchPartyParticipant;
use App\Models\WatchPartyRoom;
use Symfony\Component\HttpKernel\Exception\HttpException;

class JoinRoomAction
{
    use FormatsWatchPartyResponses;

    public function execute(User $user, string $code): array
    {
        $room = WatchPartyRoom::where('code', $code)
            ->where('is_active', true)
            ->firstOrFail();

        if ($room->activeParticipants()->count() >= $room->max_participants) {
            throw new HttpException(403, 'Комната заполнена');
        }

        WatchPartyParticipant::updateOrCreate(
            ['room_id' => $room->id, 'user_id' => $user->id],
            ['is_active' => true, 'joined_at' => now(), 'left_at' => null]
        );

        $room->load(['anime', 'host', 'activeParticipants.user']);

        return [
            'room' => $this->formatRoom($room),
            'state' => [
                'current_time' => $room->current_time,
                'is_playing' => $room->is_playing,
                'episode_number' => $room->episode_number,
            ],
        ];
    }
}
