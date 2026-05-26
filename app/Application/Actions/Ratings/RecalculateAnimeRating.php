<?php

namespace App\Application\Actions\Ratings;

use App\Models\Anime;
use App\Models\Rating;

class RecalculateAnimeRating
{
    public function handle(int $animeId): void
    {
        $totalRatings = Rating::where('anime_id', $animeId)->count();
        $sumRatings = Rating::where('anime_id', $animeId)->sum('rating');

        Anime::whereKey($animeId)->update([
            'rating' => $totalRatings > 0 ? round($sumRatings / $totalRatings, 2) : null,
        ]);
    }
}
