<?php

namespace App\Services;

use App\Http\Controllers\Api\V1\StreamProxyController;
use App\Models\Anime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AllAnimeService
{
    private string $baseHost;

    private string $apiUrl;

    private string $referer;

    private string $agent;

    private string $mode;

    private string $keyHex;

    public function __construct()
    {
        $this->baseHost = (string) config('services.allanime.base_host', 'allanime.day');
        $this->apiUrl = (string) config('services.allanime.api_url', "https://api.{$this->baseHost}/api");
        $this->referer = (string) config('services.allanime.referer', 'https://youtu-chan.com');
        $this->agent = (string) config('services.allanime.user_agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0');
        $mode = (string) config('services.allanime.mode', 'sub');
        $this->mode = in_array($mode, ['sub', 'dub'], true) ? $mode : 'sub';
        $this->keyHex = hash('sha256', 'Xot36i3lK3:v1');
    }

    public function isEnabled(): bool
    {
        return (bool) config('services.allanime.enabled', env('ALLANIME_ENABLED', false));
    }

    public function findBestMatch(Anime $anime, array $titleCandidates): ?array
    {
        if (! $this->isEnabled()) {
            return null;
        }

        $cacheKey = 'allanime_match_'.$anime->id.'_'.md5(implode('|', $titleCandidates));

        return Cache::remember($cacheKey, now()->addHours(12), function () use ($anime, $titleCandidates) {
            $best = null;
            $bestScore = PHP_INT_MIN;

            foreach (array_values(array_unique(array_filter($titleCandidates))) as $title) {
                foreach ($this->search($title) as $candidate) {
                    $score = $this->matchScore($candidate, $titleCandidates, $anime->year);
                    if ($score > $bestScore) {
                        $best = $candidate;
                        $bestScore = $score;
                    }
                }
            }

            return $bestScore >= 80 ? $best : null;
        });
    }

    public function getEpisodesForAnime(Anime $anime, array $titleCandidates): array
    {
        $match = $this->findBestMatch($anime, $titleCandidates);
        if (! $match || empty($match['_id'])) {
            return [];
        }

        $showId = (string) $match['_id'];
        $episodeNumbers = $this->episodeNumbers($showId);

        if (empty($episodeNumbers)) {
            return [];
        }

        $episodes = [];
        $maxEpisodes = max(1, (int) config('services.allanime.max_episodes_per_import', 2000));

        foreach (array_slice($episodeNumbers, 0, $maxEpisodes) as $episodeNumber) {
            $source = $this->resolveEpisodeSource($showId, (string) $episodeNumber);
            if (! $source) {
                continue;
            }

            $playerUrl = $this->preparePlayerUrl((string) $source['url']);

            $episodes[] = [
                'episode_number' => (int) $episodeNumber,
                'season_number' => 1,
                'title' => 'Серия '.$episodeNumber,
                'player_url' => $playerUrl,
                'player_iframe' => null,
                'external_id' => $showId,
                'external_episode_id' => (string) $episodeNumber,
                'source' => 'allanime',
                'translator' => 'AllAnime',
                'translation_type' => $this->mode === 'dub' ? 'dub' : 'subtitles',
                'quality' => $source['quality'] ?? 'auto',
                'priority' => 3,
            ];
        }

        return $episodes;
    }

    private function search(string $query): array
    {
        $query = trim($query);
        if ($query === '') {
            return [];
        }

        $cacheKey = 'allanime_search_'.md5($this->mode.'|'.$query);

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($query) {
            $gql = 'query( $search: SearchInput $limit: Int $page: Int $translationType: VaildTranslationTypeEnumType $countryOrigin: VaildCountryOriginEnumType ) { shows( search: $search limit: $limit page: $page translationType: $translationType countryOrigin: $countryOrigin ) { edges { _id name availableEpisodes __typename } }}';
            $json = $this->postGraphql([
                'variables' => [
                    'search' => ['allowAdult' => false, 'allowUnknown' => false, 'query' => $query],
                    'limit' => 40,
                    'page' => 1,
                    'translationType' => $this->mode,
                    'countryOrigin' => 'ALL',
                ],
                'query' => $gql,
            ]);

            return data_get($json, 'data.shows.edges', []) ?: [];
        });
    }

    private function episodeNumbers(string $showId): array
    {
        return Cache::remember('allanime_episodes_'.$this->mode.'_'.$showId, now()->addHours(6), function () use ($showId) {
            $gql = 'query ($showId: String!) { show( _id: $showId ) { _id availableEpisodesDetail }}';
            $json = $this->postGraphql([
                'variables' => ['showId' => $showId],
                'query' => $gql,
            ]);

            $numbers = data_get($json, "data.show.availableEpisodesDetail.{$this->mode}", []);
            if (! is_array($numbers)) {
                return [];
            }

            $numbers = array_values(array_filter($numbers, fn ($value) => is_numeric($value)));
            usort($numbers, fn ($a, $b) => (float) $a <=> (float) $b);

            return $numbers;
        });
    }

    private function resolveEpisodeSource(string $showId, string $episodeNumber): ?array
    {
        $cacheKey = 'allanime_source_'.$this->mode.'_'.$showId.'_'.$episodeNumber;

        return Cache::remember($cacheKey, now()->addHours(2), function () use ($showId, $episodeNumber) {
            $gql = 'query ($showId: String!, $translationType: VaildTranslationTypeEnumType!, $episodeString: String!) { episode( showId: $showId translationType: $translationType episodeString: $episodeString ) { episodeString sourceUrls }}';
            $vars = ['showId' => $showId, 'translationType' => $this->mode, 'episodeString' => $episodeNumber];
            $queryHash = 'd405d0edd690624b66baba3068e0edc3ac90f1597d898a1ec8db4e5c43c00fec';

            $response = Http::timeout(20)
                ->retry(1, 500)
                ->withHeaders($this->headers(['Origin' => $this->referer]))
                ->get($this->apiUrl, [
                    'variables' => json_encode($vars, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
                    'extensions' => json_encode(['persistedQuery' => ['version' => 1, 'sha256Hash' => $queryHash]], JSON_THROW_ON_ERROR),
                ]);

            $json = $this->decodeMaybeEncrypted($response->body());

            if (! data_get($json, 'data.episode.sourceUrls')) {
                $json = $this->postGraphql(['variables' => $vars, 'query' => $gql]);
            }

            $sourceUrls = data_get($json, 'data.episode.sourceUrls', []);
            if (! is_array($sourceUrls)) {
                return null;
            }

            $links = [];
            foreach ($sourceUrls as $source) {
                $sourceUrl = $source['sourceUrl'] ?? null;
                $sourceName = $source['sourceName'] ?? null;
                if (! is_string($sourceUrl) || $sourceUrl === '') {
                    continue;
                }

                $links = array_merge($links, $this->extractLinks($sourceUrl, (string) $sourceName));
            }

            $links = array_values(array_filter($links, fn ($link) => is_array($link) && ! empty($link['url']) && preg_match('~^https?://~', (string) $link['url'])));
            if (empty($links)) {
                return null;
            }

            usort($links, fn ($a, $b) => $this->qualityScore($b['quality'] ?? '') <=> $this->qualityScore($a['quality'] ?? ''));

            return $links[0];
        });
    }

    private function extractLinks(string $sourceUrl, string $sourceName): array
    {
        $sourceUrl = $this->decodeProviderUrl($sourceUrl);

        try {
            if (str_contains($sourceUrl, 'mp4upload')) {
                $body = Http::timeout(15)->withHeaders($this->headers())->withOptions(['verify' => false])->get($sourceUrl)->body();
                if (preg_match('~src:\s*"([^"]+)"~', $body, $m)) {
                    return [['quality' => 'mp4', 'url' => $this->normalizeUrl($m[1])]];
                }
            }

            if (str_contains($sourceUrl, 'tools.fast4speed.rsvp')) {
                return [['quality' => 'mp4', 'url' => $sourceUrl]];
            }

            $url = str_starts_with($sourceUrl, 'http') ? $sourceUrl : "https://{$this->baseHost}{$sourceUrl}";
            $body = Http::timeout(20)->withHeaders($this->headers())->get($url)->body();

            return $this->parseProviderBody($body);
        } catch (\Throwable $e) {
            Log::debug('AllAnime link extraction failed', ['source' => $sourceName, 'error' => $e->getMessage()]);

            return [];
        }
    }

    private function parseProviderBody(string $body): array
    {
        $links = [];
        $body = str_replace(['\\/', '\\u002F', '\\u0026', '\\u003D'], ['/', '/', '&', '='], $body);

        if (preg_match_all('~"link"\s*:\s*"([^"]+)".*?"resolutionStr"\s*:\s*"([^"]+)"~s', $body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $links[] = ['quality' => $match[2], 'url' => $this->normalizeUrl($match[1])];
            }
        }

        if (preg_match_all('~"hls"\s*,\s*"url"\s*:\s*"([^"]+)".*?"hardsub_lang"\s*:\s*"en-US"~s', $body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $links[] = ['quality' => 'hls', 'url' => $this->normalizeUrl($match[1])];
            }
        }

        if (empty($links) && preg_match_all('~https?://[^"\\\s]+\.(?:m3u8|mp4)(?:\?[^"\\\s]+)?~', $body, $matches)) {
            foreach (array_unique($matches[0]) as $url) {
                $links[] = ['quality' => str_contains($url, '.m3u8') ? 'hls' : 'mp4', 'url' => $this->normalizeUrl($url)];
            }
        }

        return $this->uniqueLinks($links);
    }

    private function postGraphql(array $payload): array
    {
        try {
            $response = Http::timeout(20)
                ->retry(1, 500)
                ->withHeaders($this->headers(['Content-Type' => 'application/json']))
                ->post($this->apiUrl, $payload);

            return $this->decodeMaybeEncrypted($response->body());
        } catch (\Throwable $e) {
            Log::debug('AllAnime GraphQL failed', ['error' => $e->getMessage()]);

            return [];
        }
    }

    private function decodeMaybeEncrypted(string $body): array
    {
        $json = json_decode($body, true);
        if (is_array($json) && empty($json['data']['tobeparsed'])) {
            return $json;
        }

        $payload = $json['data']['tobeparsed'] ?? $json['tobeparsed'] ?? null;
        if (! is_string($payload) || $payload === '') {
            return is_array($json) ? $json : [];
        }

        try {
            $binary = base64_decode($payload, true);
            if ($binary === false || strlen($binary) < 30) {
                return [];
            }

            $iv = substr($binary, 1, 12);
            $cipherText = substr($binary, 13, -16);
            $key = hex2bin($this->keyHex);
            if ($key === false) {
                return [];
            }

            $plain = openssl_decrypt($cipherText, 'aes-256-ctr', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv."\0\0\0\2");
            $decoded = is_string($plain) ? json_decode($plain, true) : null;

            return is_array($decoded) ? $decoded : [];
        } catch (\Throwable) {
            return [];
        }
    }

    private function decodeProviderUrl(string $value): string
    {
        if (! str_starts_with($value, '--')) {
            return $value;
        }

        $map = [
            '79' => 'A', '7a' => 'B', '7b' => 'C', '7c' => 'D', '7d' => 'E', '7e' => 'F', '7f' => 'G', '70' => 'H', '71' => 'I', '72' => 'J', '73' => 'K', '74' => 'L', '75' => 'M', '76' => 'N', '77' => 'O', '68' => 'P', '69' => 'Q', '6a' => 'R', '6b' => 'S', '6c' => 'T', '6d' => 'U', '6e' => 'V', '6f' => 'W', '60' => 'X', '61' => 'Y', '62' => 'Z',
            '59' => 'a', '5a' => 'b', '5b' => 'c', '5c' => 'd', '5d' => 'e', '5e' => 'f', '5f' => 'g', '50' => 'h', '51' => 'i', '52' => 'j', '53' => 'k', '54' => 'l', '55' => 'm', '56' => 'n', '57' => 'o', '48' => 'p', '49' => 'q', '4a' => 'r', '4b' => 's', '4c' => 't', '4d' => 'u', '4e' => 'v', '4f' => 'w', '40' => 'x', '41' => 'y', '42' => 'z',
            '08' => '0', '09' => '1', '0a' => '2', '0b' => '3', '0c' => '4', '0d' => '5', '0e' => '6', '0f' => '7', '00' => '8', '01' => '9', '15' => '-', '16' => '.', '67' => '_', '46' => '~', '02' => ':', '17' => '/', '07' => '?', '1b' => '#', '63' => '[', '65' => ']', '78' => '@', '19' => '!', '1c' => '$', '1e' => '&', '10' => '(', '11' => ')', '12' => '*', '13' => '+', '14' => ',', '03' => ';', '05' => '=', '1d' => '%',
        ];

        $decoded = '';
        foreach (str_split($value, 2) as $chunk) {
            $decoded .= $map[$chunk] ?? '';
        }

        return str_replace('/clock', '/clock.json', $decoded) ?: $value;
    }

    private function matchScore(array $candidate, array $wantedTitles, ?int $year): int
    {
        $score = 0;
        $candidateName = $this->normalize((string) ($candidate['name'] ?? ''));

        foreach ($wantedTitles as $wanted) {
            $wanted = $this->normalize((string) $wanted);
            if ($wanted !== '' && $candidateName !== '') {
                if ($candidateName === $wanted) {
                    $score += 100;
                } elseif (str_contains($candidateName, $wanted) || str_contains($wanted, $candidateName)) {
                    $score += 35;
                }
            }
        }

        $count = (int) data_get($candidate, "availableEpisodes.{$this->mode}", 0);
        $score += min($count, 50);

        if ($year && preg_match('~\((\d{4})\)~', (string) ($candidate['name'] ?? ''), $m)) {
            $delta = abs((int) $m[1] - $year);
            $score += $delta === 0 ? 20 : ($delta === 1 ? 5 : -20);
        }

        return $score;
    }

    private function normalize(string $title): string
    {
        $title = mb_strtolower($title);
        $title = str_replace('ё', 'е', $title);

        return trim(preg_replace('/[^\p{L}\p{N}]+/u', '', $title));
    }

    private function qualityScore(string $quality): int
    {
        if (preg_match('/(\d{3,4})/', $quality, $m)) {
            return (int) $m[1];
        }

        return str_contains($quality, 'hls') ? 1000 : 1;
    }

    private function preparePlayerUrl(string $url): string
    {
        $url = $this->normalizeUrl($url);

        if ((bool) config('services.allanime.proxy_enabled', true) && $this->needsProxy($url)) {
            return rtrim((string) config('services.allanime.proxy_public_prefix', '/api/external/public'), '/')
                .'/stream/allanime/'.StreamProxyController::encodeUrl($url);
        }

        return $url;
    }

    private function needsProxy(string $url): bool
    {
        if (Str::contains($url, ['.m3u8', '.ts', '.m4s'])) {
            return true;
        }

        $host = parse_url($url, PHP_URL_HOST) ?: '';

        return $host !== '' && ! Str::contains($host, ['googlevideo.com', 'youtube.com', 'youtu.be']);
    }

    private function normalizeUrl(string $url): string
    {
        $url = str_replace(['\\u0026', '\\u003D', '\\/'], ['&', '=', '/'], trim($url));

        if (str_starts_with($url, '//')) {
            return 'https:'.$url;
        }

        return $url;
    }

    private function uniqueLinks(array $links): array
    {
        $seen = [];
        $result = [];

        foreach ($links as $link) {
            $url = $link['url'] ?? null;
            if (! is_string($url) || $url === '' || isset($seen[$url])) {
                continue;
            }

            $seen[$url] = true;
            $result[] = $link;
        }

        return $result;
    }

    private function headers(array $extra = []): array
    {
        return array_merge([
            'Accept' => 'application/json,text/plain,*/*',
            'User-Agent' => $this->agent,
            'Referer' => $this->referer,
        ], $extra);
    }
}
