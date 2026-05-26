<?php

namespace App\Application\Services\Ai;

use App\Models\User;

final class AiRateLimitResolver
{
    public function __construct(private readonly AiRoleResolver $roleResolver)
    {
    }

    /**
     * @return array{role: string, limit: int, key: string}
     */
    public function resolve(?User $user, string $fallbackKey): array
    {
        $role = $this->roleResolver->resolve($user);
        $limit = max(1, (int) config("ai.rate_limits.{$role}", config('ai.rate_limits.standard', 10)));
        $subject = $user?->id !== null ? 'user:'.$user->id : 'ip:'.$fallbackKey;

        return [
            'role' => $role,
            'limit' => $limit,
            'key' => $subject.'|ai|'.$role,
        ];
    }
}
