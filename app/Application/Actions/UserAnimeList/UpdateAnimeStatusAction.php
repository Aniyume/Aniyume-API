<?php

namespace App\Application\Actions\UserAnimeList;

use App\Models\User;

class UpdateAnimeStatusAction
{
    /**
     * @return array{message: string, status: string}
     */
    public function execute(User $user, int $animeId, string $status): array
    {
        if ($status === 'not_watching') {
            $user->animeList()->detach($animeId);

            return [
                'message' => 'Anime removed from list',
                'status' => 'not_watching',
            ];
        }

        $user->animeList()->syncWithoutDetaching([
            $animeId => [
                'status' => $status,
            ],
        ]);

        return [
            'message' => 'Status updated',
            'status' => $status,
        ];
    }
}
