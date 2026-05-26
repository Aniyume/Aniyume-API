<?php

namespace App\Application\Services;

use App\Models\Anime;
use Illuminate\Support\Facades\Schema;

class AnimeCommentsCount
{
    public function increment(int $animeId): void
    {
        if (! $this->hasCommentsCountColumn()) {
            return;
        }

        Anime::whereKey($animeId)->increment('comments_count');
    }

    public function decrement(int $animeId): void
    {
        if (! $this->hasCommentsCountColumn()) {
            return;
        }

        Anime::whereKey($animeId)->decrement('comments_count');
    }

    private function hasCommentsCountColumn(): bool
    {
        return Schema::hasColumn('anime', 'comments_count');
    }
}
