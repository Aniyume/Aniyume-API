<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rating;

class RatingPolicy
{
    public function delete(User $user, Rating $rating): bool
    {
        return $user->id === $rating->user_id;
    }
}
