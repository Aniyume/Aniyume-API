<?php

namespace App\Enums;

enum ProfileVisibility: string
{
    case Everyone = 'everyone';
    case Friends = 'friends';
    case Nobody = 'nobody';

    /** Секции профиля → колонка в users. */
    public const SECTIONS = [
        'favorites' => 'privacy_favorites',
        'watch_history' => 'privacy_watch_history',
        'ratings' => 'privacy_ratings',
    ];

    public static function values(): array
    {
        return array_map(fn (self $c) => $c->value, self::cases());
    }
}
