<?php

namespace Database\Factories;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Episode>
 */
class EpisodeFactory extends Factory
{
    protected $model = Episode::class;

    public function definition(): array
    {
        return [
            'anime_id' => Anime::factory(),
            'episode_number' => $this->faker->unique()->numberBetween(1, 1000),
            'title' => 'Episode ' . $this->faker->numberBetween(1, 1000),
            'player_url' => $this->faker->url(),
            'external_id' => (string) $this->faker->unique()->numberBetween(100000, 999999),
            'external_source' => 'factory',
            'duration' => $this->faker->numberBetween(1200, 3600),
            'thumbnail_url' => $this->faker->imageUrl(640, 360),
            'source' => 'Factory',
            'priority' => 1,
        ];
    }
}
