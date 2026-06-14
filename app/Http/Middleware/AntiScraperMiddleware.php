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
        $adminFingerprints = config('security.anti_scraper.admin_fingerprints', []);
        if (in_array($fingerprint, $adminFingerprints, true)) {
            return $next($request);
        }

        $trustKey = "trust_score_{$fingerprint}";
        $trustTtl = now()->addDays((int) config('security.anti_scraper.trust_ttl_days', 7));

        // Initialize trust score to 100 if not exists
        if (! \Illuminate\Support\Facades\Cache::has($trustKey)) {
            $trustScore = (int) config('security.anti_scraper.initial_trust_score', 100);
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
        if ($trustScore <= (int) config('security.anti_scraper.block_threshold', 20)) {
            // Apply delay to waste scraper's time
            $delay = min(5, max(0, (int) config('security.anti_scraper.block_delay_seconds', 1)));
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

        if ($requestsCount > (int) config('security.anti_scraper.rate_limit_per_minute', 100)) {
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

        if ((bool) config('security.anti_scraper.expose_trust_score', false)) {
            $response->headers->set('X-Trust-Score', (string) $trustScore);
        }

        return $response;
    }
}
