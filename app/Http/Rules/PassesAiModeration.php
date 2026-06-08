<?php

namespace App\Http\Rules;

use App\Application\Services\Moderation\AiInputModerationService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PassesAiModeration implements ValidationRule
{
    public function __construct(private ?string $field = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '' || ! is_string($value)) {
            return;
        }

        $result = app(AiInputModerationService::class)->check($value, $this->field ?? $attribute);

        if (! $result->allowed) {
            $fail($result->message());
        }
    }
}
