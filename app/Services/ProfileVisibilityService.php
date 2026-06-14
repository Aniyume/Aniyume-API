<?php

namespace App\Services;

use App\Enums\ProfileVisibility;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileVisibilityService
{
    /**
     * Может ли $viewer видеть раздел $section профиля $owner.
     * $section: favorites | watch_history | ratings.
     */
    public function canView(?User $viewer, User $owner, string $section): bool
    {
        if ($viewer !== null && $viewer->id === $owner->id) {
            return true;
        }

        $column = ProfileVisibility::SECTIONS[$section] ?? null;
        if ($column === null) {
            return false;
        }

        $level = $owner->{$column} ?? ProfileVisibility::Friends->value;

        return match ($level) {
            ProfileVisibility::Everyone->value => true,
            ProfileVisibility::Friends->value => $viewer !== null && $this->areFriends($viewer->id, $owner->id),
            default => false,
        };
    }

    private function areFriends(int $a, int $b): bool
    {
        return DB::table('friendships')
            ->where('status', 'accepted')
            ->where(function ($q) use ($a, $b) {
                $q->where(function ($qq) use ($a, $b) {
                    $qq->where('user_id', $a)->where('friend_id', $b);
                })->orWhere(function ($qq) use ($a, $b) {
                    $qq->where('user_id', $b)->where('friend_id', $a);
                });
            })
            ->exists();
    }
}
