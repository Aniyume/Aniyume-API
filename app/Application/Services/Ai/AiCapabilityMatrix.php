<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiCapabilityProfile;
use App\Domain\Ai\AiRole;
use App\Domain\Ai\PersonalDataScope;
use RuntimeException;

final class AiCapabilityMatrix
{
    public function forRole(AiRole $role): AiCapabilityProfile
    {
        $definition = config("ai_policy.roles.{$role->value}");

        if (! is_array($definition)) {
            throw new RuntimeException("AI capability profile is not configured for role [{$role->value}].");
        }

        return new AiCapabilityProfile(
            role: $role,
            allowedTopics: array_values($definition['allowed_topics'] ?? []),
            allowedTools: array_values($definition['allowed_tools'] ?? []),
            responseStrictness: (string) ($definition['response_strictness'] ?? 'strict'),
            rateLimitTierHint: (string) ($definition['rate_limit_tier_hint'] ?? $role->value),
            personalDataScope: PersonalDataScope::from((string) ($definition['personal_data_scope'] ?? PersonalDataScope::Self->value)),
            allowsAdminData: (bool) ($definition['allow_admin_data'] ?? false),
            allowsSystemData: (bool) ($definition['allow_system_data'] ?? false),
            allowsOutOfDomain: (bool) ($definition['allow_out_of_domain'] ?? false),
        );
    }
}
