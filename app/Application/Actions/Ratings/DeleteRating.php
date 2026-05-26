<?php

namespace App\Application\Actions\Ratings;

use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class DeleteRating
{
    public function __construct(
        private readonly RecalculateAnimeRating $recalculateAnimeRating,
    ) {
    }

    public function handle(Rating $rating): void
    {
        DB::transaction(function () use ($rating) {
            $animeId = $rating->anime_id;

            $rating->delete();

            $this->recalculateAnimeRating->handle($animeId);
        });
    }
}
