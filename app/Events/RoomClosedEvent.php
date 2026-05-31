<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoomClosedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly string $roomCode,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('watch-party.'.$this->roomCode),
        ];
    }

    public function broadcastAs(): string
    {
        return 'room.closed';
    }

    public function broadcastWith(): array
    {
        return [
            'room_code' => $this->roomCode,
            'closed_at' => now()->toISOString(),
        ];
    }
}
