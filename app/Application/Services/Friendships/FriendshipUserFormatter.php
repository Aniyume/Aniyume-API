<?php

namespace App\Application\Services\Friendships;

use App\Models\User;

class FriendshipUserFormatter
{
    public function format(User $user, array $extra = []): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'custom_status' => $user->custom_status,
            'is_online' => $user->is_online ?? false,
            'selected_profile_frame' => $user->selected_profile_frame ?: 'none',
        ] + $extra;
    }
}
