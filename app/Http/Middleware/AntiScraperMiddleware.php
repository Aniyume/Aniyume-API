<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AntiScraperMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $fingerprint = $request->header('X-Fingerprint-ID') ?: $request->ip();

        // Optional comma-separated admin fingerprints to bypass Anti-Scraper limits.
        $adminFingerprints = $this->csv('ANTI_SCRAPER_ADMIN_FINGERPRINTS');
        if (in_array($fingerprint, $adminFingerprints, true)) {
            return $next($request);
        }

        $trustKey = "trust_score_{$fingerprint}";
        $trustTtl = now()->addDays((int) env('ANTI_SCRAPER_TRUST_TTL_DAYS', 7));

        // Initialize trust score to 100 if not exists
        if (! \Illuminate\Support\Facades\Cache::has($trustKey)) {
            $trustScore = (int) env('ANTI_SCRAPER_INITIAL_TRUST_SCORE', 100);
            \Illuminate\Support\Facades\Cache::put($trustKey, $trustScore, $trustTtl);
        } else {
            $trustScore = (int) \Illuminate\Support\Facades\Cache::get($trustKey);
        }

        // Honeypot check
        if ($request->has('bot_check') && ! empty($request->input('bot_check'))) {
            // Gotcha, bot filled the honeypot
            $trustScore = 0;
            \Illuminate\Support\Facades\Cache::put($trustKey, $trustScore, $trustTtl);
        }

        // Extremely low trust -> Block request
        if ($trustScore <= (int) env('ANTI_SCRAPER_BLOCK_THRESHOLD', 20)) {
            // Apply delay to waste scraper's time
            $delay = min(5, max(0, (int) env('ANTI_SCRAPER_BLOCK_DELAY_SECONDS', 1)));
            if ($delay > 0) {
                sleep($delay);
            }

            return response()->json([
                'message' => 'Too Many Requests or suspicious activity detected.',
                'error' => 'Rate limit exceeded',
            ], 429);
        }

        // Rate limiting check per fingerprint (e.g., 100 reqs / min)
        $rateLimitKey = "rate_limit_{$fingerprint}";

        // Use increment if supported, otherwise manually
        if (\Illuminate\Support\Facades\Cache::has($rateLimitKey)) {
            $requestsCount = \Illuminate\Support\Facades\Cache::increment($rateLimitKey);
        } else {
            $requestsCount = 1;
            \Illuminate\Support\Facades\Cache::put($rateLimitKey, 1, now()->addSeconds(60));
        }

        if ($requestsCount > (int) env('ANTI_SCRAPER_RATE_LIMIT_PER_MINUTE', 100)) {
            // Decrease trust score by 5 for every spam burst
            $trustScore = max(0, $trustScore - 5);
            \Illuminate\Support\Facades\Cache::put($trustKey, $trustScore, $trustTtl);

            return response()->json([
                'message' => 'Too Many Requests.',
            ], 429);
        }

        // Good user behavior adds to trust slowly over time up to 100
        if ($requestsCount == 1 && $trustScore < 100 && mt_rand(1, 10) == 1) {
            $trustScore = min(100, $trustScore + 2);
            \Illuminate\Support\Facades\Cache::put($trustKey, $trustScore, $trustTtl);
        }

        $response = $next($request);

        if ((bool) env('ANTI_SCRAPER_EXPOSE_TRUST_SCORE', false)) {
            $response->headers->set('X-Trust-Score', (string) $trustScore);
        }

        return $response;
    }

    /**
     * @return array<int, string>
     */
    private function csv(string $key, string $default = ''): array
    {
        return array_values(array_filter(array_map('trim', explode(',', (string) env($key, $default)))));
    }
}
