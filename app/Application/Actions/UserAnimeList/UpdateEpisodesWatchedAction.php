<?php

namespace App\Application\Actions\UserAnimeList;

use App\Models\User;

class UpdateEpisodesWatchedAction
{
    public function execute(User $user, int $animeId, int $episodesWatched): bool
    {
        $userAnime = $user->animeList()
            ->where('anime_id', $animeId)
            ->first();

        if (! $userAnime) {
            return false;
        }

        $user->animeList()->updateExistingPivot($animeId, [
            'episodes_watched' => $episodesWatched,
        ]);

        return true;
    }
}
