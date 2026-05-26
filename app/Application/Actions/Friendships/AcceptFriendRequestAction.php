<?php

namespace App\Application\Actions\Friendships;

use App\Models\Friendship;
use App\Models\User;

class AcceptFriendRequestAction
{
    public function execute(User $user, int $requestSenderId): void
    {
        $friendship = Friendship::where('user_id', $requestSenderId)
            ->where('friend_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $friendship->update(['status' => 'accepted']);
    }
}
