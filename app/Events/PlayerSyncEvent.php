<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerSyncEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly string $roomCode,
        public readonly float $currentTime,
        public readonly bool $isPlaying,
        public readonly int $episodeNumber,
        public readonly int $hostUserId,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('watch-party.'.$this->roomCode),
        ];
    }

    public function broadcastAs(): string
    {
        return 'player.sync';
    }

    public function broadcastWith(): array
    {
        return [
            'current_time' => $this->currentTime,
            'is_playing' => $this->isPlaying,
            'episode_number' => $this->episodeNumber,
            'host_user_id' => $this->hostUserId,
            'timestamp' => now()->toISOString(),
        ];
    }
}
