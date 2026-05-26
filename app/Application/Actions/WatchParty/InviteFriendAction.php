<?php

namespace App\Application\Actions\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Events\FriendInviteEvent;
use App\Models\User;
use App\Models\WatchPartyRoom;

class InviteFriendAction
{
    use FormatsWatchPartyResponses;

    public function execute(User $user, string $code, int $friendId): void
    {
        $room = WatchPartyRoom::with('anime')
            ->where('code', $code)
            ->where('is_active', true)
            ->firstOrFail();

        broadcast(new FriendInviteEvent(
            toUserId: $friendId,
            fromUserId: $user->id,
            fromUserName: $user->name,
            fromUserAvatar: $this->broadcastAvatarUrl($user->avatar),
            roomCode: $code,
            animeTitle: $room->anime->title,
        ));
    }
}
