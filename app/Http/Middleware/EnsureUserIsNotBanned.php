<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsNotBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->is_banned) {
            if ($user->ban_expires_at && $user->ban_expires_at->isPast()) {
                $user->forceFill([
                    'is_banned' => false,
                    'ban_reason' => null,
                    'ban_expires_at' => null,
                ])->save();

                return $next($request);
            }

            $token = $user->currentAccessToken();
            if ($token !== null) {
                $user->tokens()->where('id', $token->id)->delete();
            }

            return response()->json([
                'message' => 'Аккаунт заблокирован.',
                'ban_reason' => $user->ban_reason,
                'ban_expires_at' => $user->ban_expires_at?->toISOString(),
            ], 403);
        }

        return $next($request);
    }
}
