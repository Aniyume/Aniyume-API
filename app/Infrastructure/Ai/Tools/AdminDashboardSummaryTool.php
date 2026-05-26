<?php

namespace App\Infrastructure\Ai\Tools;

use App\Application\Services\Ai\AiSafeDataProvider;
use App\Domain\Ai\AiTool;
use App\Models\User;

class AdminDashboardSummaryTool implements AiTool
{
    public function __construct(private readonly AiSafeDataProvider $dataProvider)
    {
    }

    public function name(): string
    {
        return 'admin.dashboard_summary';
    }

    public function description(): string
    {
        return 'Read compact platform metrics for admin or creator roles.';
    }

    public function invoke(User $user, array $arguments = []): array
    {
        return $this->dataProvider->adminDashboardSummary();
    }
}
