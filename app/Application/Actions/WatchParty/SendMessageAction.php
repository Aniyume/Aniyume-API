<?php

namespace App\Application\Actions\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Events\ChatMessageEvent;
use App\Models\User;
use App\Models\WatchPartyMessage;
use App\Models\WatchPartyParticipant;
use App\Models\WatchPartyRoom;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SendMessageAction
{
    use FormatsWatchPartyResponses;

    public function execute(User $user, string $code, string $message): array
    {
        $room = WatchPartyRoom::where('code', $code)
            ->where('is_active', true)
            ->firstOrFail();

        $isParticipant = WatchPartyParticipant::where('room_id', $room->id)
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->exists();

        if (! $isParticipant) {
            throw new HttpException(403, 'Вы не являетесь участником комнаты');
        }

        $watchPartyMessage = WatchPartyMessage::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'message' => $message,
            'type' => 'message',
        ]);

        $avatarUrl = $this->nullableAvatarUrl($user->avatar);

        broadcast(new ChatMessageEvent(
            roomCode: $code,
            userId: $user->id,
            userName: $user->name,
            userAvatar: $avatarUrl ?? '',
            message: $message,
            messageId: $watchPartyMessage->id,
        ))->toOthers();

        return [
            'id' => $watchPartyMessage->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_avatar' => $avatarUrl,
            'message' => $watchPartyMessage->message,
            'created_at' => $watchPartyMessage->created_at->toISOString(),
        ];
    }
}
