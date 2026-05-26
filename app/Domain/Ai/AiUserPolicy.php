<?php

namespace App\Domain\Ai;

class AiUserPolicy
{
    /**
     * @param  array<int, string>  $roles
     * @param  array<int, string>  $allowedContextKeys
     */
    public function __construct(
        public readonly array $roles,
        public readonly string $tier,
        public readonly int $maxMessageLength,
        public readonly array $allowedContextKeys,
        public readonly bool $canUsePersonalizedContext,
        public readonly ?AiPolicy $aiPolicy = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toSafeArray(): array
    {
        $data = [
            'roles' => $this->roles,
            'tier' => $this->tier,
            'max_message_length' => $this->maxMessageLength,
            'allowed_context_keys' => $this->allowedContextKeys,
            'can_use_personalized_context' => $this->canUsePersonalizedContext,
        ];

        if ($this->aiPolicy !== null) {
            $data['ai_role'] = $this->aiPolicy->role()->value;
            $data['capabilities'] = $this->aiPolicy->capabilities->toArray();
            $data['can_answer'] = $this->aiPolicy->canAnswer;
            $data['cannot_answer'] = $this->aiPolicy->cannotAnswer;
            $data['available_data'] = $this->aiPolicy->availableData;
            $data['domain_boundaries'] = $this->aiPolicy->domainBoundaries;
        }

        return $data;
    }
}
