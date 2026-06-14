<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\MonitoringService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MonitoringController extends Controller
{
    public function health(Request $request, MonitoringService $monitoring): JsonResponse
    {
        $validated = $request->validate([
            'target' => ['required', 'string', Rule::in($monitoring->targets())],
        ]);

        return response()->json([
            'data' => $monitoring->check($validated['target']),
        ]);
    }
}
