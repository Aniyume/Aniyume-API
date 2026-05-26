<?php

namespace App\Application\Services\Ai;

final class AiAuditContextSanitizer
{
    private const SENSITIVE_KEYS = [
        'message',
        'prompt',
        'raw_response',
        'token',
        'access_token',
        'refresh_token',
        'authorization',
        'password',
        'secret',
        'api_key',
    ];

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>
     */
    public function sanitize(array $context): array
    {
        foreach (self::SENSITIVE_KEYS as $key) {
            unset($context[$key]);
        }

        if (isset($context['arguments']) && is_array($context['arguments'])) {
            $context['argument_keys'] = array_values(array_map('strval', array_keys($context['arguments'])));
            unset($context['arguments']);
        }

        if (isset($context['page_context']) && is_array($context['page_context'])) {
            $context['page_context_keys'] = array_values(array_map('strval', array_keys($context['page_context'])));
            unset($context['page_context']);
        }

        return $context;
    }
}
