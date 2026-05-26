<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiRole;
use App\Domain\Ai\AiToolAccessDeniedException;
use App\Models\User;

class AiChatService
{
    public function __construct(
        private readonly AiToolRegistry $toolRegistry,
        private readonly AiPolicyBuilder $policyBuilder,
        private readonly AiPolicyResolver $policyResolver,
        private readonly AiPolicyGuard $policyGuard,
    ) {
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @return array<string, mixed>
     */
    public function handle(User $user, string $role, string $message, ?string $toolName, array $arguments = []): array
    {
        $policy = $this->policyBuilder->build(AiRole::from($role));
        $userPolicy = $this->policyResolver->resolveFor($user);

        $this->policyGuard->assertMessageAllowed($userPolicy, $message, [], $toolName);

        $response = [
            'message' => 'AI chat safety layer is active. Only whitelisted tools can be executed; direct database access is not available.',
            'role' => $role,
            'policy' => $policy->toArray(),
            'available_tools' => $this->toolRegistry->availableFor($role),
        ];

        if ($toolName === null || $toolName === '') {
            return $response;
        }

        try {
            $response['tool'] = [
                'name' => $toolName,
                'result' => $this->toolRegistry->invoke($user, $role, $toolName, $arguments),
            ];
        } catch (AiToolAccessDeniedException $exception) {
            $response['tool'] = [
                'name' => $toolName,
                'blocked' => true,
                'message' => $exception->getMessage(),
            ];
        }

        return $response;
    }
}
