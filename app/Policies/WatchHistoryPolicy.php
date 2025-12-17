<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WatchHistory;

class WatchHistoryPolicy
{
    public function update(User $user, WatchHistory $watchHistory): bool
    {
        return $user->id === $watchHistory->user_id;
    }

    public function delete(User $user, WatchHistory $watchHistory): bool
    {
        return $user->id === $watchHistory->user_id;
    }
}
