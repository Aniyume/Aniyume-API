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
                    $host === 'trycloudflare.com';

        if ($isTunnel && $request->is('admin*')) {
            return response()->json(['error' => 'Direct access only'], 403);
        }

        if ($isTunnel && !in_array($request->method(), ['GET', 'HEAD'])) {
            $allowed = ['api/v1/auth/*', 'api/v1/profile/*', 'api/v1/watch-history*', 'api/v1/favorites*'];
            $isAllowed = false;
            foreach ($allowed as $path) {
                if ($request->is($path)) {
                    $isAllowed = true;
                    break;
                }
            }
            if (!$isAllowed) {
                return response()->json(['error' => 'Write restricted for tunnels'], 403);
            }
        }

        $badAgents = ['binlar', 'casper', 'checkprivilege', 'clshttp', 'cmsworldmap', 'diavol', 'dotbot', 'extract', 'feedfinder', 'flicky', 'g00g1e', 'harvest', 'heritrix', 'httrack', 'kmccrew', 'loader', 'miner', 'nikto', 'nutch', 'planetwork', 'purebot', 'pycurl', 'skygrid', 'sqlmap', 'sucker', 'turnit', 'vikspider', 'zmeu'];
        $userAgent = strtolower($request->userAgent());
        foreach ($badAgents as $agent) {
            if (str_contains($userAgent, $agent)) {
                return response()->json(['error' => 'Bot detected'], 403);
            }
        }

        $input = $request->all();
        $skip = ['password', 'password_confirmation', 'current_password', 'old_password'];
        array_walk_recursive($input, function (&$item, $key) use ($skip) {
            if (is_string($item) && !in_array($key, $skip)) {
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
            if (is_string($value) && !in_array($key, $skip)) {
                foreach ($suspicious as $pattern) {
                    if (preg_match($pattern, $value)) {
                        return response()->json(['error' => 'Malicious activity detected'], 400);
                    }
                }
            }
        }

        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Content-Security-Policy', "default-src 'self'; frame-ancestors 'none';");
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        return $response;
    }
}
