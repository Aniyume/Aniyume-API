<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\Episode;
use App\Models\User;
use App\Models\WatchHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WatchHistoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_watch_history_endpoints_require_authentication(): void
    {
        $anime = Anime::factory()->create();
        $episode = Episode::factory()->create(['anime_id' => $anime->id]);

        $this->getJson('/api/v1/watch-history')->assertUnauthorized();
        $this->postJson('/api/v1/watch-history', [
            'episode_id' => $episode->id,
            'progress' => 10,
            'delta_time' => 10,
        ])->assertUnauthorized();
        $this->getJson("/api/v1/watch-history/anime/{$anime->id}/history")->assertUnauthorized();
        $this->getJson("/api/v1/watch-history/anime/{$anime->id}/last-episode")->assertUnauthorized();
    }

    public function test_store_requires_episode_progress_and_delta_time(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/watch-history', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['episode_id', 'progress', 'delta_time']);
    }

    public function test_user_can_store_watch_progress(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $episode = Episode::factory()->create(['anime_id' => $anime->id]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/watch-history', [
                'episode_id' => $episode->id,
                'progress' => 120,
                'delta_time' => 30,
                'completed' => false,
            ])
            ->assertOk()
            ->assertJsonPath('message', 'Time recorded')
            ->assertJsonPath('total_playtime', 30)
            ->assertJsonPath('progress', 120);

        $this->assertDatabaseHas('watch_history', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'episode_id' => $episode->id,
            'progress' => 120,
            'watch_time' => 30,
        ]);
    }

    public function test_repeated_store_updates_existing_progress_and_increments_watch_time(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $episode = Episode::factory()->create(['anime_id' => $anime->id]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/watch-history', [
                'episode_id' => $episode->id,
                'progress' => 60,
                'delta_time' => 20,
            ])
            ->assertOk();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/watch-history', [
                'episode_id' => $episode->id,
                'progress' => 150,
                'delta_time' => 40,
            ])
            ->assertOk()
            ->assertJsonPath('total_playtime', 60)
            ->assertJsonPath('progress', 150);

        $this->assertSame(1, WatchHistory::where('user_id', $user->id)->where('episode_id', $episode->id)->count());
    }

    public function test_user_can_get_history_by_anime(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $episode = Episode::factory()->create(['anime_id' => $anime->id, 'episode_number' => 3]);

        WatchHistory::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'episode_id' => $episode->id,
            'progress' => 200,
            'watch_time' => 50,
            'completed' => false,
            'watched_at' => now(),
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/watch-history/anime/{$anime->id}/history")
            ->assertOk()
            ->assertJsonPath('anime_id', (string) $anime->id)
            ->assertJsonPath('last_episode', 3)
            ->assertJsonPath('total_watched', 1)
            ->assertJsonCount(1, 'history');
    }

    public function test_user_can_get_last_watched_episode(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $episode = Episode::factory()->create(['anime_id' => $anime->id, 'episode_number' => 5]);

        WatchHistory::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'episode_id' => $episode->id,
            'progress' => 321,
            'watch_time' => 90,
            'completed' => false,
            'watched_at' => now(),
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/watch-history/anime/{$anime->id}/last-episode")
            ->assertOk()
            ->assertJsonPath('anime_id', (string) $anime->id)
            ->assertJsonPath('last_episode', 5)
            ->assertJsonPath('episode_id', $episode->id)
            ->assertJsonPath('progress', 321);
    }

    public function test_user_can_delete_watch_history_record(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $episode = Episode::factory()->create(['anime_id' => $anime->id]);
        $history = WatchHistory::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'episode_id' => $episode->id,
            'progress' => 100,
            'watch_time' => 40,
            'completed' => false,
            'watched_at' => now(),
        ]);

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/watch-history/{$history->id}")
            ->assertOk()
            ->assertJsonPath('message', 'Watch history removed');

        $this->assertDatabaseMissing('watch_history', [
            'id' => $history->id,
        ]);
    }
}
