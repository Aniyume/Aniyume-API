<?php

namespace App\Application\Queries\WatchParty;

use App\Models\WatchPartyRoom;

class FindActiveRoomQuery
{
    public function getByCode(string $code): WatchPartyRoom
    {
        return WatchPartyRoom::with(['anime', 'host', 'activeParticipants.user'])
            ->where('code', $code)
            ->where('is_active', true)
            ->firstOrFail();
    }
}
