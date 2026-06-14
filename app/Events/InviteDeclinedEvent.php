<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InviteDeclinedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly int $toUserId,
        public readonly string $declinedByName,
        public readonly string $animeTitle,
        public readonly string $roomCode,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.'.$this->toUserId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'invite.declined';
    }

    public function broadcastWith(): array
    {
        return [
            'declined_by_name' => $this->declinedByName,
            'anime_title' => $this->animeTitle,
            'room_code' => $this->roomCode,
            'at' => now()->toISOString(),
        ];
    }
}
