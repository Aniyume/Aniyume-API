<?php

namespace App\Application\Actions\Friendships;

use App\Application\Queries\Friendships\FriendshipLookup;
use App\Models\Friendship;
use App\Models\User;

class SendFriendRequestAction
{
    public function __construct(private readonly FriendshipLookup $friendships) {}

    public function execute(User $user, int $targetUserId): array
    {
        if ($user->id === $targetUserId) {
            return [
                'payload' => ['message' => 'Нельзя добавить себя в друзья'],
                'status' => 422,
            ];
        }

        User::findOrFail($targetUserId);

        $existing = $this->friendships->between($user->id, $targetUserId);

        if ($existing) {
            if ($existing->status === 'accepted') {
                return [
                    'payload' => ['message' => 'Уже в друзьях'],
                    'status' => 422,
                ];
            }

            if ($existing->status === 'pending') {
                return [
                    'payload' => ['message' => 'Заявка уже отправлена'],
                    'status' => 422,
                ];
            }
        }

        Friendship::create([
            'user_id' => $user->id,
            'friend_id' => $targetUserId,
            'status' => 'pending',
        ]);

        return [
            'payload' => ['message' => 'Заявка отправлена'],
            'status' => 201,
        ];
    }
}
