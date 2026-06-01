<?php

namespace App\Services;

use App\Models\Anime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AnimeBannerEnrichmentService
{
    private string $anilistUrl = 'https://graphql.anilist.co';

    private string $tmdbBaseUrl = 'https://api.themoviedb.org/3';

    public function candidates(Anime $anime): array
    {
        return collect($this->fromAniList($anime))
            ->merge($this->fromTmdb($anime))
            ->merge($this->fromKitsu($anime))
            ->sortByDesc('score')
            ->unique('url')
            ->values()
            ->all();
    }

    public function bestCandidate(Anime $anime): ?array
    {
        return $this->candidates($anime)[0] ?? null;
    }

    public function apply(Anime $anime, string $url, string $source = 'anilist', bool $force = false): Anime
    {
        if ($anime->cover_locked && ! $force) {
            throw new \RuntimeException('Cover is locked. Use force to replace it.');
        }

        $anime->update([
            'cover_url' => $url,
            'cover_source' => $source,
            'cover_updated_at' => now(),
        ]);

        return $anime->refresh();
    }

    private function fromAniList(Anime $anime): array
    {
        $query = <<<'GRAPHQL'
query ($search: String) {
  Page(page: 1, perPage: 8) {
    media(search: $search, type: ANIME) {
      id
      idMal
      title { romaji english native }
      seasonYear
      format
      episodes
      bannerImage
      coverImage { extraLarge large color }
    }
  }
}
GRAPHQL;

        $search = $anime->title_en ?: $anime->title;
        $response = Http::timeout(20)->post($this->anilistUrl, [
            'query' => $query,
            'variables' => ['search' => $search],
        ]);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('data.Page.media', []))
            ->filter(fn (array $media) => ! empty($media['bannerImage']))
            ->map(fn (array $media) => $this->candidateFromAniList($anime, $media))
            ->values()
            ->all();
    }

    private function candidateFromAniList(Anime $anime, array $media): array
    {
        $titles = array_filter([
            $media['title']['romaji'] ?? null,
            $media['title']['english'] ?? null,
            $media['title']['native'] ?? null,
        ]);

        $score = 90;
        $localTitles = array_filter([$anime->title, $anime->title_en, $anime->title_jp]);
        foreach ($localTitles as $localTitle) {
            foreach ($titles as $remoteTitle) {
                if (Str::lower(trim($localTitle)) === Str::lower(trim($remoteTitle))) {
                    $score += 45;
                } elseif (str_contains(Str::lower($remoteTitle), Str::lower($localTitle)) || str_contains(Str::lower($localTitle), Str::lower($remoteTitle))) {
                    $score += 18;
                }
            }
        }
        if ($anime->year && (int) ($media['seasonYear'] ?? 0) === (int) $anime->year) {
            $score += 25;
        }
        if ($anime->number_of_episodes && (int) ($media['episodes'] ?? 0) === (int) $anime->number_of_episodes) {
            $score += 12;
        }

        return [
            'source' => 'anilist',
            'source_id' => $media['id'] ?? null,
            'url' => $media['bannerImage'],
            'score' => $score,
            'title' => $media['title']['romaji'] ?? $media['title']['english'] ?? $anime->title,
            'year' => $media['seasonYear'] ?? null,
            'format' => $media['format'] ?? null,
            'episodes' => $media['episodes'] ?? null,
            'color' => $media['coverImage']['color'] ?? null,
        ];
    }

    private function fromTmdb(Anime $anime): array
    {
        $token = config('services.tmdb.token') ?: env('TMDB_BEARER_TOKEN');
        $apiKey = config('services.tmdb.key') ?: env('TMDB_API_KEY');

        if (! $token && ! $apiKey) {
            return [];
        }

        $headers = $token ? ['Authorization' => 'Bearer '.$token] : [];
        $query = array_filter([
            'query' => $anime->title_en ?: $anime->title,
            'year' => $anime->year,
            'first_air_date_year' => $anime->year,
            'include_adult' => false,
            'language' => 'en-US',
            'api_key' => $token ? null : $apiKey,
        ], fn ($value) => $value !== null && $value !== '');

        $candidates = [];

        foreach (['tv', 'movie'] as $type) {
            $response = Http::withHeaders($headers)->timeout(20)->get("{$this->tmdbBaseUrl}/search/{$type}", $query);

            if ($response->failed()) {
                continue;
            }

            foreach (array_slice($response->json('results', []), 0, 5) as $result) {
                if (empty($result['backdrop_path'])) {
                    continue;
                }

                $candidates[] = $this->candidateFromTmdb($anime, $result, $type);
            }
        }

        return $candidates;
    }

    private function candidateFromTmdb(Anime $anime, array $result, string $type): array
    {
        $remoteTitle = $result['name'] ?? $result['title'] ?? $result['original_name'] ?? $result['original_title'] ?? null;
        $releaseDate = $result['first_air_date'] ?? $result['release_date'] ?? null;
        $remoteYear = $releaseDate ? (int) substr($releaseDate, 0, 4) : null;
        $score = 105 + (float) ($result['vote_average'] ?? 0);

        if ($remoteTitle) {
            foreach (array_filter([$anime->title, $anime->title_en, $anime->title_jp]) as $localTitle) {
                if (Str::lower(trim($localTitle)) === Str::lower(trim($remoteTitle))) {
                    $score += 45;
                } elseif (str_contains(Str::lower($remoteTitle), Str::lower($localTitle)) || str_contains(Str::lower($localTitle), Str::lower($remoteTitle))) {
                    $score += 16;
                }
            }
        }

        if ($anime->year && $remoteYear && abs((int) $anime->year - $remoteYear) <= 1) {
            $score += 25;
        }

        return [
            'source' => 'tmdb_'.$type,
            'source_id' => $result['id'] ?? null,
            'url' => 'https://image.tmdb.org/t/p/original'.$result['backdrop_path'],
            'score' => $score,
            'title' => $remoteTitle ?: $anime->title,
            'year' => $remoteYear,
            'format' => $type,
            'episodes' => null,
            'color' => null,
        ];
    }

    private function fromKitsu(Anime $anime): array
    {
        $response = Http::timeout(20)->get('https://kitsu.io/api/edge/anime', [
            'filter[text]' => $anime->title_en ?: $anime->title,
            'page[limit]' => 8,
        ]);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('data', []))
            ->filter(fn (array $item) => ! empty($item['attributes']['coverImage']['original'] ?? null))
            ->map(fn (array $item) => $this->candidateFromKitsu($anime, $item))
            ->values()
            ->all();
    }

    private function candidateFromKitsu(Anime $anime, array $item): array
    {
        $attributes = $item['attributes'] ?? [];
        $titles = array_filter([
            $attributes['canonicalTitle'] ?? null,
            ...array_values($attributes['titles'] ?? []),
        ]);
        $remoteYear = ! empty($attributes['startDate']) ? (int) substr($attributes['startDate'], 0, 4) : null;
        $score = 82;

        foreach (array_filter([$anime->title, $anime->title_en, $anime->title_jp]) as $localTitle) {
            foreach ($titles as $remoteTitle) {
                if (Str::lower(trim($localTitle)) === Str::lower(trim($remoteTitle))) {
                    $score += 42;
                } elseif (str_contains(Str::lower($remoteTitle), Str::lower($localTitle)) || str_contains(Str::lower($localTitle), Str::lower($remoteTitle))) {
                    $score += 15;
                }
            }
        }

        if ($anime->year && $remoteYear && (int) $anime->year === $remoteYear) {
            $score += 20;
        }

        return [
            'source' => 'kitsu',
            'source_id' => $item['id'] ?? null,
            'url' => $attributes['coverImage']['original'],
            'score' => $score,
            'title' => $attributes['canonicalTitle'] ?? $anime->title,
            'year' => $remoteYear,
            'format' => $attributes['subtype'] ?? null,
            'episodes' => $attributes['episodeCount'] ?? null,
            'color' => null,
        ];
    }
}
