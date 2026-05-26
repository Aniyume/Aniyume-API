<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoritesApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_favorites_endpoints_require_authentication(): void
    {
        $anime = Anime::factory()->create();

        $this->getJson('/api/v1/favorites')->assertUnauthorized();
        $this->postJson('/api/v1/favorites', ['anime_id' => $anime->id])->assertUnauthorized();
        $this->getJson("/api/v1/favorites/{$anime->id}/check")->assertUnauthorized();
        $this->deleteJson("/api/v1/favorites/{$anime->id}")->assertUnauthorized();
    }

    public function test_user_can_add_anime_to_favorites(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/favorites', ['anime_id' => $anime->id])
            ->assertCreated()
            ->assertJsonPath('message', 'Added to favorites')
            ->assertJsonPath('anime_id', $anime->id);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
        ]);
    }

    public function test_duplicate_favorite_returns_conflict(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        Favorite::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
        ]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/favorites', ['anime_id' => $anime->id])
            ->assertConflict()
            ->assertJsonPath('message', 'Already in favorites');

        $this->assertSame(1, Favorite::where('user_id', $user->id)->where('anime_id', $anime->id)->count());
    }

    public function test_user_can_get_favorites_list(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create(['title' => 'Favorite Anime']);

        Favorite::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/favorites')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.anime_id', $anime->id)
            ->assertJsonPath('data.0.title', 'Favorite Anime');
    }

    public function test_user_can_check_favorite_status(): void
    {
        $user = User::factory()->create();
        $favoriteAnime = Anime::factory()->create();
        $otherAnime = Anime::factory()->create();

        Favorite::create([
            'user_id' => $user->id,
            'anime_id' => $favoriteAnime->id,
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/favorites/{$favoriteAnime->id}/check")
            ->assertOk()
            ->assertJsonPath('is_favorite', true);

        $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/favorites/{$otherAnime->id}/check")
            ->assertOk()
            ->assertJsonPath('is_favorite', false);
    }

    public function test_user_can_remove_anime_from_favorites(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        Favorite::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
        ]);

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/favorites/{$anime->id}")
            ->assertOk()
            ->assertJsonPath('message', 'Removed from favorites');

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
        ]);
    }

    public function test_invalid_anime_id_returns_validation_error(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/favorites', ['anime_id' => 999999])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['anime_id']);
    }
}
