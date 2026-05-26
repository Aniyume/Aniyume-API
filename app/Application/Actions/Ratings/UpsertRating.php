<?php

namespace App\Application\Actions\Ratings;

use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class UpsertRating
{
    public function __construct(
        private readonly RecalculateAnimeRating $recalculateAnimeRating,
    ) {
    }

    public function handle(int $userId, int $animeId, float $ratingValue): Rating
    {
        return DB::transaction(function () use ($userId, $animeId, $ratingValue) {
            $rating = Rating::updateOrCreate(
                ['user_id' => $userId, 'anime_id' => $animeId],
                ['rating' => $ratingValue]
            );

            $this->recalculateAnimeRating->handle($animeId);

            return $rating;
        });
    }
}
