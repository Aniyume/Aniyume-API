<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class StreamProxyController extends Controller
{
    public function allanime(Request $request, string $encoded): Response
    {
        if ($request->isMethod('OPTIONS')) {
            return response('', 204, $this->corsHeaders());
        }

        $url = $this->decodeUrl($encoded);
        if (! $url || ! $this->isAllowedRemoteUrl($url)) {
            abort(400, 'Invalid stream URL');
        }

        $upstream = Http::timeout(45)
            ->retry(1, 300)
            ->withHeaders([
                'Accept' => '*/*',
                'User-Agent' => (string) config('services.allanime.user_agent'),
                'Referer' => (string) config('services.allanime.referer'),
                'Origin' => (string) config('services.allanime.referer'),
            ])
            ->withOptions(['verify' => false])
            ->get($url);

        if (! $upstream->successful()) {
            abort($upstream->status(), 'Stream upstream failed');
        }

        $body = $upstream->body();
        $contentType = $upstream->header('Content-Type') ?: $this->guessContentType($url);

        if ($this->isManifest($url, $contentType, $body)) {
            $body = $this->rewriteManifest($body, $url);
            $contentType = 'application/vnd.apple.mpegurl';
        }

        return response($body, 200, array_merge($this->corsHeaders(), [
            'Content-Type' => $contentType,
            'Cache-Control' => $this->isManifest($url, $contentType, $body)
                ? 'no-store, no-cache, must-revalidate'
                : 'public, max-age=86400',
        ]));
    }

    public static function encodeUrl(string $url): string
    {
        return rtrim(strtr(base64_encode($url), '+/', '-_'), '=');
    }

    private function decodeUrl(string $encoded): ?string
    {
        $padding = strlen($encoded) % 4;
        if ($padding > 0) {
            $encoded .= str_repeat('=', 4 - $padding);
        }

        $decoded = base64_decode(strtr($encoded, '-_', '+/'), true);

        return is_string($decoded) ? $decoded : null;
    }

    private function isAllowedRemoteUrl(string $url): bool
    {
        $parts = parse_url($url);
        if (! in_array($parts['scheme'] ?? '', ['http', 'https'], true) || empty($parts['host'])) {
            return false;
        }

        $host = (string) $parts['host'];
        if (in_array(strtolower($host), ['localhost', '127.0.0.1', '::1'], true)) {
            return false;
        }

        $ip = gethostbyname($host);
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }

        return true;
    }

    private function isManifest(string $url, string $contentType, string $body): bool
    {
        return str_contains(strtolower($contentType), 'mpegurl')
            || str_contains(strtolower($contentType), 'm3u8')
            || str_contains(parse_url($url, PHP_URL_PATH) ?: '', '.m3u8')
            || str_starts_with(ltrim($body), '#EXTM3U');
    }

    private function rewriteManifest(string $manifest, string $manifestUrl): string
    {
        $lines = preg_split('/\r\n|\r|\n/', $manifest) ?: [];

        return implode("\n", array_map(function (string $line) use ($manifestUrl) {
            $trimmed = trim($line);
            if ($trimmed === '') {
                return $line;
            }

            if (str_starts_with($trimmed, '#')) {
                return preg_replace_callback('/URI="([^"]+)"/', function (array $match) use ($manifestUrl) {
                    return 'URI="'.$this->proxyUrl($this->absoluteUrl($match[1], $manifestUrl)).'"';
                }, $line) ?? $line;
            }

            return $this->proxyUrl($this->absoluteUrl($trimmed, $manifestUrl));
        }, $lines));
    }

    private function absoluteUrl(string $url, string $baseUrl): string
    {
        if (preg_match('~^https?://~i', $url)) {
            return $url;
        }

        if (str_starts_with($url, '//')) {
            $scheme = parse_url($baseUrl, PHP_URL_SCHEME) ?: 'https';

            return $scheme.':'.$url;
        }

        $scheme = parse_url($baseUrl, PHP_URL_SCHEME) ?: 'https';
        $host = parse_url($baseUrl, PHP_URL_HOST) ?: '';
        $path = parse_url($baseUrl, PHP_URL_PATH) ?: '/';
        $dir = preg_replace('~/[^/]*$~', '/', $path) ?: '/';

        if (str_starts_with($url, '/')) {
            return "{$scheme}://{$host}{$url}";
        }

        return "{$scheme}://{$host}{$dir}{$url}";
    }

    private function proxyUrl(string $url): string
    {
        $base = rtrim((string) config('services.allanime.proxy_public_prefix', '/api/external/public'), '/');

        return $base.'/stream/allanime/'.self::encodeUrl($url);
    }

    private function guessContentType(string $url): string
    {
        $path = strtolower(parse_url($url, PHP_URL_PATH) ?: '');

        return match (true) {
            str_ends_with($path, '.m3u8') => 'application/vnd.apple.mpegurl',
            str_ends_with($path, '.ts') => 'video/mp2t',
            str_ends_with($path, '.m4s') => 'video/iso.segment',
            str_ends_with($path, '.mp4') => 'video/mp4',
            str_ends_with($path, '.key') => 'application/octet-stream',
            default => 'application/octet-stream',
        };
    }

    private function corsHeaders(): array
    {
        return [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Access-Control-Allow-Headers' => '*',
        ];
    }
}
