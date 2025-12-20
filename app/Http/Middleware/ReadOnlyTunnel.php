<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadOnlyTunnel
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $isTunnel = str_contains($host, 'trycloudflare.com') ||
                    str_contains($host, 'ngrok-free.app') ||
                    str_contains($host, 'ngrok.io');

        if ($isTunnel) {
            if (in_array($request->method(), ['GET', 'HEAD'])) {
                return $next($request);
            }

            if ($request->is('api/*/auth/*') || $request->is('api/*/profile/*') || $request->is('api/*/watch-history*') || $request->is('api/*/favorites*')) {
                return $next($request);
            }

            return response()->json([
                'error' => 'Security restriction',
                'message' => 'Write operations are restricted for this tunnel',
            ], 403);
        }

        return $next($request);
    }
}
