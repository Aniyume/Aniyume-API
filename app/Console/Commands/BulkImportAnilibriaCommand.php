<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BulkImportAnilibriaCommand extends Command
{
    protected $signature = 'episodes:bulk-import
        {--id-from=8000  : Start of Anilibria release ID range}
        {--id-to=10300   : End of Anilibria release ID range}
        {--batch=20      : Concurrent requests per batch}
        {--no-cache      : Re-fetch even if already imported}';

    protected $description = 'Bulk-import Anilibria episodes: fetch all releases by ID, match to local anime, store episodes';

    private int $fetched   = 0;
    private int $matched   = 0;
    private int $created   = 0;
    private int $skipped   = 0;
    private int $errors    = 0;

    public function handle(): int
    {
        $idFrom    = (int) $this->option('id-from');
        $idTo      = (int) $this->option('id-to');
        $batchSize = (int) $this->option('batch');
        $noCache   = $this->option('no-cache');

        $this->info("Fetching Anilibria releases ID {$idFrom}–{$idTo} in batches of {$batchSize}...");

        // Build a local title index from our anime DB for fast matching
        $this->info('Building local anime title index...');
        $animeIndex = $this->buildAnimeIndex();
        $this->line('  Index size: ' . count($animeIndex) . ' entries');

        $ids = range($idFrom, $idTo);
        $chunks = array_chunk($ids, $batchSize);
        $total = count($chunks);

        $bar = $this->output->createProgressBar($total);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% | fetched=%fetched% matched=%matched% created=%created%');
        $bar->setMessage('0', 'fetched');
        $bar->setMessage('0', 'matched');
        $bar->setMessage('0', 'created');
        $bar->start();

        foreach ($chunks as $chunk) {
            $releases = $this->fetchBatch($chunk);

            foreach ($releases as $release) {
                $this->processRelease($release, $animeIndex, $noCache);
                $bar->setMessage((string) $this->fetched,  'fetched');
                $bar->setMessage((string) $this->matched,  'matched');
                $bar->setMessage((string) $this->created,  'created');
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->table(
            ['Metric', 'Value'],
            [
                ['Releases fetched',   $this->fetched],
                ['Anime matched',      $this->matched],
                ['Episodes created',   $this->created],
                ['Episodes skipped',   $this->skipped],
                ['Errors',             $this->errors],
            ]
        );

        // Final coverage report
        $total    = Anime::count();
        $withEp   = Anime::whereHas('episodes')->count();
        $this->info("Coverage: {$withEp}/{$total} (" . round($withEp / $total * 100) . "%)");

        return self::SUCCESS;
    }

    // ─────────────────────────────────────────────────────────────

    /**
     * Fetch a batch of release IDs concurrently using Http::pool().
     */
    private function fetchBatch(array $ids): array
    {
        $releases = [];

        try {
            $responses = Http::pool(function ($pool) use ($ids) {
                foreach ($ids as $id) {
                    $pool->as((string) $id)
                        ->timeout(8)
                        ->withHeaders(['Accept' => 'application/json'])
                        ->get("https://anilibria.top/api/v1/anime/releases/{$id}");
                }
            });

            foreach ($responses as $id => $response) {
                if ($response instanceof \Throwable) {
                    $this->errors++;
                    continue;
                }
                if ($response->successful()) {
                    $releases[] = $response->json();
                    $this->fetched++;
                }
            }
        } catch (\Throwable $e) {
            $this->errors++;
            Log::error('BulkImport batch error: ' . $e->getMessage());
        }

        return $releases;
    }

    /**
     * Build a normalized title → anime_id index for fast O(1) lookups.
     */
    private function buildAnimeIndex(): array
    {
        $index = [];

        Anime::select('id', 'title', 'anilibria_id')
            ->chunkById(1000, function ($animes) use (&$index) {
                foreach ($animes as $anime) {
                    if ($anime->anilibria_id) {
                        continue; // already matched
                    }
                    if ($anime->title) {
                        $index[$this->normalize($anime->title)] = $anime->id;
                    }
                }
            });

        return $index;
    }

    /**
     * Try to match a release to a local anime, then store episodes.
     */
    private function processRelease(array $release, array &$animeIndex, bool $noCache): void
    {
        $releaseId = $release['id'] ?? null;
        if (!$releaseId) {
            return;
        }

        // Find matching anime
        $animeId = $this->findMatch($release, $animeIndex);
        if (!$animeId) {
            return;
        }

        $this->matched++;

        $anime = Anime::find($animeId);
        if (!$anime) {
            return;
        }

        // Save the anilibria_id for future use
        if (!$anime->anilibria_id) {
            $anime->update(['anilibria_id' => $releaseId]);
        }

        $episodes = $release['episodes'] ?? [];
        if (empty($episodes)) {
            return;
        }

        foreach ($episodes as $ep) {
            $url = $ep['hls_1080'] ?? $ep['hls_720'] ?? $ep['hls_480'] ?? null;
            if (!$url) {
                continue;
            }

            $num = (int) ($ep['ordinal'] ?? $ep['sort_order'] ?? 1);

            $existing = Episode::where('anime_id', $animeId)
                ->where('episode_number', $num)
                ->where('source', 'anilibria')
                ->first();

            if ($existing && !$noCache) {
                $this->skipped++;
                continue;
            }

            $opening = $ep['opening'] ?? [];
            $ending  = $ep['ending']  ?? [];
            $skips   = null;
            if (!empty($opening['start']) || !empty($ending['start'])) {
                $skips = [
                    'opening' => [$opening['start'] ?? 0, $opening['stop'] ?? 0],
                    'ending'  => [$ending['start']  ?? 0, $ending['stop']  ?? 0],
                ];
            }

            $data = [
                'anime_id'            => $animeId,
                'episode_number'      => $num,
                'season_number'       => 1,
                'title'               => $ep['name'] ?? $ep['name_english'] ?? "Серия {$num}",
                'player_url'          => $url,
                'duration'            => isset($ep['duration']) ? (int) $ep['duration'] : null,
                'external_id'         => (string) $releaseId,
                'external_episode_id' => $ep['id'] ?? null,
                'source'              => 'anilibria',
                'translator'          => 'AniLibria',
                'translation_type'    => 'dub',
                'quality'             => '1080p',
                'priority'            => 10,
                'skip_times'          => $skips,
                'aired_at'            => $ep['updated_at'] ?? null,
            ];

            try {
                if ($existing) {
                    $existing->update($data);
                } else {
                    Episode::create($data);
                    $this->created++;
                }
            } catch (\Throwable $e) {
                $this->errors++;
                Log::error('BulkImport episode store error', [
                    'anime_id' => $animeId,
                    'ep'       => $num,
                    'error'    => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Find local anime ID by matching release names against the index.
     */
    private function findMatch(array $release, array &$animeIndex): ?int
    {
        $names = $release['name'] ?? [];
        $candidates = array_filter([
            $names['main']        ?? null,
            $names['english']     ?? null,
            $names['alternative'] ?? null,
        ]);

        foreach ($candidates as $name) {
            $key = $this->normalize($name);
            if (isset($animeIndex[$key])) {
                return $animeIndex[$key];
            }

            // Try without year suffix: "Аниме (2024)" → "аниме"
            $stripped = preg_replace('/\s*\(\d{4}\)\s*$/', '', $name);
            if ($stripped !== $name) {
                $key2 = $this->normalize($stripped);
                if (isset($animeIndex[$key2])) {
                    return $animeIndex[$key2];
                }
            }
        }

        return null;
    }

    private function normalize(string $s): string
    {
        $s = mb_strtolower($s);
        $s = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $s);
        $s = preg_replace('/\s+/', ' ', $s);
        return trim($s);
    }
}
