<?php

namespace Tests\Feature\Api;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DirectMessageApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_friends_can_exchange_messages_and_list_last_message(): void
    {
        [$sender, $recipient] = $this->friends();

        $this->actingAs($sender, 'sanctum')
            ->postJson("/api/v1/chats/{$recipient->id}/messages", ['body' => 'Hello'])
            ->assertCreated()
            ->assertJsonPath('data.body', 'Hello');

        $this->actingAs($recipient, 'sanctum')
            ->getJson("/api/v1/chats/{$sender->id}")
            ->assertOk()
            ->assertJsonPath('messages.0.body', 'Hello');

        $this->actingAs($sender, 'sanctum')
            ->getJson('/api/v1/chats')
            ->assertOk()
            ->assertJsonPath('data.0.user.id', $recipient->id)
            ->assertJsonPath('data.0.last_message.body', 'Hello');
    }

    public function test_non_friends_cannot_message_each_other(): void
    {
        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        $this->actingAs($sender, 'sanctum')
            ->postJson("/api/v1/chats/{$recipient->id}/messages", ['body' => 'Hello'])
            ->assertForbidden();
    }

    public function test_repeated_messages_trigger_five_second_mute(): void
    {
        [$sender, $recipient] = $this->friends();

        foreach (range(1, 2) as $_) {
            $this->actingAs($sender, 'sanctum')
                ->postJson("/api/v1/chats/{$recipient->id}/messages", ['body' => 'spam'])
                ->assertCreated();
        }

        $this->actingAs($sender, 'sanctum')
            ->postJson("/api/v1/chats/{$recipient->id}/messages", ['body' => 'spam'])
            ->assertStatus(429);
    }

    public function test_user_can_block_and_clear_chat(): void
    {
        [$sender, $recipient] = $this->friends();
        $this->actingAs($sender, 'sanctum')->postJson("/api/v1/chats/{$recipient->id}/messages", ['body' => 'Hello']);

        $this->actingAs($sender, 'sanctum')
            ->postJson("/api/v1/chats/{$recipient->id}/block")
            ->assertOk()
            ->assertJsonPath('blocked', true);

        $this->actingAs($recipient, 'sanctum')
            ->postJson("/api/v1/chats/{$sender->id}/messages", ['body' => 'Blocked'])
            ->assertForbidden();

        $this->actingAs($sender, 'sanctum')
            ->deleteJson("/api/v1/chats/{$recipient->id}")
            ->assertOk();

        $this->assertDatabaseCount('direct_messages', 0);
    }

    private function friends(): array
    {
        $sender = User::factory()->create();
        $recipient = User::factory()->create();
        Friendship::create([
            'user_id' => $sender->id,
            'friend_id' => $recipient->id,
            'status' => 'accepted',
        ]);

        return [$sender, $recipient];
    }
}
