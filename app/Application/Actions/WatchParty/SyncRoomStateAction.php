<?php

namespace App\Application\Actions\WatchParty;

use App\Events\PlayerSyncEvent;
use App\Models\User;
use App\Models\WatchPartyRoom;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SyncRoomStateAction
{
    public function execute(User $user, string $code, array $data): void
    {
        $room = WatchPartyRoom::where('code', $code)
            ->where('is_active', true)
            ->firstOrFail();

        if ($room->host_user_id !== $user->id) {
            throw new HttpException(403, 'Только хост может управлять плеером');
        }

        $room->update([
            'current_time'   => $data['current_time'],
            'is_playing'     => $data['is_playing'],
            'episode_number' => $data['episode_number'],
        ]);

        broadcast(new PlayerSyncEvent(
            roomCode: $code,
            currentTime: (float) $data['current_time'],
            isPlaying: (bool) $data['is_playing'],
            episodeNumber: (int) $data['episode_number'],
            hostUserId: $user->id,
        ))->toOthers();
    }
}
