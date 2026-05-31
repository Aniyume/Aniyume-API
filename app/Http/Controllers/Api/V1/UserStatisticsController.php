<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserEpisodesStatisticsResource;
use App\Services\UserStatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Статистика
 */
class UserStatisticsController extends Controller
{
    protected UserStatisticsService $statisticsService;

    public function __construct(UserStatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * Общая статистика пользователя
     *
     * Возвращает количество просмотров, время и динамику.
     *
     * @urlParam userId integer ID пользователя (если не указан - текущий). Example: 2
     */
    public function getStatistics(Request $request, $userId = null): JsonResponse
    {
        $targetUserId = $userId ?? $request->user()?->id;

        if (! $targetUserId) {
            return response()->json(['message' => 'User ID not provided'], 400);
        }

        $stats = $this->statisticsService->getStatistics((int) $targetUserId);

        return response()->json($stats);
    }

    /**
     * Сводка по эпизодам
     *
     * @authenticated
     */
    public function getEpisodesSummary(Request $request): UserEpisodesStatisticsResource
    {
        $summary = $this->statisticsService->getWatchEpisodesSummary($request->user()->id);

        return new UserEpisodesStatisticsResource($summary);
    }
}
