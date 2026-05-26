<?php

namespace App\Application\Actions\WatchParty;

use App\Events\RoomClosedEvent;
use App\Models\User;
use App\Models\WatchPartyParticipant;
use App\Models\WatchPartyRoom;

class LeaveRoomAction
{
    public function execute(User $user, string $code): void
    {
        $room = WatchPartyRoom::where('code', $code)->firstOrFail();

        WatchPartyParticipant::where('room_id', $room->id)
            ->where('user_id', $user->id)
            ->update(['is_active' => false, 'left_at' => now()]);

        if ($room->host_user_id === $user->id) {
            $room->update(['is_active' => false]);
            broadcast(new RoomClosedEvent($room->code))->toOthers();
        }
    }
}
