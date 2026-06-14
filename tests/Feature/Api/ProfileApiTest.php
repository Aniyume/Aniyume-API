<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_endpoints_require_authentication(): void
    {
        $this->getJson('/api/v1/profile/me')->assertUnauthorized();
        $this->putJson('/api/v1/profile/me', ['name' => 'No Auth'])->assertUnauthorized();
        $this->patchJson('/api/v1/profile/me/account', ['current_password' => 'password'])->assertUnauthorized();
        $this->postJson('/api/v1/profile/me/avatar')->assertUnauthorized();
    }

    public function test_authenticated_user_can_get_full_profile(): void
    {
        $user = User::factory()->create([
            'name' => 'Profile User',
            'custom_status' => 'Watching anime',
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/profile/me')
            ->assertOk()
            ->assertJsonPath('user.id', $user->id)
            ->assertJsonPath('user.name', 'Profile User')
            ->assertJsonPath('user.custom_status', 'Watching anime')
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
                'custom_status' => 'Updated status',
            ])
            ->assertOk()
            ->assertJsonPath('message', 'Profile updated successfully')
            ->assertJsonPath('user.name', 'Updated Name')
            ->assertJsonPath('user.custom_status', 'Updated status');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'custom_status' => 'Updated status',
        ]);
    }

    public function test_invalid_profile_payload_returns_validation_error(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me', [
                'name' => str_repeat('a', 256),
                'custom_status' => str_repeat('c', 101),
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'custom_status']);
    }

    public function test_profile_text_must_pass_moderation(): void
    {
        $user = User::factory()->create([
            'custom_status' => 'Initial status',
        ]);

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me', [
                'custom_status' => 'Что за х у й',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['custom_status']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'custom_status' => 'Initial status',
        ]);
    }

    public function test_user_can_save_social_links_and_check_name_availability(): void
    {
        $user = User::factory()->create(['name' => 'CurrentName']);
        User::factory()->create(['name' => 'TakenName']);

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me', [
                'social_links' => ['https://t.me/current-name', 'https://github.com/current-name'],
            ])
            ->assertOk()
            ->assertJsonPath('user.social_links.0', 'https://t.me/current-name');

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/profile/name-availability?name=TakenName')
            ->assertOk()
            ->assertJsonPath('available', false)
            ->assertJsonCount(3, 'suggestions');

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/profile/name-availability?name=CurrentName')
            ->assertOk()
            ->assertJsonPath('available', true);
    }

    public function test_unchanged_admin_profile_values_do_not_block_other_profile_updates(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin Set Name',
            'custom_status' => 'Admin Set Status',
        ]);

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me', [
                'name' => 'Admin Set Name',
                'custom_status' => 'Admin Set Status',
                'social_links' => ['https://example.com/profile'],
            ])
            ->assertOk()
            ->assertJsonPath('user.social_links.0', 'https://example.com/profile');
    }

    public function test_non_premium_user_can_equip_and_remove_admin_granted_frame(): void
    {
        $user = User::factory()->create(['is_premium' => false]);
        DB::table('user_profile_frames')->insert([
            'user_id' => $user->id,
            'frame_key' => 'ramkaShark',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/profile/me/frames/select', ['frame_key' => 'ramkaShark'])
            ->assertOk()
            ->assertJsonPath('selected', 'ramkaShark');

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/profile/me/frames/select', ['frame_key' => 'none'])
            ->assertOk()
            ->assertJsonPath('selected', 'none');
    }

    public function test_user_can_change_email_and_password_with_current_password(): void
    {
        $user = User::factory()->create([
            'email' => 'old@example.com',
            'password' => Hash::make('old-password'),
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user, 'sanctum')
            ->patchJson('/api/v1/profile/me/account', [
                'current_password' => 'old-password',
                'email' => 'new@example.com',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->assertOk()
            ->assertJsonPath('user.email', 'new@example.com');

        $user->refresh();
        $this->assertSame('new@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
        $this->assertTrue(Hash::check('new-password', $user->password));
    }

    public function test_account_update_rejects_wrong_current_password_and_duplicate_email(): void
    {
        $user = User::factory()->create(['password' => Hash::make('correct-password')]);
        $other = User::factory()->create(['email' => 'taken@example.com']);

        $this->actingAs($user, 'sanctum')
            ->patchJson('/api/v1/profile/me/account', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['current_password']);

        $this->actingAs($user, 'sanctum')
            ->patchJson('/api/v1/profile/me/account', [
                'current_password' => 'correct-password',
                'email' => $other->email,
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }
}
