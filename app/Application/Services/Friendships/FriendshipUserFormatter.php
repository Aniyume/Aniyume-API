<?php

namespace App\Application\Services\Friendships;

use App\Models\User;

class FriendshipUserFormatter
{
    public function format(User $user): array
    {
        return [
            'id'            => $user->id,
            'name'          => $user->name,
            'avatar'        => $user->avatar ? '/api-storage/avatars/' . $user->avatar : null,
            'custom_status' => $user->custom_status,
            'is_online'     => $user->is_online ?? false,
        ];
    }
}
