<?php

namespace App\Application\Services\Moderation;

use App\Domain\Moderation\ModerationMode;
use App\Domain\Moderation\ModerationResult;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class AiInputModerationService
{
    public function check(string $text, ?string $field = null): ModerationResult
    {
        if (trim($text) === '' || ! $this->enabled()) {
            return new ModerationResult(true, ModerationMode::Medium);
        }

        try {
            $response = Http::timeout((int) config('ai.timeout', 30))
                ->acceptJson()
                ->withToken((string) config('ai.api_key'))
                ->post(rtrim((string) config('ai.base_url', 'https://api.deepseek.com'), '/').'/chat/completions', [
                    'model' => (string) config('ai.model', 'deepseek-chat'),
                    'temperature' => 0,
                    'max_tokens' => 80,
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a strict content moderation classifier. Return only JSON: {"allowed":boolean,"reason":"short Russian reason"}. Block profanity, hate, insults, harassment, threats, sexual content involving minors, spam, scam, and doxxing.'],
                        ['role' => 'user', 'content' => "Field: {$field}\nText:\n".$text],
                    ],
                ]);

            if (! $response->successful()) {
                return new ModerationResult(true, ModerationMode::Medium);
            }

            $content = (string) data_get($response->json(), 'choices.0.message.content', '');
            $json = json_decode(trim($content), true);
            if (! is_array($json)) {
                preg_match('/\{.*\}/s', $content, $matches);
                $json = isset($matches[0]) ? json_decode($matches[0], true) : null;
            }

            if (is_array($json) && array_key_exists('allowed', $json) && ! (bool) $json['allowed']) {
                return new ModerationResult(false, ModerationMode::Medium, ['ai_moderation'], [(string) ($json['reason'] ?? 'Текст не прошёл AI-проверку.')]);
            }
        } catch (Throwable $exception) {
            Log::warning('AI input moderation unavailable.', ['exception' => class_basename($exception)]);
        }

        return new ModerationResult(true, ModerationMode::Medium);
    }

    private function enabled(): bool
    {
        return (bool) config('ai.api_key') && (bool) config('ai.input_moderation_enabled', true);
    }
}
