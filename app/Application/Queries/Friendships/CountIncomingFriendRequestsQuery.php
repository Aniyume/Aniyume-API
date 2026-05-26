<?php

namespace App\Application\Queries\Friendships;

use App\Models\Friendship;
use App\Models\User;

class CountIncomingFriendRequestsQuery
{
    public function countFor(User $user): int
    {
        return Friendship::where('friend_id', $user->id)
            ->where('status', 'pending')
            ->count();
    }
}
