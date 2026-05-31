<?php

namespace App\Application\Actions\Ai;

use App\Application\Services\Ai\AiPolicyBuilder;
use App\Application\Services\Ai\AiRoleResolver;
use App\Domain\Ai\AiPolicy;
use App\Domain\Ai\AiRole;
use App\Models\User;

final readonly class BuildAiPolicyAction
{
    public function __construct(
        private AiRoleResolver $roleResolver,
        private AiPolicyBuilder $policyBuilder,
    ) {}

    public function execute(?User $user): AiPolicy
    {
        return $this->policyBuilder->build(AiRole::from($this->roleResolver->resolve($user)));
    }
}
