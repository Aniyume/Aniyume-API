<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiUserPolicy;
use Illuminate\Validation\ValidationException;

final class AiPolicyGuard
{
    /**
     * @param  array<string, mixed>  $pageContext
     */
    public function assertMessageAllowed(AiUserPolicy $policy, string $message, array $pageContext = [], ?string $toolName = null): void
    {
        $reason = $this->firstViolation($policy, $message, $pageContext, $toolName);

        if ($reason === null) {
            return;
        }

        throw ValidationException::withMessages([
            'message' => [$reason],
        ]);
    }

    /**
     * @param  array<string, mixed>  $pageContext
     */
    private function firstViolation(AiUserPolicy $policy, string $message, array $pageContext, ?string $toolName): ?string
    {
        $normalized = mb_strtolower($message);
        $aiPolicy = $policy->aiPolicy;

        if ($this->containsAny($normalized, [
            'api key', 'apikey', 'token', 'credential', 'credentials', 'private key', 'secret',
            'пароль', 'секрет', 'токен', 'ключ api',
        ])) {
            return 'AI policy blocks requests for secrets, credentials, tokens or private keys.';
        }

        if ($this->containsAny($normalized, [
            '.env', 'env value', 'environment variable', 'config value', 'значение env', 'переменные окружения',
        ])) {
            return 'AI policy blocks requests for environment values or deployment secrets.';
        }

        if ($this->containsAny($normalized, [
            'system prompt', 'hidden instruction', 'developer message', 'prompt chain',
            'системный промпт', 'скрытые инструкции',
        ])) {
            return 'AI policy blocks system prompt or hidden instruction disclosure.';
        }

        if ($this->containsAny($normalized, [
            'database schema', 'db schema', 'table structure', 'raw database', 'sql dump', 'show tables',
            'структура базы', 'схема базы', 'дамп базы',
        ])) {
            return 'AI policy blocks raw database structure and direct database access details.';
        }

        if ($this->containsOtherUserDataRequest($normalized)) {
            return 'AI policy allows personal data only for the authenticated user.';
        }

        if ($this->containsAdminOrSystemRequest($normalized) && ($aiPolicy === null || ! $aiPolicy->canAccessAdminData())) {
            return 'AI policy allows admin or system data only for admin and creator roles.';
        }

        if ($aiPolicy !== null && ! $aiPolicy->canAnswerOutOfDomain() && ! $this->isAniYumeDomainMessage($normalized, $pageContext, $toolName)) {
            return 'AI policy is limited to AniYume help, platform content, and allowed user data.';
        }

        return null;
    }

    /** @param list<string> $needles */
    private function containsAny(string $message, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (str_contains($message, $needle)) {
                return true;
            }
        }

        return false;
    }

    private function containsOtherUserDataRequest(string $message): bool
    {
        return $this->containsAny($message, [
            'other user', 'another user', 'all users', 'user email', 'users emails', 'чуж', 'другого пользователя',
            'всех пользователей', 'email пользователей',
        ]);
    }

    private function containsAdminOrSystemRequest(string $message): bool
    {
        return $this->containsAny($message, [
            'admin dashboard', 'moderation queue', 'import status', 'system status', 'platform metrics',
            'админ', 'модерац', 'статус импорт', 'системн', 'метрики платформы',
        ]);
    }

    /**
     * @param  array<string, mixed>  $pageContext
     */
    private function isAniYumeDomainMessage(string $message, array $pageContext, ?string $toolName): bool
    {
        if (is_string($toolName) && $toolName !== '') {
            return true;
        }

        if ($pageContext !== []) {
            return true;
        }

        return $this->containsAny($message, [
            'aniyume', 'anime', 'аниме', 'manga', 'манга', 'episode', 'серия', 'title', 'тайтл',
            'catalog', 'каталог', 'rating', 'рейтинг', 'favorite', 'избран', 'watch history', 'история просмот',
            'recommend', 'рекоменд', 'profile', 'профиль', 'comment', 'коммент', 'platform', 'платформ',
        ]);
    }
}
