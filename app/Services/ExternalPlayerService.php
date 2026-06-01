<?php

namespace App\Services;

use App\Models\Anime;

class ExternalPlayerService
{
    public function __construct(private SettingService $settings) {}

    /**
     * Create last-resort iframe episodes from configured player templates.
     * This does not scrape third-party sites: admin must provide legal/embed templates in env.
     */
    public function getEpisodes(Anime $anime, array $titleCandidates = []): array
    {
        $providers = $this->providers();
        $episodes = [];

        foreach ($providers as $source => $provider) {
            if (! ($provider['enabled'] ?? false)) {
                continue;
            }

            $template = $provider['template'] ?? null;
            if (! is_string($template) || trim($template) === '') {
                continue;
            }

            $url = $this->buildUrl($template, $anime, $titleCandidates);
            if (! $url) {
                continue;
            }

            $episodes[] = [
                'episode_number' => 1,
                'season_number' => 1,
                'title' => 'Плеер: '.($provider['translator'] ?? ucfirst((string) $source)),
                'player_url' => $url,
                'player_iframe' => '<iframe src="'.e($url).'" frameborder="0" allowfullscreen></iframe>',
                'external_id' => $anime->shikimori_id ?: $anime->id,
                'source' => (string) $source,
                'translator' => (string) ($provider['translator'] ?? ucfirst((string) $source)),
                'translation_type' => 'voice',
                'quality' => 'auto',
                'priority' => 1,
            ];
        }

        return $episodes;
    }

    public function diagnostics(?Anime $anime = null, array $titleCandidates = []): array
    {
        return collect($this->providers())->map(function (array $provider, string $source) use ($anime, $titleCandidates) {
            $template = $provider['template'] ?? '';
            $preview = $anime && $template ? $this->buildUrl($template, $anime, $titleCandidates) : null;

            return [
                'source' => $source,
                'name' => $provider['name'] ?? ucfirst($source),
                'enabled' => (bool) ($provider['enabled'] ?? false),
                'has_template' => is_string($template) && trim($template) !== '',
                'translator' => $provider['translator'] ?? ucfirst($source),
                'preview_url' => $preview,
                'valid_preview' => $preview !== null,
            ];
        })->values()->all();
    }

    private function providers(): array
    {
        $settings = $this->settings->all();
        $globalEnabled = (bool) ($settings['external_players.enabled'] ?? false);
        $configured = $settings['external_players.providers'] ?? [];

        if (! is_array($configured) || empty($configured)) {
            $configured = collect(config('services.external_players', []))->map(function (array $provider, string $key) {
                return [
                    'key' => $key,
                    'name' => ucfirst($key),
                    'enabled' => false,
                    'template' => $provider['template'] ?? '',
                    'translator' => $provider['translator'] ?? ucfirst($key),
                ];
            })->values()->all();
        }

        return collect($configured)
            ->filter(fn ($provider) => is_array($provider) && ! empty($provider['key']))
            ->mapWithKeys(function (array $provider) use ($globalEnabled) {
                $key = (string) $provider['key'];

                return [$key => array_merge($provider, [
                    'enabled' => $globalEnabled && (bool) ($provider['enabled'] ?? false),
                ])];
            })
            ->all();
    }

    private function buildUrl(string $template, Anime $anime, array $titleCandidates): ?string
    {
        $title = $titleCandidates[0] ?? $anime->title;
        $titleEn = $anime->title_en ?: $title;

        $replacements = [
            '{shikimori_id}' => rawurlencode((string) ($anime->shikimori_id ?? '')),
            '{title}' => rawurlencode((string) $title),
            '{title_en}' => rawurlencode((string) $titleEn),
            '{year}' => rawurlencode((string) ($anime->year ?? '')),
            '{anime_id}' => rawurlencode((string) $anime->id),
        ];

        $url = strtr($template, $replacements);

        if (! str_starts_with($url, 'https://') && ! str_starts_with($url, 'http://')) {
            return null;
        }

        return $url;
    }
}
