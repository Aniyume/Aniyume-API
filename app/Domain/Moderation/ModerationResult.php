<?php

namespace App\Domain\Moderation;

final readonly class ModerationResult
{
    /**
     * @param  list<string>  $categories
     * @param  list<string>  $matchedTerms
     */
    public function __construct(
        public bool $allowed,
        public ModerationMode $mode,
        public array $categories = [],
        public array $matchedTerms = [],
    ) {}

    public function message(): string
    {
        return match ($this->mode) {
            ModerationMode::Strict => 'Текст содержит запрещённую лексику или токсичные формулировки.',
            ModerationMode::Medium => 'Текст содержит грубую лексику или оскорбления.',
            ModerationMode::Soft => 'Текст содержит недопустимые выражения.',
        };
    }
}
