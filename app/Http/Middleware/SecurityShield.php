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
        $tunnelDomains = config('security.tunnel_domains', []);
        $isTunnel = false;

        foreach ($tunnelDomains as $domain) {
            if ($host === $domain || str_ends_with($host, '.'.$domain)) {
                $isTunnel = true;
                break;
            }
        }

        if ($isTunnel && $request->is('admin*')) {
            return response()->json(['error' => 'Direct access only'], 403);
        }

        if ($isTunnel && ! in_array($request->method(), ['GET', 'HEAD'])) {
            $allowed = config('security.tunnel_write_allowed_paths', []);
            $isAllowed = false;
            foreach ($allowed as $path) {
                if ($request->is($path)) {
                    $isAllowed = true;
                    break;
                }
            }
            if (! $isAllowed) {
                return response()->json(['error' => 'Write restricted for tunnels'], 403);
            }
        }

        $badAgents = config('security.bad_user_agents', []);
        $userAgent = strtolower((string) $request->userAgent());
        foreach ($badAgents as $agent) {
            if (str_contains($userAgent, $agent)) {
                return response()->json(['error' => 'Bot detected'], 403);
            }
        }

        $skip = ['password', 'password_confirmation', 'current_password', 'old_password'];
        $suspicious = [
            '/UNION\s+SELECT/i', '/<script.*?>.*?<\/script>/is', '/SLEEP\(\d+\)/i',
            '/OR\s+1=1/i', '/DROP\s+TABLE/i', '/--/', '/exec\s*\(/i', '/system\s*\(/i',
        ];
        foreach ($this->flattenInput($request->all()) as $key => $value) {
            $fieldName = basename(str_replace('.', '/', $key));

            if (! is_string($value) || in_array($fieldName, $skip, true)) {
                continue;
            }

            foreach ($suspicious as $pattern) {
                if (preg_match($pattern, $value)) {
                    return response()->json(['error' => 'Malicious activity detected'], 400);
                }
            }
        }

        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        $response->headers->set('Content-Security-Policy', (string) config('security.csp'));

        $hstsEnabled = config('security.hsts_enabled');
        if (($hstsEnabled === null && $request->isSecure()) || $hstsEnabled === true) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }

    /**
     * @return array<string, mixed>
     */
    private function flattenInput(array $input, string $prefix = ''): array
    {
        $result = [];

        foreach ($input as $key => $value) {
            $field = $prefix === '' ? (string) $key : $prefix.'.'.$key;

            if (is_array($value)) {
                $result += $this->flattenInput($value, $field);

                continue;
            }

            $result[$field] = $value;
        }

        return $result;
    }
}
