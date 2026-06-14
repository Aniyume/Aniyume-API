<?php

namespace App\Application\Actions\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Events\InviteDeclinedEvent;
use App\Models\User;
use App\Models\WatchPartyInvite;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeclineInviteAction
{
    use FormatsWatchPartyResponses;

    public function execute(User $user, WatchPartyInvite $invite): void
    {
        if ($invite->to_user_id !== $user->id) {
            throw new HttpException(403, 'Это не ваше приглашение');
        }

        if ($invite->status === 'pending') {
            $invite->update(['status' => 'declined']);
        }

        $invite->loadMissing('room.anime');

        // Уведомляем хоста (отправителя), что приглашение отклонено
        broadcast(new InviteDeclinedEvent(
            toUserId: $invite->from_user_id,
            declinedByName: $user->name,
            animeTitle: $invite->room?->anime?->title ?? '',
            roomCode: $invite->room?->code ?? '',
        ));
    }
}
