<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiRole;
use App\Domain\Ai\AiToolAccessDeniedException;

final class AiToolCapabilityGate
{
    /**
     * @param  array<string, mixed>  $registeredTools
     */
    public function assertCanUse(string $role, string $toolName, array $registeredTools): void
    {
        if (! isset($registeredTools[$toolName])) {
            throw new AiToolAccessDeniedException('AI tool is not whitelisted.');
        }

        if (AiRole::tryFrom($role) === null) {
            throw new AiToolAccessDeniedException('Unknown AI role.');
        }

        $roleDefinition = config("ai_policy.roles.{$role}");
        $allowedByPolicy = is_array($roleDefinition)
            ? array_values($roleDefinition['allowed_tools'] ?? [])
            : [];

        $toolDefinition = config("ai.tools.{$toolName}");
        $allowedByTool = is_array($toolDefinition)
            ? array_values($toolDefinition['roles'] ?? [])
            : [];

        if (! in_array($toolName, $allowedByPolicy, true) || ! in_array($role, $allowedByTool, true)) {
            throw new AiToolAccessDeniedException('AI role cannot use this tool.');
        }
    }
}
