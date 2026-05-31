<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiChatResponseData;
use App\Domain\Ai\AiUserPolicy;
use App\Models\AiChatMessage;
use App\Models\AiChatSession;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class AiChatSessionStore
{
    /** @return array{0: AiChatSession, 1: bool} */
    public function findOrCreateFor(User $user, ?string $sessionId, AiUserPolicy $policy): array
    {
        $externalSessionId = $this->normalizeSessionId($sessionId);
        $created = false;

        /** @var AiChatSession|null $session */
        $session = AiChatSession::query()
            ->where('session_id', $externalSessionId)
            ->first();

        if ($session !== null) {
            if ((int) $session->user_id !== (int) $user->id) {
                throw ValidationException::withMessages([
                    'session_id' => ['This AI chat session is not available for the current user.'],
                ]);
            }

            return [$session, $created];
        }

        $created = true;

        /** @var AiChatSession $session */
        $session = AiChatSession::query()->create([
            'session_id' => $externalSessionId,
            'user_id' => $user->id,
            'role_snapshot' => $policy->aiPolicy?->role()->value,
            'tier_snapshot' => $policy->tier,
            'expires_at' => $this->expiresAt(),
        ]);

        return [$session, $created];
    }

    public function recordUserMessage(AiChatSession $session, User $user, string $message): AiChatMessage
    {
        return $this->recordMessage($session, $user, AiChatMessage::DIRECTION_INBOUND, AiChatMessage::ROLE_USER, $message, [
            'source' => 'api',
        ]);
    }

    public function recordAssistantMessage(AiChatSession $session, User $user, AiChatResponseData $response): AiChatMessage
    {
        return $this->recordMessage($session, $user, AiChatMessage::DIRECTION_OUTBOUND, AiChatMessage::ROLE_ASSISTANT, $response->message, [
            'provider' => $response->provider,
            'moderated' => $response->moderated,
            'output_guard' => Arr::get($response->metadata, 'output_guard'),
            'usage' => Arr::get($response->metadata, 'usage'),
            'fallback_reason' => Arr::get($response->metadata, 'fallback_reason'),
            'attempted_provider' => Arr::get($response->metadata, 'attempted_provider'),
        ]);
    }

    /**
     * @return list<array{role: string, direction: string, content: string, created_at: string|null}>
     */
    public function recentHistory(AiChatSession $session, int $limit = 20): array
    {
        $limit = max(1, min($limit, (int) config('ai.session_history_limit', 20)));

        return $session->messages()
            ->select(['role', 'direction', 'content', 'created_at'])
            ->latest('id')
            ->limit($limit)
            ->get()
            ->reverse()
            ->values()
            ->map(static fn (AiChatMessage $message): array => [
                'role' => $message->role,
                'direction' => $message->direction,
                'content' => $message->content,
                'created_at' => $message->created_at?->toIso8601String(),
            ])
            ->all();
    }

    /** @param array<string, mixed> $metadata */
    private function recordMessage(AiChatSession $session, User $user, string $direction, string $role, string $content, array $metadata): AiChatMessage
    {
        $safeMetadata = $this->safeMetadata($metadata);

        return DB::transaction(function () use ($session, $user, $direction, $role, $content, $safeMetadata): AiChatMessage {
            /** @var AiChatMessage $message */
            $message = $session->messages()->create([
                'user_id' => $user->id,
                'direction' => $direction,
                'role' => $role,
                'content' => $content,
                'metadata' => $safeMetadata,
            ]);

            $updates = [
                'last_message_at' => now(),
            ];

            if ($role === AiChatMessage::ROLE_USER && blank($session->title)) {
                $updates['title'] = $this->titleFromMessage($content);
            }

            $session->forceFill($updates)->save();

            return $message;
        });
    }

    private function normalizeSessionId(?string $sessionId): string
    {
        $sessionId = trim((string) $sessionId);

        if ($sessionId !== '') {
            return $sessionId;
        }

        return (string) Str::uuid();
    }

    private function expiresAt(): ?Carbon
    {
        $days = (int) config('ai.session_retention_days', 0);

        return $days > 0 ? now()->addDays($days) : null;
    }

    /**
     * Keep only non-secret operational metadata that is safe for persistence.
     *
     * @param  array<string, mixed>  $metadata
     * @return array<string, mixed>
     */
    private function safeMetadata(array $metadata): array
    {
        return array_filter($metadata, static fn (mixed $value): bool => $value !== null);
    }

    private function titleFromMessage(string $message): string
    {
        $title = trim(preg_replace('/\s+/u', ' ', strip_tags($message)) ?? '');
        $title = preg_replace('/^[\p{P}\p{S}\s]+|[\p{P}\p{S}\s]+$/u', '', $title) ?? $title;

        if ($title === '') {
            return 'Новый чат';
        }

        return Str::limit($title, 60, '…');
    }
}
