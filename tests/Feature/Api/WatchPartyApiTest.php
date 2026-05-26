<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\User;
use App\Models\WatchPartyMessage;
use App\Models\WatchPartyParticipant;
use App\Models\WatchPartyRoom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class WatchPartyApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_watch_party_endpoints_require_authentication(): void
    {
        $anime = Anime::factory()->create();
        $room = WatchPartyRoom::create([
            'code' => 'ABC123',
            'anime_id' => $anime->id,
            'episode_number' => 1,
            'host_user_id' => User::factory()->create()->id,
            'is_active' => true,
        ]);

        $this->postJson('/api/v1/watch-party', ['anime_id' => $anime->id, 'episode_number' => 1])->assertUnauthorized();
        $this->getJson("/api/v1/watch-party/{$room->code}")->assertUnauthorized();
        $this->postJson("/api/v1/watch-party/{$room->code}/join")->assertUnauthorized();
        $this->postJson("/api/v1/watch-party/{$room->code}/message", ['message' => 'hi'])->assertUnauthorized();
        $this->postJson("/api/v1/watch-party/{$room->code}/sync", [
            'current_time' => 1,
            'is_playing' => true,
            'episode_number' => 1,
        ])->assertUnauthorized();
        $this->deleteJson("/api/v1/watch-party/{$room->code}")->assertUnauthorized();
    }

    public function test_user_can_create_watch_party_room(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $previousRoom = $this->createRoom($user, $anime);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/watch-party', [
                'anime_id' => $anime->id,
                'episode_number' => 2,
                'max_participants' => 5,
            ])
            ->assertCreated()
            ->assertJsonStructure([
                'room' => ['id', 'code', 'join_url', 'episode_number', 'participants_count'],
                'join_url',
            ])
            ->assertJsonPath('room.episode_number', 2)
            ->assertJsonPath('room.max_participants', 5);

        $this->assertDatabaseHas('watch_party_rooms', [
            'anime_id' => $anime->id,
            'host_user_id' => $user->id,
            'episode_number' => 2,
            'is_active' => true,
        ]);
        $this->assertDatabaseHas('watch_party_rooms', [
            'id' => $previousRoom->id,
            'is_active' => false,
        ]);
        $this->assertDatabaseHas('watch_party_participants', [
            'user_id' => $user->id,
            'is_active' => true,
        ]);
    }

    public function test_user_can_show_active_room(): void
    {
        $host = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($host, 'sanctum')
            ->getJson("/api/v1/watch-party/{$room->code}")
            ->assertOk()
            ->assertJsonPath('id', $room->id)
            ->assertJsonPath('code', $room->code)
            ->assertJsonPath('anime.id', $anime->id)
            ->assertJsonPath('host.id', $host->id);
    }

    public function test_another_user_can_join_room(): void
    {
        $host = User::factory()->create();
        $guest = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($guest, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/join")
            ->assertOk()
            ->assertJsonPath('room.code', $room->code)
            ->assertJsonPath('state.episode_number', $room->episode_number);

        $this->assertDatabaseHas('watch_party_participants', [
            'room_id' => $room->id,
            'user_id' => $guest->id,
            'is_active' => true,
        ]);
    }

    public function test_user_cannot_join_full_room(): void
    {
        $host = User::factory()->create();
        $guest = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime, maxParticipants: 1);

        $this->actingAs($guest, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/join")
            ->assertForbidden()
            ->assertJsonPath('message', 'Комната заполнена');
    }

    public function test_participant_can_send_and_fetch_messages(): void
    {
        Event::fake();

        $host = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($host, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/message", ['message' => 'Hello party'])
            ->assertCreated()
            ->assertJsonPath('message', 'Hello party')
            ->assertJsonPath('user_id', $host->id);

        $this->assertDatabaseHas('watch_party_messages', [
            'room_id' => $room->id,
            'user_id' => $host->id,
            'message' => 'Hello party',
            'type' => 'message',
        ]);

        $this->actingAs($host, 'sanctum')
            ->getJson("/api/v1/watch-party/{$room->code}/messages")
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.message', 'Hello party');
    }

    public function test_non_participant_cannot_send_message(): void
    {
        $host = User::factory()->create();
        $outsider = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($outsider, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/message", ['message' => 'I should not send'])
            ->assertForbidden()
            ->assertJsonPath('message', 'Вы не являетесь участником комнаты');
    }

    public function test_watch_party_message_must_pass_moderation(): void
    {
        $host = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($host, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/message", ['message' => 'Ты дебил'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['message']);

        $this->assertDatabaseMissing('watch_party_messages', [
            'room_id' => $room->id,
            'user_id' => $host->id,
            'message' => 'Ты дебил',
        ]);
    }

    public function test_host_can_sync_player_state(): void
    {
        Event::fake();

        $host = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($host, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/sync", [
                'current_time' => 123.45,
                'is_playing' => true,
                'episode_number' => 3,
            ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('watch_party_rooms', [
            'id' => $room->id,
            'episode_number' => 3,
            'is_playing' => true,
        ]);
    }

    public function test_non_host_cannot_sync_player_state(): void
    {
        $host = User::factory()->create();
        $guest = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);
        WatchPartyParticipant::create([
            'room_id' => $room->id,
            'user_id' => $guest->id,
            'is_active' => true,
        ]);

        $this->actingAs($guest, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/sync", [
                'current_time' => 10,
                'is_playing' => false,
                'episode_number' => 1,
            ])
            ->assertForbidden()
            ->assertJsonPath('message', 'Только хост может управлять плеером');
    }

    public function test_participant_can_leave_room(): void
    {
        $host = User::factory()->create();
        $guest = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);
        WatchPartyParticipant::create([
            'room_id' => $room->id,
            'user_id' => $guest->id,
            'is_active' => true,
        ]);

        $this->actingAs($guest, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/leave")
            ->assertOk()
            ->assertJsonPath('message', 'Покинул комнату');

        $this->assertDatabaseHas('watch_party_participants', [
            'room_id' => $room->id,
            'user_id' => $guest->id,
            'is_active' => false,
        ]);
    }

    public function test_host_leave_closes_room(): void
    {
        Event::fake();

        $host = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($host, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/leave")
            ->assertOk()
            ->assertJsonPath('message', 'Покинул комнату');

        $this->assertDatabaseHas('watch_party_rooms', [
            'id' => $room->id,
            'is_active' => false,
        ]);
    }

    public function test_host_can_close_room(): void
    {
        Event::fake();

        $host = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($host, 'sanctum')
            ->deleteJson("/api/v1/watch-party/{$room->code}")
            ->assertOk()
            ->assertJsonPath('message', 'Комната закрыта');

        $this->assertDatabaseHas('watch_party_rooms', [
            'id' => $room->id,
            'is_active' => false,
        ]);
    }

    public function test_non_host_cannot_close_room(): void
    {
        $host = User::factory()->create();
        $guest = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($guest, 'sanctum')
            ->deleteJson("/api/v1/watch-party/{$room->code}")
            ->assertForbidden()
            ->assertJsonPath('message', 'Только хост может закрыть комнату');
    }

    public function test_user_can_invite_friend_to_room(): void
    {
        Event::fake();

        $host = User::factory()->create();
        $friend = User::factory()->create();
        $anime = Anime::factory()->create();
        $room = $this->createRoom($host, $anime);

        $this->actingAs($host, 'sanctum')
            ->postJson("/api/v1/watch-party/{$room->code}/invite", ['friend_id' => $friend->id])
            ->assertOk()
            ->assertJsonPath('message', 'Приглашение отправлено');
    }

    private function createRoom(User $host, Anime $anime, int $maxParticipants = 10): WatchPartyRoom
    {
        $room = WatchPartyRoom::create([
            'code' => WatchPartyRoom::generateCode(),
            'anime_id' => $anime->id,
            'episode_number' => 1,
            'host_user_id' => $host->id,
            'is_active' => true,
            'max_participants' => $maxParticipants,
            'is_private' => false,
            'is_playing' => false,
            'current_time' => 0,
        ]);

        WatchPartyParticipant::create([
            'room_id' => $room->id,
            'user_id' => $host->id,
            'is_active' => true,
        ]);

        return $room;
    }
}
