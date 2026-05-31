<?php

namespace Tests\Feature\Api;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FriendshipApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (! Schema::hasColumn('users', 'is_online')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_online')->default(false);
            });
        }
    }

    public function test_authenticated_user_can_send_and_target_can_accept_friend_request(): void
    {
        /** @var User $sender */
        $sender = User::factory()->create();
        /** @var User $target */
        $target = User::factory()->create();

        $this->actingAs($sender, 'sanctum')
            ->postJson("/api/v1/friends/{$target->id}")
            ->assertCreated()
            ->assertJsonPath('message', 'Заявка отправлена');

        $this->assertDatabaseHas('friendships', [
            'user_id' => $sender->id,
            'friend_id' => $target->id,
            'status' => 'pending',
        ]);

        $this->actingAs($target, 'sanctum')
            ->postJson("/api/v1/friends/{$sender->id}/accept")
            ->assertOk()
            ->assertJsonPath('message', 'Заявка принята');

        $this->assertDatabaseHas('friendships', [
            'user_id' => $sender->id,
            'friend_id' => $target->id,
            'status' => 'accepted',
        ]);
    }

    public function test_friendship_status_preserves_pending_sender_and_accepted_contract(): void
    {
        /** @var User $sender */
        $sender = User::factory()->create();
        /** @var User $target */
        $target = User::factory()->create();

        Friendship::create([
            'user_id' => $sender->id,
            'friend_id' => $target->id,
            'status' => 'pending',
        ]);

        $this->actingAs($sender, 'sanctum')
            ->getJson("/api/v1/friends/{$target->id}/status")
            ->assertOk()
            ->assertJson([
                'status' => 'pending',
                'is_sender' => true,
            ]);

        $this->actingAs($target, 'sanctum')
            ->getJson("/api/v1/friends/{$sender->id}/status")
            ->assertOk()
            ->assertJson([
                'status' => 'pending',
                'is_sender' => false,
            ]);

        Friendship::query()->update(['status' => 'accepted']);

        $this->actingAs($sender, 'sanctum')
            ->getJson("/api/v1/friends/{$target->id}/status")
            ->assertOk()
            ->assertExactJson(['status' => 'accepted']);
    }

    public function test_requests_lists_count_and_decline_preserve_response_shapes(): void
    {
        /** @var User $currentUser */
        $currentUser = User::factory()->create();
        /** @var User $incomingUser */
        $incomingUser = User::factory()->create([
            'name' => 'Incoming Friend',
            'avatar' => 'incoming.png',
            'custom_status' => 'hello',
            'is_online' => true,
        ]);
        /** @var User $outgoingUser */
        $outgoingUser = User::factory()->create(['name' => 'Outgoing Friend']);

        Friendship::create([
            'user_id' => $incomingUser->id,
            'friend_id' => $currentUser->id,
            'status' => 'pending',
        ]);
        Friendship::create([
            'user_id' => $currentUser->id,
            'friend_id' => $outgoingUser->id,
            'status' => 'pending',
        ]);

        $this->actingAs($currentUser, 'sanctum')
            ->getJson('/api/v1/friends/requests')
            ->assertOk()
            ->assertJsonPath('incoming.0.id', $incomingUser->id)
            ->assertJsonPath('incoming.0.avatar', '/api-storage/avatars/incoming.png')
            ->assertJsonPath('incoming.0.custom_status', 'hello')
            ->assertJsonPath('incoming.0.is_online', true)
            ->assertJsonPath('outgoing.0.id', $outgoingUser->id);

        $this->actingAs($currentUser, 'sanctum')
            ->getJson('/api/v1/friends/requests/count')
            ->assertOk()
            ->assertExactJson(['count' => 1]);

        $this->actingAs($currentUser, 'sanctum')
            ->postJson("/api/v1/friends/{$incomingUser->id}/decline")
            ->assertOk()
            ->assertJsonPath('message', 'Удалено');

        $this->assertDatabaseMissing('friendships', [
            'user_id' => $incomingUser->id,
            'friend_id' => $currentUser->id,
        ]);
    }

    public function test_search_users_preserves_formatting_and_excludes_current_user(): void
    {
        /** @var User $currentUser */
        $currentUser = User::factory()->create(['name' => 'Naruto Current']);
        /** @var User $foundUser */
        $foundUser = User::factory()->create([
            'name' => 'Naruto Uzumaki',
            'avatar' => 'naruto.jpg',
            'custom_status' => 'dattebayo',
            'is_online' => false,
        ]);
        User::factory()->create(['name' => 'Sasuke Uchiha']);

        $this->actingAs($currentUser, 'sanctum')
            ->getJson('/api/v1/users/search?q=Naruto')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertExactJson([
                [
                    'id' => $foundUser->id,
                    'name' => 'Naruto Uzumaki',
                    'avatar' => '/api-storage/avatars/naruto.jpg',
                    'custom_status' => 'dattebayo',
                    'is_online' => false,
                ],
            ]);
    }
}
