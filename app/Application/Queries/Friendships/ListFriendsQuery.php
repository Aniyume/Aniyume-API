<?php

namespace App\Application\Queries\Friendships;

use App\Application\Services\Friendships\FriendshipUserFormatter;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Support\Collection;

class ListFriendsQuery
{
    public function __construct(private readonly FriendshipUserFormatter $formatter) {}

    public function getFor(User $user): Collection
    {
        $friendIds = Friendship::where(function ($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('friend_id', $user->id);
        })
            ->where('status', 'accepted')
            ->get()
            ->map(fn ($friendship) => $friendship->user_id === $user->id ? $friendship->friend_id : $friendship->user_id)
            ->unique()
            ->values();

        return User::whereIn('id', $friendIds)
            ->select('id', 'name', 'avatar', 'custom_status', 'is_online')
            ->get()
            ->map(fn (User $friend) => $this->formatter->format($friend));
    }
}
