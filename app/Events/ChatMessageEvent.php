<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly string $roomCode,
        public readonly int    $userId,
        public readonly string $userName,
        public readonly string $userAvatar,
        public readonly string $message,
        public readonly int    $messageId,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('watch-party.' . $this->roomCode),
        ];
    }

    public function broadcastAs(): string
    {
        return 'chat.message';
    }

    public function broadcastWith(): array
    {
        return [
            'id'         => $this->messageId,
            'user_id'    => $this->userId,
            'user_name'  => $this->userName,
            'user_avatar' => $this->userAvatar,
            'message'    => $this->message,
            'type'       => 'message',
            'created_at' => now()->toISOString(),
        ];
    }
}
