<?php

namespace App\Http\Controllers\Api\Admin;

use App\Events\GlobalBroadcastEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Управление глобальной real-time рассылкой событий всем клиентам.
 */
class BroadcastController extends Controller
{
    /**
     * Почта основного администратора, которому разрешено триггерить
     * общесайтовую рассылку.
     */
    private const OWNER_EMAIL = 'zanshugurov07@gmail.com';

    public function toggle(Request $request): JsonResponse
    {
        $admin = (array) $request->attributes->get('clerk_admin', []);
        $email = strtolower((string) ($admin['email'] ?? ''));

        if ($email !== self::OWNER_EMAIL) {
            return response()->json([
                'message' => 'Недостаточно прав для глобальной рассылки.',
            ], 403);
        }

        $validated = $request->validate([
            'active' => ['required', 'boolean'],
        ]);

        broadcast(new GlobalBroadcastEvent((bool) $validated['active']));

        return response()->json([
            'data' => [
                'active' => (bool) $validated['active'],
            ],
        ]);
    }
}
