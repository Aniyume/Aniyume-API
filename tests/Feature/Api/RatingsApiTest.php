<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_ratings_endpoints_require_authentication(): void
    {
        $anime = Anime::factory()->create();
        $rating = Rating::create([
            'user_id' => User::factory()->create()->id,
            'anime_id' => $anime->id,
            'rating' => 4.0,
        ]);

        $this->getJson('/api/v1/ratings')->assertUnauthorized();
        $this->postJson('/api/v1/ratings', ['anime_id' => $anime->id, 'rating' => 4])->assertUnauthorized();
        $this->getJson("/api/v1/ratings/anime/{$anime->id}")->assertUnauthorized();
        $this->deleteJson("/api/v1/ratings/{$rating->id}")->assertUnauthorized();
    }

    public function test_user_can_create_rating(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ratings', [
                'anime_id' => $anime->id,
                'rating' => 4.5,
            ])
            ->assertCreated()
            ->assertJsonPath('message', 'Rating added')
            ->assertJsonPath('data.anime_id', $anime->id);

        $this->assertDatabaseHas('ratings', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'rating' => 4.5,
        ]);
    }

    public function test_repeated_rating_updates_existing_record(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        Rating::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'rating' => 3.0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ratings', [
                'anime_id' => $anime->id,
                'rating' => 5.0,
            ])
            ->assertCreated()
            ->assertJsonPath('data.rating', '5.0');

        $this->assertSame(1, Rating::where('user_id', $user->id)->where('anime_id', $anime->id)->count());
        $this->assertDatabaseHas('ratings', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'rating' => 5.0,
        ]);
    }

    public function test_rating_create_and_update_recalculate_anime_rating(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $anime = Anime::factory()->create(['rating' => null]);

        Rating::create([
            'user_id' => $anotherUser->id,
            'anime_id' => $anime->id,
            'rating' => 3.0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ratings', [
                'anime_id' => $anime->id,
                'rating' => 5.0,
            ])
            ->assertCreated();

        $this->assertSame('4.00', $anime->fresh()->rating);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ratings', [
                'anime_id' => $anime->id,
                'rating' => 4.0,
            ])
            ->assertCreated();

        $this->assertSame('3.50', $anime->fresh()->rating);
    }

    public function test_user_can_get_rating_for_anime(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        Rating::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'rating' => 4.0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/ratings/anime/{$anime->id}")
            ->assertOk()
            ->assertJsonPath('rating', '4.0');
    }

    public function test_user_can_get_ratings_list(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create(['title' => 'Rated Anime']);

        Rating::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'rating' => 4.0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/ratings')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.anime.title', 'Rated Anime');
    }

    public function test_user_can_delete_own_rating(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        Rating::create([
            'user_id' => User::factory()->create()->id,
            'anime_id' => $anime->id,
            'rating' => 2.0,
        ]);
        $rating = Rating::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'rating' => 4.0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/ratings/{$rating->id}")
            ->assertOk()
            ->assertJsonPath('message', 'Rating deleted');

        $this->assertDatabaseMissing('ratings', [
            'id' => $rating->id,
        ]);
        $this->assertSame('2.00', $anime->fresh()->rating);
    }

    public function test_user_cannot_delete_another_users_rating(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $anime = Anime::factory()->create();
        $rating = Rating::create([
            'user_id' => $anotherUser->id,
            'anime_id' => $anime->id,
            'rating' => 4.0,
        ]);

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/ratings/{$rating->id}")
            ->assertForbidden()
            ->assertJsonPath('message', 'Unauthorized');
    }

    public function test_invalid_rating_payload_returns_validation_error(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/ratings', [
                'anime_id' => 999999,
                'rating' => 6,
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['anime_id', 'rating']);
    }
}
