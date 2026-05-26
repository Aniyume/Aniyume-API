<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FriendInviteEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly int    $toUserId,
        public readonly int    $fromUserId,
        public readonly string $fromUserName,
        public readonly string $fromUserAvatar,
        public readonly string $roomCode,
        public readonly string $animeTitle,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->toUserId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'friend.invite';
    }

    public function broadcastWith(): array
    {
        return [
            'from_user_id'     => $this->fromUserId,
            'from_user_name'   => $this->fromUserName,
            'from_user_avatar' => $this->fromUserAvatar,
            'room_code'        => $this->roomCode,
            'anime_title'      => $this->animeTitle,
            'sent_at'          => now()->toISOString(),
        ];
    }
}
