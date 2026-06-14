<?php

namespace App\Application\Actions\WatchParty;

use App\Models\User;
use App\Models\WatchPartyInvite;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AcceptInviteAction
{
    public function execute(User $user, WatchPartyInvite $invite): void
    {
        if ($invite->to_user_id !== $user->id) {
            throw new HttpException(403, 'Это не ваше приглашение');
        }

        if ($invite->status === 'pending') {
            $invite->update(['status' => 'accepted']);
        }
    }
}
