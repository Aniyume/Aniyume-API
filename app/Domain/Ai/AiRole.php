<?php

namespace App\Domain\Ai;

enum AiRole: string
{
    case Creator = 'creator';
    case Admin = 'admin';
    case Premium = 'premium';
    case Standard = 'standard';

    public static function default(): self
    {
        return self::Standard;
    }
}
