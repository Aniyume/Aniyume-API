<?php

namespace App\Http\Rules;

use App\Application\Services\Moderation\ProfanityModerationService;
use App\Domain\Moderation\ModerationMode;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PassesModeration implements ValidationRule
{
    public function __construct(private ModerationMode|string|null $mode = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! is_string($value)) {
            return;
        }

        $result = app(ProfanityModerationService::class)->check($value, $this->mode);

        if (! $result->allowed) {
            $fail($result->message());
        }
    }
}
