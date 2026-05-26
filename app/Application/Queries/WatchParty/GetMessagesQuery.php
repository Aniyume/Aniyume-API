<?php

namespace App\Application\Queries\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Models\WatchPartyMessage;
use App\Models\WatchPartyRoom;
use Illuminate\Support\Collection;

class GetMessagesQuery
{
    use FormatsWatchPartyResponses;

    public function get(string $code): Collection
    {
        $room = WatchPartyRoom::where('code', $code)->firstOrFail();

        return WatchPartyMessage::with('user')
            ->where('room_id', $room->id)
            ->latest()
            ->limit(50)
            ->get()
            ->reverse()
            ->values()
            ->map(fn(WatchPartyMessage $message) => $this->formatMessage($message));
    }
}
