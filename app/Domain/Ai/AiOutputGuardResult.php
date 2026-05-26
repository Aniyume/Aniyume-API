<?php

namespace App\Domain\Ai;

final class AiOutputGuardResult
{
    /**
     * @param  list<string>  $categories
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public readonly string $message,
        public readonly bool $blocked,
        public readonly bool $filtered,
        public readonly array $categories = [],
        public readonly array $metadata = [],
    ) {}
}
