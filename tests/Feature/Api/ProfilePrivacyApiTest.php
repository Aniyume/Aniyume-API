<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
