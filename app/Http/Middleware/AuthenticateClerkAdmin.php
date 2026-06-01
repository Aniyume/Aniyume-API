<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateClerkAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        $sanctumUser = Auth::guard('sanctum')->user();
        if ($sanctumUser?->hasRole('admin')) {
            $request->setUserResolver(fn () => $sanctumUser);

            return $next($request);
        }

        if ($sanctumUser) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        if (! $token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        try {
            $claims = (array) JWT::decode($token, JWK::parseKeySet($this->jwks()));
        } catch (\Throwable) {
            return response()->json(['message' => 'Invalid Clerk token'], 401);
        }

        if (! $this->issuerIsAllowed($claims) || ! $this->authorizedPartyIsAllowed($claims)) {
            return response()->json(['message' => 'Invalid Clerk token claims'], 401);
        }

        if (! $this->isAllowedAdmin($claims)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $request->attributes->set('clerk_claims', $claims);
        $request->attributes->set('clerk_admin', $this->adminPayload($claims));

        return $next($request);
    }

    private function jwks(): array
    {
        $jwksUrl = config('clerk.jwks_url');

        if (! $jwksUrl) {
            abort(response()->json(['message' => 'CLERK_JWKS_URL is not configured'], 500));
        }

        return Cache::remember('clerk:jwks', now()->addHour(), function () use ($jwksUrl) {
            $response = Http::timeout(10)->get($jwksUrl);

            if ($response->failed()) {
                throw new \RuntimeException('Unable to fetch Clerk JWKS');
            }

            return $response->json();
        });
    }

    private function issuerIsAllowed(array $claims): bool
    {
        $issuer = config('clerk.issuer');

        return ! $issuer || (($claims['iss'] ?? null) === $issuer);
    }

    private function authorizedPartyIsAllowed(array $claims): bool
    {
        $allowed = config('clerk.authorized_parties', []);

        return empty($allowed) || in_array($claims['azp'] ?? null, $allowed, true);
    }

    private function isAllowedAdmin(array $claims): bool
    {
        $email = strtolower((string) ($claims['email'] ?? $claims['primary_email_address'] ?? ''));
        $allowedEmails = config('clerk.admin_emails', []);

        if ($email && in_array($email, $allowedEmails, true)) {
            return true;
        }

        $metadata = (array) ($claims['public_metadata'] ?? []);
        $role = Arr::get($metadata, 'role') ?: ($claims['role'] ?? null);
        $roles = array_map('strtolower', (array) ($claims['roles'] ?? Arr::get($metadata, 'roles', [])));

        return $role === 'admin' || in_array('admin', $roles, true) || (bool) Arr::get($metadata, 'is_admin', false);
    }

    private function adminPayload(array $claims): array
    {
        return [
            'id' => $claims['sub'] ?? null,
            'email' => $claims['email'] ?? $claims['primary_email_address'] ?? null,
            'name' => $claims['name'] ?? $claims['full_name'] ?? null,
            'roles' => ['admin'],
            'permissions' => ['admin.access'],
            'is_admin' => true,
        ];
    }
}
