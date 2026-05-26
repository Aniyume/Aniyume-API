<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAnimeListApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_anime_list_requires_authentication(): void
    {
        $anime = Anime::factory()->create();

        $this->getJson('/api/v1/my-anime-list/watching')->assertUnauthorized();
        $this->postJson("/api/v1/anime/{$anime->id}/status", ['status' => 'watching'])->assertUnauthorized();
        $this->getJson("/api/v1/anime/{$anime->id}/user-status")->assertUnauthorized();
        $this->patchJson("/api/v1/anime/{$anime->id}/episodes-watched/1")->assertUnauthorized();
    }

    public function test_user_can_set_anime_status(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/anime/{$anime->id}/status", ['status' => 'watching'])
            ->assertOk()
            ->assertJsonPath('message', 'Status updated')
            ->assertJsonPath('status', 'watching');

        $this->assertDatabaseHas('anime_user', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'status' => 'watching',
        ]);
    }

    public function test_user_can_get_anime_status(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $user->animeList()->attach($anime->id, [
            'status' => 'planned',
            'episodes_watched' => 0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/anime/{$anime->id}/user-status")
            ->assertOk()
            ->assertJsonPath('status', 'planned')
            ->assertJsonPath('episodes_watched', 0);
    }

    public function test_not_listed_anime_returns_not_watching_status(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/anime/{$anime->id}/user-status")
            ->assertOk()
            ->assertJsonPath('status', 'not_watching')
            ->assertJsonPath('episodes_watched', 0);
    }

    public function test_user_can_get_list_filtered_by_status(): void
    {
        $user = User::factory()->create();
        $watching = Anime::factory()->create(['title' => 'Watching Anime']);
        $planned = Anime::factory()->create(['title' => 'Planned Anime']);

        $user->animeList()->attach($watching->id, [
            'status' => 'watching',
            'episodes_watched' => 1,
        ]);
        $user->animeList()->attach($planned->id, [
            'status' => 'planned',
            'episodes_watched' => 0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/my-anime-list/watching')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $watching->id)
            ->assertJsonPath('data.0.status', 'watching')
            ->assertJsonPath('data.0.episodes_watched', 1);
    }

    public function test_not_watching_status_removes_anime_from_list(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $user->animeList()->attach($anime->id, [
            'status' => 'watching',
            'episodes_watched' => 3,
        ]);

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/anime/{$anime->id}/status", ['status' => 'not_watching'])
            ->assertOk()
            ->assertJsonPath('message', 'Anime removed from list')
            ->assertJsonPath('status', 'not_watching');

        $this->assertDatabaseMissing('anime_user', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
        ]);
    }

    public function test_user_can_update_episodes_watched(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $user->animeList()->attach($anime->id, [
            'status' => 'watching',
            'episodes_watched' => 0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->patchJson("/api/v1/anime/{$anime->id}/episodes-watched/5")
            ->assertOk()
            ->assertJsonPath('message', 'Episodes watched updated')
            ->assertJsonPath('episodes_watched', 5);

        $this->assertDatabaseHas('anime_user', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'episodes_watched' => 5,
        ]);
    }

    public function test_negative_episodes_watched_returns_validation_error(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $user->animeList()->attach($anime->id, [
            'status' => 'watching',
            'episodes_watched' => 0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->patchJson("/api/v1/anime/{$anime->id}/episodes-watched/-1")
            ->assertUnprocessable()
            ->assertJsonPath('message', 'Validation failed')
            ->assertJsonValidationErrors(['episodes_watched']);

        $this->assertDatabaseHas('anime_user', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'episodes_watched' => 0,
        ]);
    }

    public function test_invalid_status_returns_validation_error(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/anime/{$anime->id}/status", ['status' => 'invalid'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['status']);
    }
}
