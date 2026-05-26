<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiRole;
use App\Models\User;

final class AiRoleResolver
{
    public function resolve(?User $user): string
    {
        if ($user === null) {
            return AiRole::default()->value;
        }

        if ($this->hasRole($user, AiRole::Creator->value)) {
            return AiRole::Creator->value;
        }

        if ($this->hasRole($user, AiRole::Admin->value)) {
            return AiRole::Admin->value;
        }

        if ((bool) $user->is_premium) {
            return AiRole::Premium->value;
        }

        return AiRole::Standard->value;
    }

    private function hasRole(User $user, string $role): bool
    {
        return $user->hasRole($role);
    }
}
