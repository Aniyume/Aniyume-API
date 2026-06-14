<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Глобальное событие реального времени для всех подключённых клиентов.
 * Вещается на публичный канал, поэтому принимается даже неавторизованными
 * посетителями. Используется для общесайтовых уведомлений/эффектов.
 */
class GlobalBroadcastEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly bool $active,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('global'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'global.broadcast';
    }

    public function broadcastWith(): array
    {
        return [
            'active' => $this->active,
            'at' => now()->toISOString(),
        ];
    }
}
