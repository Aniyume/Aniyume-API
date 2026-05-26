<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiRole;
use App\Domain\Ai\AiUserPolicy;
use App\Models\User;

class AiPolicyResolver
{
    public function __construct(
        private readonly AiPolicyBuilder $policyBuilder,
        private readonly AiRoleResolver $roleResolver,
    ) {
    }

    public function resolveFor(User $user): AiUserPolicy
    {
        $roles = $user->roles()
            ->pluck('name')
            ->filter(fn ($role): bool => is_string($role))
            ->values()
            ->all();

        $aiRole = AiRole::from($this->roleResolver->resolve($user));

        return new AiUserPolicy(
            roles: $roles,
            tier: $aiRole === AiRole::Standard ? 'free' : $aiRole->value,
            maxMessageLength: $aiRole === AiRole::Standard ? 2000 : 4000,
            allowedContextKeys: ['route', 'anime_id', 'episode_id', 'title', 'locale'],
            canUsePersonalizedContext: $aiRole !== AiRole::Standard,
            aiPolicy: $this->policyBuilder->build($aiRole),
        );
    }
}
