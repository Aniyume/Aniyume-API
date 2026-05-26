<?php

namespace App\Domain\Ai;

final readonly class AiPolicy
{
    /**
     * @param list<string> $canAnswer
     * @param list<string> $cannotAnswer
     * @param list<string> $availableData
     * @param list<string> $domainBoundaries
     */
    public function __construct(
        public AiCapabilityProfile $capabilities,
        public array $canAnswer,
        public array $cannotAnswer,
        public array $availableData,
        public array $domainBoundaries,
    ) {
    }

    public function role(): AiRole
    {
        return $this->capabilities->role;
    }

    public function canDiscussTopic(string $topic): bool
    {
        return $this->capabilities->allowsTopic($topic);
    }

    public function canUseTool(string $tool): bool
    {
        return $this->capabilities->allowsTool($tool);
    }

    public function canAccessAdminData(): bool
    {
        return $this->capabilities->allowsAdminData;
    }

    public function canAccessSystemData(): bool
    {
        return $this->capabilities->allowsSystemData;
    }

    public function canAnswerOutOfDomain(): bool
    {
        return $this->capabilities->allowsOutOfDomain;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'role' => $this->role()->value,
            'capabilities' => $this->capabilities->toArray(),
            'can_answer' => $this->canAnswer,
            'cannot_answer' => $this->cannotAnswer,
            'available_data' => $this->availableData,
            'domain_boundaries' => $this->domainBoundaries,
        ];
    }
}
