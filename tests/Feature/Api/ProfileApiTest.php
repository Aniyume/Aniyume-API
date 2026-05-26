<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_endpoints_require_authentication(): void
    {
        $this->getJson('/api/v1/profile/me')->assertUnauthorized();
        $this->putJson('/api/v1/profile/me', ['name' => 'No Auth'])->assertUnauthorized();
        $this->postJson('/api/v1/profile/me/avatar')->assertUnauthorized();
    }

    public function test_authenticated_user_can_get_full_profile(): void
    {
        $user = User::factory()->create([
            'name' => 'Profile User',
            'bio' => 'Bio text',
            'custom_status' => 'Watching anime',
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/profile/me')
            ->assertOk()
            ->assertJsonPath('user.id', $user->id)
            ->assertJsonPath('user.name', 'Profile User')
            ->assertJsonPath('user.bio', 'Bio text')
            ->assertJsonStructure([
                'user',
                'stats',
                'watch_time',
                'watch_dynamics',
                'recently_watched',
                'counts',
            ]);
    }

    public function test_authenticated_user_can_update_profile(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me', [
                'name' => 'Updated Name',
                'bio' => 'Updated bio',
                'custom_status' => 'Updated status',
            ])
            ->assertOk()
            ->assertJsonPath('message', 'Profile updated successfully')
            ->assertJsonPath('user.name', 'Updated Name')
            ->assertJsonPath('user.bio', 'Updated bio')
            ->assertJsonPath('user.custom_status', 'Updated status');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'bio' => 'Updated bio',
            'custom_status' => 'Updated status',
        ]);
    }

    public function test_invalid_profile_payload_returns_validation_error(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me', [
                'name' => str_repeat('a', 256),
                'bio' => str_repeat('b', 501),
                'custom_status' => str_repeat('c', 101),
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'bio', 'custom_status']);
    }

    public function test_profile_text_must_pass_moderation(): void
    {
        $user = User::factory()->create([
            'bio' => 'Initial bio',
            'custom_status' => 'Initial status',
        ]);

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me', [
                'bio' => 'Ты идиот',
                'custom_status' => 'Что за х у й',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['bio', 'custom_status']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'bio' => 'Initial bio',
            'custom_status' => 'Initial status',
        ]);
    }
}
