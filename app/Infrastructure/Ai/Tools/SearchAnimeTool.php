<?php

namespace App\Infrastructure\Ai\Tools;

use App\Application\Services\Ai\AiSafeDataProvider;
use App\Domain\Ai\AiTool;
use App\Models\User;

class SearchAnimeTool implements AiTool
{
    public function __construct(private readonly AiSafeDataProvider $dataProvider) {}

    public function name(): string
    {
        return 'anime.search';
    }

    public function description(): string
    {
        return 'Search public anime catalog by title or slug.';
    }

    public function invoke(User $user, array $arguments = []): array
    {
        $query = trim((string) ($arguments['query'] ?? ''));
        $limit = (int) ($arguments['limit'] ?? 5);

        return $this->dataProvider->searchAnime($query, $limit);
    }
}
