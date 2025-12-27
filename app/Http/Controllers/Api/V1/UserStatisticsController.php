<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\UserStatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserStatisticsController extends Controller
{
    public function __construct(private UserStatisticsService $statisticsService) {}

    public function getStatistics(Request $request, ?int $userId = null): JsonResponse
    {
        $userId = $userId ?? $request->user()->id;
        $statistics = $this->statisticsService->getStatistics($userId);
        return response()->json($statistics);
    }
}
