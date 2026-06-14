<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class MonitoringService
{
    /**
     * @return array{configured: bool, ok: bool, status: int|null, message?: string}
     */
    public function check(string $target): array
    {
        $service = config("services.monitoring.{$target}");
        $baseUrl = is_array($service) ? ($service['url'] ?? null) : null;

        if (! is_string($baseUrl) || $baseUrl === '') {
            return [
                'configured' => false,
                'ok' => false,
                'status' => null,
            ];
        }

        $healthPath = is_string($service['health_path'] ?? null) ? $service['health_path'] : '/';
        $url = rtrim($baseUrl, '/').'/'.ltrim($healthPath, '/');

        try {
            $response = Http::acceptJson()
                ->connectTimeout(3)
                ->timeout(5)
                ->withoutRedirecting()
                ->get($url);

            return [
                'configured' => true,
                'ok' => $response->successful() || $response->redirect(),
                'status' => $response->status(),
            ];
        } catch (ConnectionException) {
            return [
                'configured' => true,
                'ok' => false,
                'status' => null,
                'message' => 'Health check failed',
            ];
        }
    }

    /**
     * @return list<string>
     */
    public function targets(): array
    {
        return array_keys(config('services.monitoring', []));
    }
}
