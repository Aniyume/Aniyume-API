<?php

namespace App\Domain\Ai;

class AiChatResponseData
{
    public function __construct(
        public readonly string $message,
        public readonly string $sessionId,
        public readonly string $provider,
        public readonly bool $moderated,
        /** @var array<string, mixed> */
        public readonly array $metadata = [],
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'session_id' => $this->sessionId,
            'provider' => $this->provider,
            'moderated' => $this->moderated,
            'metadata' => $this->metadata,
        ];
    }
}
