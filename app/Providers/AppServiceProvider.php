<?php

namespace App\Providers;

use App\Application\Services\Ai\AiGateway;
use App\Application\Services\Ai\AiRateLimitResolver;
use App\Infrastructure\Ai\DeepSeekGateway;
use App\Infrastructure\Ai\StubAiGateway;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AiGateway::class, function ($app): AiGateway {
            $provider = strtolower((string) config('ai.provider', 'stub'));
            $apiKey = trim((string) config('ai.api_key', ''));

            if (in_array($provider, ['deepseek', 'deepseek-chat'], true) && $apiKey !== '') {
                return $app->make(DeepSeekGateway::class);
            }

            if ($provider === 'stub' && $apiKey !== '') {
                return $app->make(DeepSeekGateway::class);
            }

            return $app->make(StubAiGateway::class);
        });
    }

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('ai', function (Request $request) {
            $resolved = app(AiRateLimitResolver::class)->resolve($request->user(), (string) $request->ip());

            return Limit::perMinute($resolved['limit'])->by($resolved['key']);
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });
        Paginator::useBootstrapFive();
    }
}
