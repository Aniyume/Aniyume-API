<?php

namespace App\Application\Queries\Friendships;

use App\Models\Friendship;

class FriendshipLookup
{
    public function between(int $userId, int $otherUserId): ?Friendship
    {
        return Friendship::where(function ($q) use ($userId, $otherUserId) {
            $q->where('user_id', $userId)->where('friend_id', $otherUserId);
        })->orWhere(function ($q) use ($userId, $otherUserId) {
            $q->where('user_id', $otherUserId)->where('friend_id', $userId);
        })->first();
    }
}
