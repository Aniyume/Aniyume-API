<?php

namespace Tests\Unit\Ai;

use App\Application\Services\Ai\AiGateway;
use App\Domain\Ai\AiChatRequestData;
use App\Domain\Ai\AiUserPolicy;
use App\Infrastructure\Ai\DeepSeekGateway;
use App\Infrastructure\Ai\StubAiGateway;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DeepSeekGatewayTest extends TestCase
{
    public function test_container_uses_deepseek_when_provider_and_key_are_configured(): void
    {
        config([
            'ai.provider' => 'deepseek',
            'ai.api_key' => 'test-key',
        ]);

        $this->assertInstanceOf(DeepSeekGateway::class, $this->app->make(AiGateway::class));
    }

    public function test_container_uses_stub_when_deepseek_key_is_missing(): void
    {
        config([
            'ai.provider' => 'deepseek',
            'ai.api_key' => '',
        ]);

        $this->assertInstanceOf(StubAiGateway::class, $this->app->make(AiGateway::class));
    }

    public function test_deepseek_gateway_sends_only_backend_sanitized_payload_and_normalizes_response(): void
    {
        config([
            'ai.base_url' => 'https://api.deepseek.test',
            'ai.api_key' => 'test-key',
            'ai.model' => 'deepseek-v4-flash',
            'ai.timeout' => 30,
            'ai.max_output_tokens' => 1200,
            'ai.temperature' => 0.1,
            'ai.thinking_mode' => false,
        ]);

        Http::fake([
            'api.deepseek.test/chat/completions' => Http::response([
                'model' => 'deepseek-v4-flash',
                'choices' => [
                    ['message' => ['content' => 'Safe DeepSeek anime recommendation.']],
                ],
                'usage' => [
                    'prompt_tokens' => 10,
                    'completion_tokens' => 4,
                    'total_tokens' => 14,
                    'unsafe_extra' => 'ignored',
                ],
            ]),
        ]);

        $response = $this->app->make(DeepSeekGateway::class)->chat($this->request());

        $this->assertSame('Safe DeepSeek anime recommendation.', $response->message);
        $this->assertSame('session-123', $response->sessionId);
        $this->assertSame('deepseek', $response->provider);
        $this->assertSame('deepseek-v4-flash', $response->metadata['model']);
        $this->assertSame(['route', 'anime_id', 'title'], $response->metadata['context_keys']);
        $this->assertArrayNotHasKey('unsafe_extra', $response->metadata['usage']);

        Http::assertSent(function ($request): bool {
            $payload = $request->data();
            $encoded = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            return $request->url() === 'https://api.deepseek.test/chat/completions'
                && $request->hasHeader('Authorization', 'Bearer test-key')
                && $payload['model'] === 'deepseek-v4-flash'
                && $payload['max_tokens'] === 1200
                && $payload['temperature'] === 0.1
                && ! array_key_exists('tools', $payload)
                && ! str_contains((string) $encoded, 'must-not-be-forwarded')
                && ! str_contains((string) $encoded, 'client.tool')
                && str_contains((string) $encoded, 'Sanitized backend context')
                && str_contains((string) $encoded, 'Recommend anime');
        });
    }

    public function test_deepseek_gateway_falls_back_when_provider_is_unavailable(): void
    {
        config([
            'ai.base_url' => 'https://api.deepseek.test',
            'ai.api_key' => 'test-key',
            'ai.model' => 'deepseek-v4-flash',
        ]);

        Http::fake([
            'api.deepseek.test/chat/completions' => Http::response(['error' => ['message' => 'down']], 503),
        ]);

        $response = $this->app->make(DeepSeekGateway::class)->chat($this->request());

        $this->assertSame('stub', $response->provider);
        $this->assertSame('session-123', $response->sessionId);
        $this->assertSame('provider_unavailable', $response->metadata['fallback_reason']);
        $this->assertSame('deepseek', $response->metadata['attempted_provider']);
    }

    private function request(): AiChatRequestData
    {
        return new AiChatRequestData(
            userId: 1,
            message: 'Recommend anime',
            sessionId: 'session-123',
            pageContext: [
                'route' => '/anime/1',
                'anime_id' => 1,
                'title' => '<b>Test Anime</b>',
                'token' => 'must-not-be-forwarded',
                'tool' => 'client.tool',
            ],
            policy: new AiUserPolicy(
                roles: ['standard'],
                tier: 'free',
                maxMessageLength: 2000,
                allowedContextKeys: ['route', 'anime_id', 'title'],
                canUsePersonalizedContext: false,
            ),
        );
    }
}
