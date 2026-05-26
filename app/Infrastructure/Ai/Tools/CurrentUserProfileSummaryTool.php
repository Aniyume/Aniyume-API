<?php

namespace App\Infrastructure\Ai\Tools;

use App\Application\Services\Ai\AiSafeDataProvider;
use App\Domain\Ai\AiTool;
use App\Models\User;

class CurrentUserProfileSummaryTool implements AiTool
{
    public function __construct(private readonly AiSafeDataProvider $dataProvider)
    {
    }

    public function name(): string
    {
        return 'user.profile_summary';
    }

    public function description(): string
    {
        return 'Read a minimal profile summary for the current authenticated user.';
    }

    public function invoke(User $user, array $arguments = []): array
    {
        return $this->dataProvider->currentUserProfileSummary($user);
    }
}
