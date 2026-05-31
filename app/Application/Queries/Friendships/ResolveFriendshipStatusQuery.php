<?php

namespace App\Application\Queries\Friendships;

use App\Models\User;

class ResolveFriendshipStatusQuery
{
    public function __construct(private readonly FriendshipLookup $friendships) {}

    public function resolve(User $user, int $otherUserId): array
    {
        $friendship = $this->friendships->between($user->id, $otherUserId);

        if (! $friendship) {
            return ['status' => 'none'];
        }

        if ($friendship->status === 'pending') {
            return [
                'status' => 'pending',
                'is_sender' => $friendship->user_id === $user->id,
            ];
        }

        return ['status' => $friendship->status];
    }
}
