<?php

namespace App\Services;

use App\Models\Anime;
use App\Models\Tag;
use App\Models\ImportLog;
use App\Models\BlacklistedAnime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ShikimoriImportService
{
    protected string $apiUrl = 'https://shikimori.io/api/graphql';
    protected int $perPage = 50;
    protected string $storageUrl = 'https://shikimori.io';

    public function importAll(bool $isInitialImport = true, int $startPage = 1): ImportLog
    {
        $importLog = ImportLog::create([
            'import_type' => $isInitialImport ? 'initial' : 'update',
            'started_at' => now(),
            'status' => 'running',
        ]);

        try {
            $currentPage = $startPage;
            $hasNextPage = true;
            $consecutiveErrors = 0;

            while ($hasNextPage) {
                $result = $this->importPage($currentPage, $isInitialImport, $importLog);

                if (!$result['success']) {
                    $consecutiveErrors++;

                    // If rate limited (403) — wait and retry up to 3 times
                    if ($consecutiveErrors <= 3 && str_contains($result['error'] ?? '', '403')) {
                        Log::warning("Shikimori rate limit hit on page {$currentPage}, waiting 5s... (attempt {$consecutiveErrors}/3)");
                        sleep(5);
                        continue; // retry same page
                    }

                    // After 3 retries or non-rate-limit error — save what we have
                    Log::warning("Shikimori import stopped at page {$currentPage}: " . ($result['error'] ?? 'Unknown'));
                    $importLog->update([
                        'finished_at' => now(),
                        'status' => 'partial',
                        'errors' => json_encode([
                            'stopped_at_page' => $currentPage,
                            'error' => $result['error'] ?? 'Unknown',
                            'hint' => "Resume with: php artisan import:anime --start-page={$currentPage}",
                        ]),
                    ]);
                    return $importLog;
                }

                $consecutiveErrors = 0; // reset on success

                // Если меньше $perPage, значит это последняя страница
                $hasNextPage = $result['count'] === $this->perPage;
                $currentPage++;

                // 1s delay between pages to respect Shikimori rate limits
                sleep(1);
            }

            $importLog->update([
                'finished_at' => now(),
                'status' => 'completed',
            ]);

        } catch (\Exception $e) {
            $importLog->update([
                'finished_at' => now(),
                'status' => 'failed',
                'errors' => json_encode(['error' => $e->getMessage()]),
            ]);

            Log::error('Shikimori Import failed', ['exception' => $e->getMessage()]);
        }

        return $importLog;
    }

    public function importPage(int $page, bool $isInitialImport, ImportLog $importLog): array
    {
        try {
            $response = $this->fetchAnimeFromShikimori($page);

            if (!$response['success']) {
                return $response;
            }

            $mediaList = $response['data']['animes'] ?? [];

            foreach ($mediaList as $mediaData) {
                $this->processAnime($mediaData, $isInitialImport, $importLog);
            }

            return [
                'success' => true,
                'count' => count($mediaList),
                'hasNextPage' => count($mediaList) === $this->perPage,
            ];

        } catch (\Exception $e) {
            Log::error('Shikimori Page import failed', [
                'page' => $page,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    protected function fetchAnimeFromShikimori(int $page): array
    {
        $query = '
            query ($page: Int!, $limit: Int!) {
              animes(page: $page, limit: $limit, order: ranked) {
                id
                name
                english
                japanese
                russian
                description
                poster {
                  mainUrl
                  originalUrl
                }
                score
                status
                kind
                episodes
                episodesAired
                duration
                airedOn {
                  year
                  month
                  day
                }
                releasedOn {
                  year
                  month
                  day
                }
                isCensored
                genres {
                  name
                  russian
                }
              }
            }
        ';

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept' => 'application/json',
                ])
                ->post($this->apiUrl, [
                    'query' => $query,
                    'variables' => [
                        'page' => $page,
                        'limit' => $this->perPage,
                    ],
                ]);

            if ($response->failed()) {
                return [
                    'success' => false,
                    'error' => 'Shikimori GraphQL request failed: ' . $response->status(),
                ];
            }

            $data = $response->json();

            if (isset($data['errors'])) {
                return [
                    'success' => false,
                    'error' => 'Shikimori API returned errors: ' . json_encode($data['errors']),
                ];
            }

            return [
                'success' => true,
                'data' => $data['data'],
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'HTTP request exception: ' . $e->getMessage(),
            ];
        }
    }

    protected function processAnime(array $mediaData, bool $isInitialImport, ImportLog $importLog): void
    {
        $externalId = (string) $mediaData['id'];
        $externalSource = 'shikimori';

        $isBlacklisted = BlacklistedAnime::where('external_id', $externalId)
            ->where('external_source', $externalSource)
            ->exists();

        if ($isBlacklisted) {
            $importLog->increment('total_skipped');
            return;
        }

        $existing = Anime::where('external_source', $externalSource)
            ->where('external_id', $externalId)
            ->first();

        if ($existing && $isInitialImport) {
            $importLog->increment('total_skipped');
            return;
        }

        $animeData = $this->mapShikimoriToAnime($mediaData);

        if ($existing) {
            // Update only if description is empty or if it's an update import
            $updateData = $animeData;
            unset($updateData['slug']); // don't override slug
            $existing->update($updateData);
            $anime = $existing;
            $importLog->increment('total_updated');
        } else {
            $anime = Anime::create($animeData);
            $importLog->increment('total_created');
        }

        // AI Description Generator for missing descriptions
        if (empty($anime->description) || mb_strlen($anime->description) < 20) {
            \App\Jobs\GenerateAnimeDescriptionJob::dispatch($anime);
        }

        $this->syncTags($anime, $mediaData);

        $importLog->increment('total_processed');
    }

    protected function cleanDescription(?string $html): ?string
    {
        if (!$html) return null;
        // Shikimori descriptions might contain BBCode or HTML. GraphQL usually returns HTML or plain text.
        // Strip basic HTML/BBCode attributes and tags to have a clean text
        $text = strip_tags($html);
        $text = preg_replace("/\[.*?\]/", "", $text);
        return trim($text) ?: null;
    }

    protected function mapShikimoriToAnime(array $mediaData): array
    {
        $title = !empty($mediaData['russian']) ? $mediaData['russian'] : $mediaData['name'];
        
        $baseSlug = Str::slug($title);
        $slug = $this->generateUniqueSlug($baseSlug, $mediaData['id']);

        $posterUrl = null;
        if (!empty($mediaData['poster']['originalUrl'])) {
            $posterUrl = $mediaData['poster']['originalUrl'];
            // Normalize URLs from Shikimori if they are relative
            if (Str::startsWith($posterUrl, '/')) {
                $posterUrl = $this->storageUrl . $posterUrl;
            }
        }

        $airedFrom = $this->parseDate($mediaData['airedOn'] ?? null);
        $airedTo = $this->parseDate($mediaData['releasedOn'] ?? null);

        $year = $airedFrom ? (int) date('Y', strtotime($airedFrom)) : null;

        return [
            'title' => $title,
            'title_en' => $mediaData['english'] ?? $mediaData['name'] ?? null,
            'title_jp' => $mediaData['japanese'] ?? null,
            'slug' => $slug,
            'description' => $this->cleanDescription($mediaData['description'] ?? null),
            'poster_url' => $posterUrl,
            'rating' => isset($mediaData['score']) ? (float) $mediaData['score'] : null,
            'year' => $year,
            'status' => $this->mapStatus($mediaData['status'] ?? null),
            'type' => $this->mapFormat($mediaData['kind'] ?? null),
            'number_of_episodes' => $mediaData['episodes'] ?: ($mediaData['episodesAired'] ?: null),
            'duration' => $mediaData['duration'] ?? null,
            'external_id' => (string) $mediaData['id'],
            'external_source' => 'shikimori',
            'aired_from' => $airedFrom,
            'aired_to' => $airedTo,
            'nsfw_flag' => $mediaData['isCensored'] ?? false,
        ];
    }

    protected function generateUniqueSlug(string $baseSlug, string $externalId): string
    {
        if (empty($baseSlug)) {
            $baseSlug = "anime-{$externalId}";
        }
        
        $slug = $baseSlug;
        $counter = 2;

        while (Anime::where('slug', $slug)
            ->where('external_id', '!=', $externalId)
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function parseDate(?array $date): ?string
    {
        if (!$date || empty($date['year'])) {
            return null;
        }

        $year = $date['year'];
        $month = $date['month'] ?? 1;
        $day = $date['day'] ?? 1;

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    protected function mapStatus(?string $status): string
    {
        return match(strtolower($status ?? '')) {
            'released' => 'finished',
            'ongoing' => 'ongoing',
            'anons' => 'planned',
            'paused' => 'paused',
            default => 'planned',
        };
    }

    protected function mapFormat(?string $format): string
    {
        return match(strtolower($format ?? '')) {
            'tv', 'tv_13', 'tv_24', 'tv_48' => 'tv',
            'movie' => 'movie',
            'ova' => 'ova',
            'ona' => 'ona',
            'special' => 'special',
            'music' => 'music',
            default => 'tv',
        };
    }

    protected function syncTags(Anime $anime, array $mediaData): void
    {
        if (empty($mediaData['genres'])) {
            return;
        }

        $tagIds = [];

        foreach ($mediaData['genres'] as $genre) {
            $tagName = !empty($genre['russian']) ? $genre['russian'] : $genre['name'];
            if (!$tagName) continue;

            $tag = Tag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName]
            );

            $tagIds[] = $tag->id;
        }

        $anime->tags()->sync($tagIds);
    }
}
