<?php

namespace App\Infrastructure\Ai\Tools;

use App\Application\Services\Ai\AiSafeDataProvider;
use App\Domain\Ai\AiTool;
use App\Models\User;

class CurrentUserAnimeListTool implements AiTool
{
    public function __construct(private readonly AiSafeDataProvider $dataProvider) {}

    public function name(): string
    {
        return 'user.anime_list';
    }

    public function description(): string
    {
        return 'Read a small slice of the current authenticated user anime list.';
    }

    public function invoke(User $user, array $arguments = []): array
    {
        $status = (string) ($arguments['status'] ?? 'all');
        $limit = (int) ($arguments['limit'] ?? 10);

        return $this->dataProvider->currentUserAnimeList($user, $status, $limit);
    }
}
