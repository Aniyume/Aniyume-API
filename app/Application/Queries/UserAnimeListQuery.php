<?php

namespace App\Application\Queries;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserAnimeListQuery
{
    private const FILTERABLE_STATUSES = ['watching', 'planned', 'completed', 'on_hold', 'dropped'];

    public function paginated(User $user, ?string $status, int $perPage): LengthAwarePaginator
    {
        $perPage = max(1, min($perPage, 100));

        $query = $user->animeList()
            ->select(['anime.id', 'anime.title', 'anime.poster_url']);

        if ($status && $status !== 'all' && in_array($status, self::FILTERABLE_STATUSES, true)) {
            $query->wherePivot('status', $status);
        }

        return $query->paginate($perPage);
    }

    public function statusForAnime(User $user, int $animeId): array
    {
        $userAnime = $user->animeList()
            ->where('anime_id', $animeId)
            ->first();

        if (! $userAnime) {
            return [
                'status' => 'not_watching',
                'episodes_watched' => 0,
            ];
        }

        return [
            'status' => $userAnime->pivot->status,
            'episodes_watched' => $userAnime->pivot->episodes_watched,
        ];
    }
}
