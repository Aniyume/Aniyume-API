<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\Favorite;
use App\Models\User;
use App\Models\WatchHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProfilePrivacyApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_user_defaults_to_friends_visibility(): void
    {
        $user = User::factory()->create();
        $user->refresh();

        $this->assertSame('friends', $user->privacy_favorites);
        $this->assertSame('friends', $user->privacy_watch_history);
        $this->assertSame('friends', $user->privacy_ratings);
    }

    public function test_get_privacy_returns_current_settings(): void
    {
        $user = User::factory()->create([
            'privacy_favorites' => 'everyone',
            'privacy_watch_history' => 'friends',
            'privacy_ratings' => 'nobody',
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/profile/me/privacy')
            ->assertOk()
            ->assertJson([
                'favorites' => 'everyone',
                'watch_history' => 'friends',
                'ratings' => 'nobody',
            ]);
    }

    public function test_update_privacy_persists_values(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me/privacy', [
                'favorites' => 'everyone',
                'watch_history' => 'nobody',
                'ratings' => 'friends',
            ])
            ->assertOk()
            ->assertJson([
                'favorites' => 'everyone',
                'watch_history' => 'nobody',
                'ratings' => 'friends',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'privacy_favorites' => 'everyone',
            'privacy_watch_history' => 'nobody',
            'privacy_ratings' => 'friends',
        ]);
    }

    public function test_update_privacy_rejects_invalid_value(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me/privacy', [
                'favorites' => 'public',
                'watch_history' => 'friends',
                'ratings' => 'friends',
            ])
            ->assertStatus(422);
    }

    public function test_privacy_endpoints_require_authentication(): void
    {
        $this->getJson('/api/v1/profile/me/privacy')->assertUnauthorized();
        $this->putJson('/api/v1/profile/me/privacy', [])->assertUnauthorized();
    }

    private function befriend(User $a, User $b): void
    {
        DB::table('friendships')->insert([
            'user_id' => $a->id,
            'friend_id' => $b->id,
            'status' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_friend_can_view_favorites_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'friends']);
        $friend = User::factory()->create();
        $this->befriend($owner, $friend);
        $anime = Anime::factory()->create();
        Favorite::create(['user_id' => $owner->id, 'anime_id' => $anime->id]);

        $this->actingAs($friend, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/favorites")
            ->assertOk()
            ->assertJsonPath('data.0.anime_id', $anime->id);
    }

    public function test_stranger_blocked_from_favorites_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'friends']);
        $stranger = User::factory()->create();

        $this->actingAs($stranger, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/favorites")
            ->assertForbidden()
            ->assertJsonPath('reason', 'private');
    }

    public function test_anyone_views_favorites_when_level_everyone(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'everyone']);
        $stranger = User::factory()->create();

        $this->actingAs($stranger, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/favorites")
            ->assertOk();
    }

    public function test_friend_can_view_watch_history_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_watch_history' => 'friends']);
        $friend = User::factory()->create();
        $this->befriend($owner, $friend);
        $anime = Anime::factory()->create();
        WatchHistory::create([
            'user_id' => $owner->id,
            'anime_id' => $anime->id,
            'watch_time' => 100,
            'watched_at' => now(),
        ]);

        $this->actingAs($friend, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/watch-history")
            ->assertOk()
            ->assertJsonStructure(['data', 'pagination']);
    }

    public function test_stranger_blocked_from_watch_history_when_nobody(): void
    {
        $owner = User::factory()->create(['privacy_watch_history' => 'nobody']);
        $friend = User::factory()->create();
        $this->befriend($owner, $friend);

        $this->actingAs($friend, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/watch-history")
            ->assertForbidden()
            ->assertJsonPath('reason', 'private');
    }
}
