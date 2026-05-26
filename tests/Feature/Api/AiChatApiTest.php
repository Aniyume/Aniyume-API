<?php

namespace Tests\Feature\Api;

use App\Models\AiChatMessage;
use App\Models\AiChatSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiChatApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'ai.provider' => 'stub',
            'ai.api_key' => '',
        ]);
    }

    public function test_ai_chat_requires_authentication(): void
    {
        $this->postJson('/api/v1/ai/chat', [
            'message' => 'Recommend an anime.',
        ])->assertUnauthorized();
    }

    public function test_authenticated_user_can_send_ai_chat_message(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'is_premium' => false,
        ]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Recommend something similar to this title.',
                'session_id' => 'session-123',
                'page_context' => [
                    'route' => '/anime/1',
                    'anime_id' => 1,
                    'title' => 'Test Anime',
                    'token' => 'must-not-be-forwarded',
                ],
            ])
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.provider', 'stub')
            ->assertJsonPath('data.session_id', 'session-123')
            ->assertJsonPath('data.metadata.tier', 'free')
            ->assertJsonMissing(['token' => 'must-not-be-forwarded'])
            ->assertJsonStructure([
                'status',
                'data' => [
                    'message',
                    'session_id',
                    'provider',
                    'moderated',
                    'metadata' => ['tier', 'context_keys', 'next_layers_ready'],
                ],
            ]);

        $this->assertDatabaseHas('ai_chat_sessions', [
            'session_id' => 'session-123',
            'user_id' => $user->id,
            'tier_snapshot' => 'free',
        ]);

        $session = AiChatSession::query()->where('session_id', 'session-123')->firstOrFail();

        $this->assertDatabaseHas('ai_chat_messages', [
            'ai_chat_session_id' => $session->id,
            'user_id' => $user->id,
            'direction' => AiChatMessage::DIRECTION_INBOUND,
            'role' => AiChatMessage::ROLE_USER,
            'content' => 'Recommend something similar to this title.',
        ]);

        $this->assertDatabaseHas('ai_chat_messages', [
            'ai_chat_session_id' => $session->id,
            'user_id' => $user->id,
            'direction' => AiChatMessage::DIRECTION_OUTBOUND,
            'role' => AiChatMessage::ROLE_ASSISTANT,
            'content' => 'AI gateway is ready. External LLM provider is not configured yet, so this safe stub response was returned.',
        ]);

        $this->assertSame(2, $session->messages()->count());
        $this->assertNotNull($session->refresh()->last_message_at);
    }

    public function test_ai_chat_creates_session_when_session_id_is_missing(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Recommend a safe anime.',
            ])
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $sessionId = $response->json('data.session_id');

        $this->assertIsString($sessionId);
        $this->assertNotSame('', $sessionId);
        $this->assertDatabaseHas('ai_chat_sessions', [
            'session_id' => $sessionId,
            'user_id' => $user->id,
        ]);
    }

    public function test_user_cannot_use_another_users_ai_session_id(): void
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        /** @var User $otherUser */
        $otherUser = User::factory()->create();

        AiChatSession::query()->create([
            'session_id' => 'owned-session',
            'user_id' => $owner->id,
            'tier_snapshot' => 'free',
        ]);

        $this->actingAs($otherUser, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Recommend anime safely.',
                'session_id' => 'owned-session',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['session_id']);

        $this->assertDatabaseMissing('ai_chat_messages', [
            'user_id' => $otherUser->id,
            'content' => 'Recommend anime safely.',
        ]);
    }

    public function test_authenticated_user_can_read_own_ai_chat_session_history(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var AiChatSession $session */
        $session = AiChatSession::query()->create([
            'session_id' => 'readable-session',
            'user_id' => $user->id,
            'tier_snapshot' => 'free',
            'last_message_at' => now(),
        ]);

        $session->messages()->create([
            'user_id' => $user->id,
            'direction' => AiChatMessage::DIRECTION_INBOUND,
            'role' => AiChatMessage::ROLE_USER,
            'content' => 'Recommend a calm anime.',
            'metadata' => ['source' => 'api'],
        ]);

        $session->messages()->create([
            'user_id' => $user->id,
            'direction' => AiChatMessage::DIRECTION_OUTBOUND,
            'role' => AiChatMessage::ROLE_ASSISTANT,
            'content' => 'Try a gentle slice-of-life title.',
            'metadata' => ['provider' => 'stub', 'unsafe_raw_output' => 'must-not-leak'],
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/ai/chat/sessions/readable-session')
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.session_id', 'readable-session')
            ->assertJsonPath('data.messages.0.direction', AiChatMessage::DIRECTION_INBOUND)
            ->assertJsonPath('data.messages.0.role', AiChatMessage::ROLE_USER)
            ->assertJsonPath('data.messages.0.content', 'Recommend a calm anime.')
            ->assertJsonPath('data.messages.1.direction', AiChatMessage::DIRECTION_OUTBOUND)
            ->assertJsonPath('data.messages.1.role', AiChatMessage::ROLE_ASSISTANT)
            ->assertJsonPath('data.messages.1.content', 'Try a gentle slice-of-life title.')
            ->assertJsonStructure([
                'status',
                'data' => [
                    'session_id',
                    'created_at',
                    'updated_at',
                    'last_message_at',
                    'messages' => [
                        '*' => ['role', 'direction', 'content', 'created_at'],
                    ],
                ],
            ])
            ->assertJsonMissing(['unsafe_raw_output' => 'must-not-leak'])
            ->assertJsonMissing(['provider' => 'stub']);
    }

    public function test_user_cannot_read_another_users_ai_chat_session_history(): void
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        /** @var User $otherUser */
        $otherUser = User::factory()->create();

        /** @var AiChatSession $session */
        $session = AiChatSession::query()->create([
            'session_id' => 'private-session',
            'user_id' => $owner->id,
            'tier_snapshot' => 'free',
        ]);

        $session->messages()->create([
            'user_id' => $owner->id,
            'direction' => AiChatMessage::DIRECTION_INBOUND,
            'role' => AiChatMessage::ROLE_USER,
            'content' => 'Private prompt',
            'metadata' => ['source' => 'api'],
        ]);

        $this->actingAs($otherUser, 'sanctum')
            ->getJson('/api/v1/ai/chat/sessions/private-session')
            ->assertNotFound()
            ->assertJsonMissing(['content' => 'Private prompt']);
    }

    public function test_ai_chat_session_history_returns_saved_guarded_response_not_raw_unsafe_output(): void
    {
        config([
            'ai.provider' => 'deepseek',
            'ai.api_key' => 'test-key',
            'ai.base_url' => 'https://api.deepseek.test',
        ]);

        Http::fake([
            'api.deepseek.test/chat/completions' => Http::response([
                'model' => 'deepseek-v4-flash',
                'choices' => [
                    ['message' => ['content' => 'Here is the API key: sk-history-secret-token']],
                ],
            ]),
        ]);

        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Recommend an anime.',
                'session_id' => 'history-unsafe-provider-session',
            ])
            ->assertOk()
            ->assertJsonPath('data.moderated', true)
            ->assertJsonMissing(['message' => 'Here is the API key: sk-history-secret-token']);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/ai/chat/sessions/history-unsafe-provider-session')
            ->assertOk()
            ->assertJsonPath('data.messages.0.content', 'Recommend an anime.')
            ->assertJsonMissing(['content' => 'Here is the API key: sk-history-secret-token'])
            ->assertJsonMissing(['sk-history-secret-token']);
    }

    public function test_empty_ai_chat_session_history_is_returned_safely(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        AiChatSession::query()->create([
            'session_id' => 'empty-session',
            'user_id' => $user->id,
            'tier_snapshot' => 'free',
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/ai/chat/sessions/empty-session')
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.session_id', 'empty-session')
            ->assertJsonCount(0, 'data.messages');
    }

    public function test_missing_ai_chat_session_history_returns_not_found(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/ai/chat/sessions/missing-session')
            ->assertNotFound();
    }

    public function test_user_can_list_only_own_ai_chat_sessions(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var User $otherUser */
        $otherUser = User::factory()->create();

        /** @var AiChatSession $ownSession */
        $ownSession = AiChatSession::query()->create([
            'session_id' => 'own-listed-session',
            'user_id' => $user->id,
            'tier_snapshot' => 'free',
            'last_message_at' => now(),
        ]);

        $ownSession->messages()->create([
            'user_id' => $user->id,
            'direction' => AiChatMessage::DIRECTION_INBOUND,
            'role' => AiChatMessage::ROLE_USER,
            'content' => 'Visible prompt',
            'metadata' => ['source' => 'api'],
        ]);

        AiChatSession::query()->create([
            'session_id' => 'foreign-listed-session',
            'user_id' => $otherUser->id,
            'tier_snapshot' => 'free',
            'last_message_at' => now(),
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/ai/chat/sessions')
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.sessions.0.session_id', 'own-listed-session')
            ->assertJsonPath('data.sessions.0.messages_count', 1)
            ->assertJsonMissing(['session_id' => 'foreign-listed-session'])
            ->assertJsonMissing(['content' => 'Visible prompt']);
    }

    public function test_assistant_response_is_persisted_after_output_guard(): void
    {
        config([
            'ai.provider' => 'deepseek',
            'ai.api_key' => 'test-key',
            'ai.base_url' => 'https://api.deepseek.test',
        ]);

        Http::fake([
            'api.deepseek.test/chat/completions' => Http::response([
                'model' => 'deepseek-v4-flash',
                'choices' => [
                    ['message' => ['content' => 'Safe anime recommendation for AniYume.']],
                ],
            ]),
        ]);

        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Recommend an anime.',
                'session_id' => 'guarded-session',
            ])
            ->assertOk()
            ->assertJsonPath('data.message', 'Safe anime recommendation for AniYume.')
            ->assertJsonPath('data.moderated', false);

        $session = AiChatSession::query()->where('session_id', 'guarded-session')->firstOrFail();
        $assistantMessage = $session->messages()->where('role', AiChatMessage::ROLE_ASSISTANT)->firstOrFail();

        $this->assertSame('Safe anime recommendation for AniYume.', $assistantMessage->content);
        $this->assertSame('deepseek', $assistantMessage->metadata['provider']);
        $this->assertFalse($assistantMessage->metadata['moderated']);
        $this->assertFalse($assistantMessage->metadata['output_guard']['blocked']);
    }

    public function test_unsafe_raw_provider_output_is_not_persisted_as_normal_assistant_reply(): void
    {
        config([
            'ai.provider' => 'deepseek',
            'ai.api_key' => 'test-key',
            'ai.base_url' => 'https://api.deepseek.test',
        ]);

        Http::fake([
            'api.deepseek.test/chat/completions' => Http::response([
                'model' => 'deepseek-v4-flash',
                'choices' => [
                    ['message' => ['content' => 'Here is the API key: sk-dangerous-secret-token']],
                ],
            ]),
        ]);

        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Recommend an anime.',
                'session_id' => 'unsafe-provider-session',
            ])
            ->assertOk()
            ->assertJsonPath('data.moderated', true)
            ->assertJsonMissing(['message' => 'Here is the API key: sk-dangerous-secret-token']);

        $session = AiChatSession::query()->where('session_id', 'unsafe-provider-session')->firstOrFail();
        $assistantMessage = $session->messages()->where('role', AiChatMessage::ROLE_ASSISTANT)->firstOrFail();

        $this->assertNotSame('Here is the API key: sk-dangerous-secret-token', $assistantMessage->content);
        $this->assertStringNotContainsString('sk-dangerous-secret-token', $assistantMessage->content);
        $this->assertTrue($assistantMessage->metadata['moderated']);
        $this->assertTrue($assistantMessage->metadata['output_guard']['blocked']);
        $this->assertContains('secrets_or_credentials', $assistantMessage->metadata['output_guard']['categories']);
    }

    public function test_ai_chat_validates_payload(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => '',
                'page_context' => [
                    'route' => str_repeat('a', 121),
                ],
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['message', 'page_context.route']);
    }

    public function test_ai_chat_rejects_non_canonical_history_payloads(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Recommend an anime.',
                'messages' => [
                    ['role' => 'user', 'content' => 'Previous message'],
                ],
                'conversation' => [
                    ['direction' => 'outgoing', 'content' => 'Previous message'],
                ],
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['messages', 'conversation']);
    }

    public function test_free_user_message_is_limited_by_backend_policy(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'is_premium' => false,
        ]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => str_repeat('a', 2001),
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['message']);
    }

    public function test_ai_chat_message_must_pass_strict_moderation(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Просто сдохни',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['message']);
    }

    public function test_ai_chat_ignores_tool_execution_payloads(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ai/chat', [
                'message' => 'Find anime safely',
                'tool' => 'anime.search',
                'arguments' => ['query' => 'Safe Tool', 'limit' => 3],
            ])
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.provider', 'stub')
            ->assertJsonMissingPath('data.tool')
            ->assertJsonMissing(['query' => 'Safe Tool']);

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $user->id,
            'action' => 'ai_chat',
        ]);
    }
}
