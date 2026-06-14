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
}
