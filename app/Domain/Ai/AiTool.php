<?php

namespace App\Domain\Ai;

use App\Models\User;

interface AiTool
{
    public function name(): string;

    public function description(): string;

    /**
     * @param  array<string, mixed>  $arguments
     * @return array<string, mixed>
     */
    public function invoke(User $user, array $arguments = []): array;
}
