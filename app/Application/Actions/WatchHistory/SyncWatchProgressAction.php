<?php

namespace App\Application\Actions\WatchHistory;

use App\Models\Episode;
use App\Models\WatchHistory;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class SyncWatchProgressAction
{
    public function execute(int $userId, array $data): WatchHistory
    {
        $episode = Episode::findOrFail($data['episode_id']);

        $watchHistory = WatchHistory::firstOrNew([
            'user_id' => $userId,
            'episode_id' => $episode->id,
        ]);

        $watchHistory->fill([
            'anime_id' => $episode->anime_id,
            'completed' => (bool) $watchHistory->completed || (bool) ($data['completed'] ?? false),
            'watched_at' => now(),
        ])->save();

        $progress = (int) $data['progress'];
        if ($progress === 0 && (int) $watchHistory->progress > 0) {
            $progress = (int) $watchHistory->progress;
        }

        $watchHistory->increment('watch_time', $data['delta_time'], [
            'progress' => $progress,
        ]);

        if (($data['completed'] ?? false) === true) {
            $this->markEpisodeWatched($userId, $episode);
        }

        Cache::forget("user_statistics_{$userId}");
        Cache::forget("user_episodes_summary_{$userId}_10");

        return $watchHistory->refresh();
    }

    private function markEpisodeWatched(int $userId, Episode $episode): void
    {
        /** @var User|null $user */
        $user = User::query()->find($userId);

        if (! $user) {
            return;
        }

        $current = $user->animeList()
            ->where('anime_id', $episode->anime_id)
            ->first();

        if (! $current) {
            $status = $this->completedStatus($episode, (int) $episode->episode_number) ? 'completed' : 'watching';

            $user->animeList()->syncWithoutDetaching([
                $episode->anime_id => [
                    'status' => $status,
                    'episodes_watched' => $episode->episode_number,
                    'last_watched_at' => now(),
                ],
            ]);

            return;
        }

        $episodesWatched = max((int) ($current->pivot->episodes_watched ?? 0), (int) $episode->episode_number);

        $updates = [
            'episodes_watched' => $episodesWatched,
            'last_watched_at' => now(),
        ];

        if ($this->completedStatus($episode, $episodesWatched)) {
            $updates['status'] = 'completed';
        }

        $user->animeList()->updateExistingPivot($episode->anime_id, $updates);
    }

    private function completedStatus(Episode $episode, int $episodesWatched): bool
    {
        $totalEpisodes = (int) $episode->anime()->value('number_of_episodes');

        return $totalEpisodes > 0 && $episodesWatched >= $totalEpisodes;
    }
}
