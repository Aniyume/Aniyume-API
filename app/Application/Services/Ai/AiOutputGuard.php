<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiOutputGuardResult;
use App\Domain\Ai\AiUserPolicy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class AiOutputGuard
{
    /** @var list<string> */
    private const SAFE_DOMAIN_TERMS = [
        'aniyume', 'anime', 'аниме', 'manga', 'манга', 'episode', 'серия', 'title', 'тайтл',
        'catalog', 'каталог', 'rating', 'рейтинг', 'favorite', 'избран', 'watch', 'просмотр',
        'recommend', 'рекоменд', 'profile', 'профиль', 'comment', 'коммент', 'platform', 'платформ',
        'жанр', 'tag', 'тег', 'season', 'сезон', 'character', 'персонаж',
    ];

    /** @var list<string> */
    private const SAFE_REFUSAL_TERMS = [
        'не могу', 'не могу помочь', 'не могу ответить', 'не буду', 'отказываюсь', 'нельзя',
        'cannot', 'can\'t', 'unable', 'not allowed', 'i won\'t', 'i will not', 'sorry',
    ];

    public function guard(AiUserPolicy $policy, string $message, string $provider = 'unknown'): AiOutputGuardResult
    {
        $message = trim($message);
        $categories = $this->violationCategories($policy, $message);

        if ($categories === []) {
            return new AiOutputGuardResult(
                message: $message,
                blocked: false,
                filtered: false,
                metadata: [
                    'output_guard' => [
                        'checked' => true,
                        'blocked' => false,
                        'filtered' => false,
                    ],
                ],
            );
        }

        $this->logBlockedOutput($provider, $policy, $message, $categories);

        return new AiOutputGuardResult(
            message: $this->safeReplacement($categories),
            blocked: true,
            filtered: true,
            categories: $categories,
            metadata: [
                'output_guard' => [
                    'checked' => true,
                    'blocked' => true,
                    'filtered' => true,
                    'categories' => $categories,
                ],
            ],
        );
    }

    /** @return list<string> */
    private function violationCategories(AiUserPolicy $policy, string $message): array
    {
        $normalized = Str::of($message)->lower()->squish()->toString();
        $categories = [];

        if ($this->containsSecretLikeData($message, $normalized)) {
            $categories[] = 'secrets_or_credentials';
        }

        if ($this->containsEnvDisclosure($normalized)) {
            $categories[] = 'env_values';
        }

        if ($this->containsPromptOrPolicyDisclosure($normalized)) {
            $categories[] = 'system_prompt_or_policy_disclosure';
        }

        if ($this->containsRawInternalStructure($normalized)) {
            $categories[] = 'raw_database_or_internal_structure';
        }

        if ($this->containsOtherUsersPersonalData($message, $normalized)) {
            $categories[] = 'other_users_personal_data';
        }

        if ($this->containsAdminOrSystemData($normalized) && ! ($policy->aiPolicy?->canAccessAdminData() ?? false)) {
            $categories[] = 'admin_or_system_data_not_allowed';
        }

        if (! ($policy->aiPolicy?->canAnswerOutOfDomain() ?? false) && $this->isOutOfDomain($normalized)) {
            $categories[] = 'out_of_domain';
        }

        if ($this->containsToxicOutput($normalized)) {
            $categories[] = 'toxic_output';
        }

        return array_values(array_unique($categories));
    }

    private function containsSecretLikeData(string $message, string $normalized): bool
    {
        if (preg_match('/\b(?:sk|pk|rk|ghp|github_pat|xox[baprs]|ya29|AIza|AKIA|ASIA)[A-Za-z0-9_\-]{12,}\b/u', $message) === 1) {
            return true;
        }

        if (preg_match('/\b(?:api[_-]?key|secret|client[_-]?secret|access[_-]?token|refresh[_-]?token|password|passwd|pwd|credential|private[_-]?key)\b\s*[:=]\s*[^\s]{6,}/iu', $message) === 1) {
            return true;
        }

        if (preg_match('/-----BEGIN (?:RSA |EC |OPENSSH |DSA )?PRIVATE KEY-----/u', $message) === 1) {
            return true;
        }

        return $this->containsAny($normalized, [
            'here is the api key', 'api key is', 'token is', 'password is', 'private key is',
            'вот api ключ', 'api ключ:', 'токен:', 'пароль:', 'секрет:',
        ]);
    }

    private function containsEnvDisclosure(string $normalized): bool
    {
        return $this->containsAny($normalized, [
            '.env', 'env value', 'environment variable', 'config value', 'ai_api_key=', 'db_password=',
            'app_key=', 'database_url=', 'redis_password=', 'значение env', 'переменные окружения',
        ]);
    }

    private function containsPromptOrPolicyDisclosure(string $normalized): bool
    {
        return $this->containsAny($normalized, [
            'system prompt', 'hidden instruction', 'developer message', 'prompt chain', 'internal policy',
            'guardrails are', 'policy internals', 'i was instructed to', 'backend-only adapter',
            'системный промпт', 'скрытые инструкции', 'внутренняя политика', 'мне было сказано',
        ]);
    }

    private function containsRawInternalStructure(string $normalized): bool
    {
        if (preg_match('/\b(create\s+table|alter\s+table|drop\s+table|insert\s+into|select\s+.+\s+from|show\s+tables|describe\s+\w+)\b/iu', $normalized) === 1) {
            return true;
        }

        return $this->containsAny($normalized, [
            'database schema', 'db schema', 'table structure', 'raw database', 'sql dump', 'migration file',
            'schema::create', 'eloquent model fields', 'internal class', 'namespace app\\models',
            'структура базы', 'схема базы', 'дамп базы', 'таблица users', 'таблица anime',
        ]);
    }

    private function containsOtherUsersPersonalData(string $message, string $normalized): bool
    {
        $mentionsOtherUsers = $this->containsAny($normalized, [
            'other user', 'another user', 'all users', 'user email', 'users emails', 'user phone',
            'чуж', 'другого пользователя', 'всех пользователей', 'email пользователей', 'телефон пользователя',
        ]);

        $containsPersonalFields = preg_match('/\b[A-Z0-9._%+\-]+@[A-Z0-9.\-]+\.[A-Z]{2,}\b/iu', $message) === 1
            || preg_match('/\b(?:\+?\d[\d\s().\-]{8,}\d)\b/u', $message) === 1
            || $this->containsAny($normalized, [' email:', ' phone:', ' address:', 'passport', 'snils', 'паспорт', 'адрес:']);

        return $mentionsOtherUsers || ($containsPersonalFields && $this->containsAny($normalized, ['user_id', 'users', 'пользовател']));
    }

    private function containsAdminOrSystemData(string $normalized): bool
    {
        return $this->containsAny($normalized, [
            'admin dashboard', 'moderation queue', 'import status', 'system status', 'platform metrics',
            'total_users', 'recent_imports', 'audit log', 'server status', 'операционные метрики',
            'админ', 'модерац', 'статус импорт', 'системн', 'метрики платформы', 'журнал аудита',
        ]);
    }

    private function isOutOfDomain(string $normalized): bool
    {
        if ($this->containsAny($normalized, self::SAFE_REFUSAL_TERMS)) {
            return false;
        }

        return ! $this->containsAny($normalized, self::SAFE_DOMAIN_TERMS);
    }

    private function containsToxicOutput(string $normalized): bool
    {
        return $this->containsAny($normalized, [
            'kill yourself', 'go die', 'you are worthless', 'i hate you', 'stupid idiot', 'fucking moron',
            'сдохни', 'убей себя', 'тупой идиот', 'ненавижу тебя', 'мразь', 'дебил', 'сука', 'бляд',
        ]);
    }

    /** @param list<string> $needles */
    private function containsAny(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (str_contains($haystack, $needle)) {
                return true;
            }
        }

        return false;
    }

    /** @param list<string> $categories */
    private function safeReplacement(array $categories): string
    {
        if (in_array('out_of_domain', $categories, true) && count($categories) === 1) {
            return 'Я могу помогать только в рамках AniYume: платформа, аниме-каталог, рекомендации и разрешённые данные вашего аккаунта.';
        }

        if (in_array('toxic_output', $categories, true) && count($categories) === 1) {
            return 'Я не могу отправить этот ответ в таком виде. Давайте продолжим в уважительном и безопасном формате в рамках AniYume.';
        }

        return 'Я не могу безопасно показать исходный ответ. Могу помочь с вопросами по AniYume, аниме-каталогу, рекомендациям и разрешённым данным вашего аккаунта.';
    }

    /** @param list<string> $categories */
    private function logBlockedOutput(string $provider, AiUserPolicy $policy, string $message, array $categories): void
    {
        Log::warning('AI output guard filtered unsafe provider response.', [
            'provider' => $provider,
            'tier' => $policy->tier,
            'ai_role' => $policy->aiPolicy?->role()->value,
            'categories' => $categories,
            'response_length' => mb_strlen($message),
            'response_hash' => hash('sha256', $message),
        ]);
    }
}
