<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiUserPolicy;

class AiContextBuilder
{
    /**
     * @param  array<string, mixed>  $pageContext
     * @return array<string, mixed>
     */
    public function build(array $pageContext, AiUserPolicy $policy): array
    {
        $safeContext = [];

        foreach ($policy->allowedContextKeys as $key) {
            if (array_key_exists($key, $pageContext)) {
                $safeContext[$key] = $this->sanitizeValue($pageContext[$key]);
            }
        }

        return [
            'page' => $safeContext,
            'policy' => $policy->toSafeArray(),
            'guardrails' => [
                'no_direct_database_access' => true,
                'no_sql_generation_for_execution' => true,
                'frontend_policy_source' => false,
                'domain_bound_to_aniyume' => true,
                'deny_secrets_and_env_values' => true,
                'deny_system_prompt_disclosure' => true,
                'deny_raw_database_structure' => true,
                'deny_other_users_personal_data' => true,
            ],
        ];
    }

    private function sanitizeValue(mixed $value): mixed
    {
        if (is_string($value)) {
            return mb_substr(strip_tags($value), 0, 500);
        }

        if (is_numeric($value) || is_bool($value) || $value === null) {
            return $value;
        }

        if (is_array($value)) {
            $sanitized = [];

            foreach (array_slice($value, 0, 10, true) as $key => $item) {
                if (is_string($key) && in_array($key, ['token', 'password', 'secret', 'api_key', 'authorization'], true)) {
                    continue;
                }

                $sanitized[$key] = $this->sanitizeValue($item);
            }

            return $sanitized;
        }

        return null;
    }
}
