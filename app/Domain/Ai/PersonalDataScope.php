<?php

namespace App\Domain\Ai;

enum PersonalDataScope: string
{
    case Self = 'self';
    case SelfAndOperationalMetadata = 'self_and_operational_metadata';
}
