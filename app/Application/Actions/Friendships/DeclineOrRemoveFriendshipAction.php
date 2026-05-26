<?php

namespace App\Application\Actions\Friendships;

use App\Models\Friendship;
use App\Models\User;

class DeclineOrRemoveFriendshipAction
{
    public function execute(User $user, int $otherUserId): void
    {
        Friendship::where(function ($q) use ($user, $otherUserId) {
            $q->where('user_id', $user->id)->where('friend_id', $otherUserId);
        })->orWhere(function ($q) use ($user, $otherUserId) {
            $q->where('user_id', $otherUserId)->where('friend_id', $user->id);
        })->delete();
    }
}
