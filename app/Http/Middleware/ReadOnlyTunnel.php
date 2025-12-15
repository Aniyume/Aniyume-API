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
            if (!in_array($request->method(), ['GET', 'HEAD'])) {
                return response()->json([
                    'error' => 'Only read operations are allowed through tunnel',
                    'message' => 'POST, PUT, PATCH, DELETE methods are disabled for security'
                ], 403);
            }
            
            if ($request->is('admin/*') || $request->is('admin')) {
                return response()->json([
                    'error' => 'Admin panel only accessible via localhost',
                    'message' => 'Please use http://localhost:8000/admin'
                ], 403);
            }

            if ($request->is('api/*/register') || 
                $request->is('api/*/login') || 
                $request->is('api/*/logout')) {
                return response()->json([
                    'error' => 'Authentication not allowed through tunnel'
                ], 403);
            }
        }

        return $next($request);
    }
}
