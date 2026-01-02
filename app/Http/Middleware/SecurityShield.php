<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityShield
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $isTunnel = str_contains($host, 'ngrok-free.app') ||
                    str_contains($host, 'ngrok.io') ||
                    str_contains($host, 'trycloudflare.com');

        if ($isTunnel && $request->is('admin*')) {
            return response()->json(['error' => 'Direct access only'], 403);
        }

        $input = $request->all();
        $exclude = ['password', 'password_confirmation', 'old_password', 'current_password'];

        array_walk_recursive($input, function (&$item, $key) use ($exclude) {
            if (is_string($item) && !in_array($key, $exclude)) {
                $item = strip_tags($item);
                $item = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
            }
        });
        $request->merge($input);

        $suspicious = [
            '/UNION\s+SELECT/i', '/<script.*?>.*?<\/script>/is', '/SLEEP\(\d+\)/i',
            '/OR\s+1=1/i', '/DROP\s+TABLE/i', '/--/', '/exec\s*\(/i', '/system\s*\(/i'
        ];

        foreach ($request->all() as $key => $value) {
            if (is_string($value) && !in_array($key, $exclude)) {
                foreach ($suspicious as $pattern) {
                    if (preg_match($pattern, $value)) {
                        return response()->json(['error' => 'Malicious activity'], 400);
                    }
                }
            }
        }

        $response = $next($request);

        $headers = [
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block',
            'X-Content-Type-Options' => 'nosniff',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Content-Security-Policy' => "default-src 'self'; frame-ancestors 'none';",
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
            'Permissions-Policy' => 'camera=(), microphone=(), geolocation=()'
        ];

        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
