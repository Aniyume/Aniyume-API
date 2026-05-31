<?php

namespace App\Services;

use App\Models\Anime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AnimeBannerEnrichmentService
{
    private string $anilistUrl = 'https://graphql.anilist.co';

    public function candidates(Anime $anime): array
    {
        return collect($this->fromAniList($anime))
            ->sortByDesc('score')
            ->values()
            ->all();
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
}
