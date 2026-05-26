<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiTool;
use App\Infrastructure\Ai\Tools\AdminDashboardSummaryTool;
use App\Infrastructure\Ai\Tools\CurrentUserAnimeListTool;
use App\Infrastructure\Ai\Tools\CurrentUserProfileSummaryTool;
use App\Infrastructure\Ai\Tools\SearchAnimeTool;
use App\Models\User;

class AiToolRegistry
{
    /** @var array<string, AiTool> */
    private array $tools;

    public function __construct(private readonly AiToolCapabilityGate $capabilityGate)
    {
        $this->tools = [
            'anime.search' => app(SearchAnimeTool::class),
            'user.anime_list' => app(CurrentUserAnimeListTool::class),
            'user.profile_summary' => app(CurrentUserProfileSummaryTool::class),
            'admin.dashboard_summary' => app(AdminDashboardSummaryTool::class),
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function availableFor(string $role): array
    {
        return collect($this->tools)
            ->filter(function (AiTool $tool, string $name) use ($role): bool {
                try {
                    $this->capabilityGate->assertCanUse($role, $name, $this->tools);

                    return true;
                } catch (\Throwable) {
                    return false;
                }
            })
            ->map(fn (AiTool $tool) => [
                'name' => $tool->name(),
                'description' => $tool->description(),
            ])
            ->values()
            ->all();
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @return array<string, mixed>
     */
    public function invoke(User $user, string $role, string $toolName, array $arguments = []): array
    {
        $this->capabilityGate->assertCanUse($role, $toolName, $this->tools);

        return $this->tools[$toolName]->invoke($user, $arguments);
    }
}
