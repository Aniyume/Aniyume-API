<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockTunnelAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
    
        if (str_contains($host, 'ngrok-free.app') || 
            str_contains($host, 'ngrok.io') ||
            str_contains($host, 'trycloudflare.com')) {
            return response()->json([
                'error' => 'Admin panel only accessible via localhost',
                'message' => 'Use http://localhost:8000/admin for admin access'
            ], 403);
        }

        return $next($request);
    }
}
