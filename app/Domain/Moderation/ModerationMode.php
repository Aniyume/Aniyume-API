<?php

namespace App\Domain\Moderation;

enum ModerationMode: string
{
    case Strict = 'strict';
    case Medium = 'medium';
    case Soft = 'soft';
}
