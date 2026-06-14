<?php

namespace App\Application\Queries\WatchParty;

use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Models\User;
use App\Models\WatchPartyInvite;

class ListInvitesQuery
{
    use FormatsWatchPartyResponses;

    /**
     * Pending-приглашения текущего пользователя для ещё активных комнат.
     * Используется при заходе в приложение (офлайн-доставка).
     */
    public function getFor(User $user): array
    {
        return WatchPartyInvite::with(['fromUser:id,name,avatar', 'room.anime'])
            ->where('to_user_id', $user->id)
            ->where('status', 'pending')
            ->whereHas('room', fn ($q) => $q->where('is_active', true))
            ->latest('id')
            ->get()
            ->map(fn (WatchPartyInvite $invite) => [
                'invite_id' => $invite->id,
                'from_user_id' => $invite->from_user_id,
                'from_user_name' => $invite->fromUser?->name ?? 'Друг',
                'from_user_avatar' => $this->broadcastAvatarUrl($invite->fromUser?->avatar),
                'room_code' => $invite->room?->code ?? '',
                'anime_title' => $invite->room?->anime?->title ?? '',
                'sent_at' => $invite->created_at?->toISOString(),
            ])
            ->values()
            ->all();
    }
}
