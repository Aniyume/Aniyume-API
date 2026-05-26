<?php

use App\Models\WatchPartyRoom;
use App\Models\WatchPartyParticipant;
use Illuminate\Support\Facades\Broadcast;

// Системный канал уведомлений Sanctum
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Приватный канал пользователя (для приглашений в комнату)
Broadcast::channel('user.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

// Presence канал комнаты совместного просмотра
// Возвращает данные пользователя (видны всем участникам) или false (нет доступа)
Broadcast::channel('watch-party.{code}', function ($user, $code) {
    $room = WatchPartyRoom::where('code', $code)
        ->where('is_active', true)
        ->first();

    if (!$room) {
        return false;
    }

    $isParticipant = WatchPartyParticipant::where('room_id', $room->id)
        ->where('user_id', $user->id)
        ->where('is_active', true)
        ->exists();

    if (!$isParticipant) {
        return false;
    }

    return [
        'id'       => $user->id,
        'name'     => $user->name,
        'avatar'   => $user->avatar ? '/api-storage/avatars/' . $user->avatar : null,
        'is_host'  => $room->host_user_id === $user->id,
    ];
});
