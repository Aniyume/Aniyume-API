<?php

namespace Database\Factories;

use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Anime>
 */
class AnimeFactory extends Factory
{
    protected $model = Anime::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.$this->faker->unique()->numberBetween(1000, 9999),
            'description' => $this->faker->paragraph(),
            'poster_url' => $this->faker->imageUrl(300, 420),
            'rating' => $this->faker->randomFloat(1, 1, 10),
            'year' => $this->faker->numberBetween(1990, 2026),
            'status' => $this->faker->randomElement(['planned', 'ongoing', 'finished', 'paused']),
            'type' => $this->faker->randomElement(['tv', 'movie', 'ova', 'ona', 'special']),
            'number_of_episodes' => $this->faker->numberBetween(1, 24),
            'external_id' => (string) $this->faker->unique()->numberBetween(100000, 999999),
            'external_source' => 'factory',
            'popularity' => $this->faker->numberBetween(0, 100000),
            'favorites' => $this->faker->numberBetween(0, 10000),
            'score_count' => $this->faker->numberBetween(0, 5000),
            'nsfw_flag' => false,
        ];
    }
}
