<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BulkImportAnilibriaCommand extends Command
{
    protected $signature = 'episodes:bulk-import
        {--per-page=50      : Releases per catalog page}
        {--max-pages=0      : Limit catalog pages this run (0 = all)}
        {--limit=0          : Max matched titles to import this run (0 = no limit)}
        {--sleep=300        : Pause in ms between API requests}
        {--no-cache         : Re-fetch/update even if episode already imported}
        {--fail-threshold=8 : Abort after N consecutive request failures}';

    protected $description = 'Импорт эпизодов AniLibria через каталог (постранично, последовательно, без перебора мёртвых ID).';

    private const CATALOG_URL = 'https://anilibria.top/api/v1/anime/catalog/releases';

    private const RELEASE_URL = 'https://anilibria.top/api/v1/anime/releases/';

    private int $fetched = 0;

    private int $matched = 0;

    private int $created = 0;

    private int $updated = 0;

    private int $skipped = 0;

    private int $errors = 0;

    private int $consecutiveFailures = 0;

    public function handle(): int
    {
        @set_time_limit(0);

        $perPage = max(1, (int) $this->option('per-page'));
        $maxPages = (int) $this->option('max-pages');
        $limit = (int) $this->option('limit');
        $sleepMs = max(0, (int) $this->option('sleep'));
        $noCache = (bool) $this->option('no-cache');
        $failThreshold = max(1, (int) $this->option('fail-threshold'));

        // Блокировка: не даём двум импортам идти параллельно (это и роняло VPS).
        $lock = Cache::lock('episodes:bulk-import', 3600);
        if (! $lock->get()) {
            $this->error('Импорт уже выполняется (lock занят). Дождитесь завершения предыдущего запуска.');

            return self::FAILURE;
        }

        try {
            $this->info('Строю индекс локальных тайтлов...');
            [$nameIndex, $anilibriaMap] = $this->buildIndexes();
            $this->line('  Индекс: '.count($nameIndex).' названий, '.count($anilibriaMap).' уже привязанных к AniLibria');

            $page = 1;
            $totalPages = null;
            $processedReleaseIds = [];

            $this->info('Обхожу каталог AniLibria постранично...');

            while (true) {
                if ($maxPages > 0 && $page > $maxPages) {
                    $this->line("  Достигнут лимит страниц ({$maxPages}).");
                    break;
                }

                $catalog = $this->request(self::CATALOG_URL, [
                    'limit' => $perPage,
                    'page' => $page,
                ]);

                if ($catalog === null) {
                    if ($this->consecutiveFailures >= $failThreshold) {
                        $this->newLine();
                        $this->error("AniLibria недоступна: {$failThreshold} ошибок подряд. Останавливаюсь, чтобы не грузить сервер.");
                        break;
                    }
                    $this->throttle($sleepMs);

                    continue; // повторим эту же страницу после паузы
                }

                $releases = $catalog['data'] ?? [];
                $totalPages ??= (int) ($catalog['meta']['pagination']['total_pages'] ?? 0);

                if (empty($releases)) {
                    break;
                }

                foreach ($releases as $listItem) {
                    $releaseId = $listItem['id'] ?? null;
                    if (! $releaseId || isset($processedReleaseIds[$releaseId])) {
                        continue;
                    }

                    $animeId = $this->matchAnime($listItem, $nameIndex, $anilibriaMap);
                    if (! $animeId) {
                        continue;
                    }

                    $processedReleaseIds[$releaseId] = true;
                    $this->matched++;

                    // Детальный запрос только для совпавших тайтлов.
                    $this->throttle($sleepMs);
                    $detail = $this->request(self::RELEASE_URL.$releaseId);
                    if ($detail === null) {
                        continue;
                    }
                    $this->fetched++;

                    $this->storeEpisodes($detail, $animeId, $noCache);

                    if ($limit > 0 && $this->matched >= $limit) {
                        $this->line("  Достигнут лимит тайтлов ({$limit}).");
                        break 2;
                    }
                }

                // Гигиена памяти.
                unset($catalog, $releases);
                if ($page % 5 === 0) {
                    gc_collect_cycles();
                    $this->line(sprintf('  Стр. %d/%s | fetched=%d matched=%d created=%d updated=%d | mem=%dMB',
                        $page, $totalPages ?: '?', $this->fetched, $this->matched, $this->created, $this->updated,
                        (int) (memory_get_usage(true) / 1048576)));
                }

                if ($totalPages && $page >= $totalPages) {
                    break;
                }
                $page++;
                $this->throttle($sleepMs);
            }
        } finally {
            $lock->release();
        }

        $this->newLine();
        $this->table(['Метрика', 'Значение'], [
            ['Релизов получено (детально)', $this->fetched],
            ['Тайтлов сопоставлено', $this->matched],
            ['Эпизодов создано', $this->created],
            ['Эпизодов обновлено', $this->updated],
            ['Эпизодов пропущено', $this->skipped],
            ['Ошибок запросов', $this->errors],
        ]);

        $total = Anime::count();
        if ($total > 0) {
            $withEp = Anime::whereHas('episodes')->count();
            $this->info("Покрытие: {$withEp}/{$total} (".round($withEp / $total * 100).'%)');
        }

        return self::SUCCESS;
    }

    // ─────────────────────────────────────────────────────────────

    /**
     * Один GET с таймаутом и ретраями. Возвращает массив JSON или null при ошибке.
     * Ведёт счётчик ошибок подряд для авто-останова.
     */
    private function request(string $url, array $query = []): ?array
    {
        try {
            $response = Http::timeout(15)
                ->connectTimeout(10)
                ->retry(2, 800, throw: false)
                ->withHeaders(['Accept' => 'application/json'])
                ->get($url, $query);

            if ($response->successful()) {
                $this->consecutiveFailures = 0;

                return $response->json();
            }

            // 404 — релиз не существует, это не сбой связи.
            if ($response->status() === 404) {
                $this->consecutiveFailures = 0;

                return null;
            }

            $this->errors++;
            $this->consecutiveFailures++;

            return null;
        } catch (\Throwable $e) {
            $this->errors++;
            $this->consecutiveFailures++;
            Log::warning('AniLibria request failed', ['url' => $url, 'error' => $e->getMessage()]);

            return null;
        }
    }

    private function throttle(int $ms): void
    {
        if ($ms > 0) {
            usleep($ms * 1000);
        }
    }

    /**
     * @return array{0: array<string,int>, 1: array<int,int>} [normalizedName => animeId, anilibriaId => animeId]
     */
    private function buildIndexes(): array
    {
        $nameIndex = [];
        $anilibriaMap = [];

        Anime::select('id', 'title', 'title_en', 'title_jp', 'anilibria_id')
            ->chunkById(1000, function ($animes) use (&$nameIndex, &$anilibriaMap) {
                foreach ($animes as $anime) {
                    if ($anime->anilibria_id) {
                        $anilibriaMap[(int) $anime->anilibria_id] = $anime->id;
                    }
                    foreach ([$anime->title, $anime->title_en, $anime->title_jp] as $t) {
                        if ($t) {
                            $key = $this->normalize($t);
                            // не перетираем уже занятый ключ
                            $nameIndex[$key] ??= $anime->id;
                        }
                    }
                }
            });

        return [$nameIndex, $anilibriaMap];
    }

    /**
     * Сопоставление релиза каталога с локальным аниме: сначала по anilibria_id, затем по названиям.
     */
    private function matchAnime(array $item, array &$nameIndex, array &$anilibriaMap): ?int
    {
        $releaseId = (int) ($item['id'] ?? 0);
        if ($releaseId && isset($anilibriaMap[$releaseId])) {
            return $anilibriaMap[$releaseId];
        }

        $names = $item['name'] ?? [];
        $candidates = array_filter([
            $names['main'] ?? null,
            $names['english'] ?? null,
            $names['alternative'] ?? null,
        ]);

        foreach ($candidates as $name) {
            $key = $this->normalize($name);
            if (isset($nameIndex[$key])) {
                return $nameIndex[$key];
            }
            $stripped = preg_replace('/\s*\(\d{4}\)\s*$/', '', $name);
            if ($stripped !== $name) {
                $key2 = $this->normalize($stripped);
                if (isset($nameIndex[$key2])) {
                    return $nameIndex[$key2];
                }
            }
        }

        return null;
    }

    private function storeEpisodes(array $release, int $animeId, bool $noCache): void
    {
        $releaseId = $release['id'] ?? null;

        $anime = Anime::find($animeId);
        if (! $anime) {
            return;
        }
        if (! $anime->anilibria_id && $releaseId) {
            $anime->update(['anilibria_id' => $releaseId]);
        }

        foreach (($release['episodes'] ?? []) as $ep) {
            $url = $ep['hls_1080'] ?? $ep['hls_720'] ?? $ep['hls_480'] ?? null;
            if (! $url) {
                continue;
            }

            $num = (int) ($ep['ordinal'] ?? $ep['sort_order'] ?? 1);

            $existing = Episode::where('anime_id', $animeId)
                ->where('episode_number', $num)
                ->where('source', 'anilibria')
                ->first();

            if ($existing && ! $noCache) {
                $this->skipped++;

                continue;
            }

            $opening = $ep['opening'] ?? [];
            $ending = $ep['ending'] ?? [];
            $skips = null;
            if (! empty($opening['start']) || ! empty($ending['start'])) {
                $skips = [
                    'opening' => [$opening['start'] ?? 0, $opening['stop'] ?? 0],
                    'ending' => [$ending['start'] ?? 0, $ending['stop'] ?? 0],
                ];
            }

            $data = [
                'anime_id' => $animeId,
                'episode_number' => $num,
                'season_number' => 1,
                'title' => $ep['name'] ?? $ep['name_english'] ?? "Серия {$num}",
                'player_url' => $url,
                'duration' => isset($ep['duration']) ? (int) $ep['duration'] : null,
                'external_id' => (string) $releaseId,
                'external_episode_id' => $ep['id'] ?? null,
                'source' => 'anilibria',
                'translator' => 'AniLibria',
                'translation_type' => 'dub',
                'quality' => '1080p',
                'priority' => 10,
                'skip_times' => $skips,
                'aired_at' => $ep['updated_at'] ?? null,
            ];

            try {
                if ($existing) {
                    $existing->update($data);
                    $this->updated++;
                } else {
                    Episode::create($data);
                    $this->created++;
                }
            } catch (\Throwable $e) {
                $this->errors++;
                Log::error('BulkImport episode store error', [
                    'anime_id' => $animeId,
                    'ep' => $num,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    private function normalize(string $s): string
    {
        $s = mb_strtolower($s);
        $s = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $s);
        $s = preg_replace('/\s+/', ' ', $s);

        return trim($s);
    }
}
