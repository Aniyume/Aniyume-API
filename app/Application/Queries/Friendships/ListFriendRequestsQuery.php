<?php

namespace App\Application\Queries\Friendships;

use App\Application\Services\Friendships\FriendshipUserFormatter;
use App\Models\Friendship;
use App\Models\User;

class ListFriendRequestsQuery
{
    public function __construct(private readonly FriendshipUserFormatter $formatter) {}

    public function getFor(User $user): array
    {
        $incoming = Friendship::with('user:id,name,avatar,custom_status,is_online,selected_profile_frame')
            ->where('friend_id', $user->id)
            ->where('status', 'pending')
            ->get()
            ->map(fn (Friendship $friendship) => $this->formatter->format($friendship->user));

        $outgoing = Friendship::with('friend:id,name,avatar,custom_status,is_online,selected_profile_frame')
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->get()
            ->map(fn (Friendship $friendship) => $this->formatter->format($friendship->friend));

        return [
            'incoming' => $incoming,
            'outgoing' => $outgoing,
        ];
    }
}
