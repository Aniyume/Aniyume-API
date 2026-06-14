<?php

namespace App\Application\Actions\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Events\FriendInviteEvent;
use App\Models\User;
use App\Models\WatchPartyInvite;
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

        // Сохраняем приглашение в БД — чтобы офлайн-друг увидел его при заходе,
        // и чтобы можно было принять/отклонить по id.
        $invite = WatchPartyInvite::updateOrCreate(
            [
                'room_id' => $room->id,
                'from_user_id' => $user->id,
                'to_user_id' => $friendId,
                'status' => 'pending',
            ],
            []
        );

        broadcast(new FriendInviteEvent(
            toUserId: $friendId,
            fromUserId: $user->id,
            fromUserName: $user->name,
            fromUserAvatar: $this->broadcastAvatarUrl($user->avatar),
            roomCode: $code,
            animeTitle: $room->anime->title,
            inviteId: $invite->id,
        ));
    }
}
