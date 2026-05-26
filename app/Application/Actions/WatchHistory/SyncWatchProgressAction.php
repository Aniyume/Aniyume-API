<?php

namespace App\Application\Actions\WatchHistory;

use App\Models\Episode;
use App\Models\WatchHistory;

class SyncWatchProgressAction
{
    public function execute(int $userId, array $data): WatchHistory
    {
        $episode = Episode::findOrFail($data['episode_id']);

        $watchHistory = WatchHistory::updateOrCreate(
            ['user_id' => $userId, 'episode_id' => $episode->id],
            [
                'anime_id' => $episode->anime_id,
                'completed' => $data['completed'] ?? false,
                'watched_at' => now(),
            ]
        );

        $watchHistory->increment('watch_time', $data['delta_time'], [
            'progress' => $data['progress'],
        ]);

        return $watchHistory->refresh();
    }
}
