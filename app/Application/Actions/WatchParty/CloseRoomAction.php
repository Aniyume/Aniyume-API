<?php

namespace App\Application\Actions\WatchParty;

use App\Events\RoomClosedEvent;
use App\Models\User;
use App\Models\WatchPartyParticipant;
use App\Models\WatchPartyRoom;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CloseRoomAction
{
    public function execute(User $user, string $code): void
    {
        $room = WatchPartyRoom::where('code', $code)->firstOrFail();

        if ($room->host_user_id !== $user->id) {
            throw new HttpException(403, 'Только хост может закрыть комнату');
        }

        $room->update(['is_active' => false]);

        WatchPartyParticipant::where('room_id', $room->id)
            ->where('is_active', true)
            ->update(['is_active' => false, 'left_at' => now()]);

        broadcast(new RoomClosedEvent($room->code));
    }
}
