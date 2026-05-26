<?php

namespace App\Domain\Ai;

class AiChatRequestData
{
    public function __construct(
        public readonly int $userId,
        public readonly string $message,
        public readonly ?string $sessionId,
        /** @var array<string, mixed> */
        public readonly array $pageContext,
        public readonly AiUserPolicy $policy,
    ) {}
}
