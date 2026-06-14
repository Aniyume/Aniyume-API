<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\ProfileVisibilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProfileVisibilityServiceTest extends TestCase
{
    use RefreshDatabase;

    private function makeFriends(User $a, User $b): void
    {
        DB::table('friendships')->insert([
            'user_id' => $a->id,
            'friend_id' => $b->id,
            'status' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_owner_always_sees_own_section(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'nobody']);
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($owner, $owner, 'favorites'));
    }

    public function test_everyone_level_visible_to_stranger_and_guest(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'everyone']);
        $stranger = User::factory()->create();
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($stranger, $owner, 'favorites'));
        $this->assertTrue($service->canView(null, $owner, 'favorites'));
    }

    public function test_friends_level_visible_only_to_friends(): void
    {
        $owner = User::factory()->create(['privacy_ratings' => 'friends']);
        $friend = User::factory()->create();
        $stranger = User::factory()->create();
        $this->makeFriends($owner, $friend);
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($friend, $owner, 'ratings'));
        $this->assertFalse($service->canView($stranger, $owner, 'ratings'));
        $this->assertFalse($service->canView(null, $owner, 'ratings'));
    }

    public function test_nobody_level_hidden_from_everyone_but_owner(): void
    {
        $owner = User::factory()->create(['privacy_watch_history' => 'nobody']);
        $friend = User::factory()->create();
        $this->makeFriends($owner, $friend);
        $service = app(ProfileVisibilityService::class);

        $this->assertFalse($service->canView($friend, $owner, 'watch_history'));
    }

    public function test_friendship_is_detected_in_either_direction(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'friends']);
        $friend = User::factory()->create();
        DB::table('friendships')->insert([
            'user_id' => $friend->id,
            'friend_id' => $owner->id,
            'status' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($friend, $owner, 'favorites'));
    }
}
