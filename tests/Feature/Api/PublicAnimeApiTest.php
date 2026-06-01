<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\Episode;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicAnimeApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_anime_list_returns_paginated_data(): void
    {
        Anime::factory()->count(3)->has(Episode::factory())->create();

        $this->getJson('/api/v1/public/anime')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title'],
                ],
                'links',
                'meta',
            ]);
    }

    public function test_anime_list_respects_per_page_limit(): void
    {
        Anime::factory()->count(3)->has(Episode::factory())->create();

        $this->getJson('/api/v1/public/anime?per_page=1')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('meta.per_page', 1);
    }

    public function test_anime_details_returns_resource(): void
    {
        $anime = Anime::factory()->create();

        $this->getJson("/api/v1/public/anime/{$anime->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $anime->id)
            ->assertJsonPath('data.title', $anime->title);
    }

    public function test_tags_endpoint_returns_tags(): void
    {
        Tag::factory()->count(2)->create();

        $this->getJson('/api/v1/public/tags')
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(2, 'data');
    }

    public function test_anime_episodes_endpoint_returns_episodes(): void
    {
        $anime = Anime::factory()->create();
        Episode::factory()->count(2)->create([
            'anime_id' => $anime->id,
            'source' => 'Factory',
        ]);

        $this->getJson("/api/v1/public/anime/{$anime->id}/episodes")
            ->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_unknown_anime_returns_json_404(): void
    {
        $this->getJson('/api/v1/public/anime/999999')
            ->assertNotFound()
            ->assertJson([
                'message' => 'Resource not found',
            ]);
    }
}
