<?php

namespace App\Domain\Ai;

final readonly class AiCapabilityProfile
{
    /**
     * @param  list<string>  $allowedTopics
     * @param  list<string>  $allowedTools
     */
    public function __construct(
        public AiRole $role,
        public array $allowedTopics,
        public array $allowedTools,
        public string $responseStrictness,
        public string $rateLimitTierHint,
        public PersonalDataScope $personalDataScope,
        public bool $allowsAdminData,
        public bool $allowsSystemData,
        public bool $allowsOutOfDomain,
    ) {}

    public function allowsTopic(string $topic): bool
    {
        return in_array($topic, $this->allowedTopics, true);
    }

    public function allowsTool(string $tool): bool
    {
        return in_array($tool, $this->allowedTools, true);
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'role' => $this->role->value,
            'allowed_topics' => $this->allowedTopics,
            'allowed_tools' => $this->allowedTools,
            'response_strictness' => $this->responseStrictness,
            'rate_limit_tier_hint' => $this->rateLimitTierHint,
            'personal_data_scope' => $this->personalDataScope->value,
            'allow_admin_data' => $this->allowsAdminData,
            'allow_system_data' => $this->allowsSystemData,
            'allow_out_of_domain' => $this->allowsOutOfDomain,
        ];
    }
}
