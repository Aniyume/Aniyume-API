<?php

namespace App\Console\Commands;

use App\Models\Anime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FillMissingDescriptionsCommand extends Command
{
    protected $signature = 'anime:fill-descriptions
                            {--limit=0 : Максимальное количество (0 = все)}
                            {--dry-run : Только показать, не обновлять}
                            {--source=all : Источник: all, shikimori, anilist}';

    protected $description = 'Заполнить описания аниме из Shikimori и Anilist API (батчами)';

    private int $updated = 0;
    private int $failed  = 0;

    public function handle(): int
    {
        $limit  = (int) $this->option('limit');
        $dryRun = $this->option('dry-run');
        $source = $this->option('source');

        $baseQuery = Anime::where(function ($q) {
            $q->whereNull('description')
              ->orWhere('description', '')
              ->orWhereRaw('LENGTH(description) < 20');
        })->orderBy('id');

        $total = (clone $baseQuery)->count();

        if ($total === 0) {
            $this->info('Аниме без описания не найдено.');
            return self::SUCCESS;
        }

        $this->info("Найдено аниме без описания: {$total}");

        if ($dryRun) {
            $q = clone $baseQuery;
            if ($limit > 0) $q->limit($limit);
            $this->table(
                ['ID', 'Title', 'shikimori_id', 'external_source', 'external_id'],
                $q->get(['id', 'title', 'external_id', 'external_source', 'shikimori_id'])
                  ->map(fn($a) => [$a->id, $a->title, $a->shikimori_id, $a->external_source, $a->external_id])
            );
            $this->warn('[dry-run] Ничего не обновлено.');
            return self::SUCCESS;
        }

        // ── Shikimori (GraphQL батчами по 50) ────────────────────────────────
        if (in_array($source, ['all', 'shikimori'])) {
            $q = Anime::where(function ($q) {
                    $q->whereNull('description')
                      ->orWhere('description', '')
                      ->orWhereRaw('LENGTH(description) < 20');
                })
                ->whereNotNull('shikimori_id')
                ->orderBy('id');

            if ($limit > 0) $q->limit($limit);

            $shikiAnimes = $q->get(['id', 'shikimori_id']);

            if ($shikiAnimes->isNotEmpty()) {
                $this->info("\nShikimori: {$shikiAnimes->count()} аниме (батчами по 50)");
                $bar = $this->output->createProgressBar($shikiAnimes->count());
                $bar->start();

                foreach ($shikiAnimes->chunk(50) as $chunk) {
                    $ids = $chunk->pluck('shikimori_id')->all();
                    $descriptions = $this->fetchShikimoriDescriptions($ids);

                    foreach ($chunk as $anime) {
                        $desc = $descriptions[$anime->shikimori_id] ?? null;
                        if ($desc) {
                            Anime::where('id', $anime->id)->update(['description' => $desc]);
                            $this->updated++;
                        } else {
                            $this->failed++;
                        }
                        $bar->advance();
                    }

                    usleep(500000); // 0.5s между батчами
                }

                $bar->finish();
                $this->newLine();
            }
        }

        // ── Anilist (GraphQL батчами по 50) ──────────────────────────────────
        if (in_array($source, ['all', 'anilist'])) {
            $q = Anime::where(function ($q) {
                    $q->whereNull('description')
                      ->orWhere('description', '')
                      ->orWhereRaw('LENGTH(description) < 20');
                })
                ->where('external_source', 'anilist')
                ->whereNotNull('external_id')
                ->orderBy('id');

            if ($limit > 0) $q->limit($limit);

            $anilistAnimes = $q->get(['id', 'external_id']);

            if ($anilistAnimes->isNotEmpty()) {
                $this->info("\nAnilist: {$anilistAnimes->count()} аниме (батчами по 50)");
                $bar = $this->output->createProgressBar($anilistAnimes->count());
                $bar->start();

                foreach ($anilistAnimes->chunk(50) as $chunk) {
                    $ids = $chunk->pluck('external_id')->map(fn($id) => (int) $id)->all();
                    $descriptions = $this->fetchAnilistDescriptions($ids);

                    foreach ($chunk as $anime) {
                        $desc = $descriptions[(int) $anime->external_id] ?? null;
                        if ($desc) {
                            Anime::where('id', $anime->id)->update(['description' => $desc]);
                            $this->updated++;
                        } else {
                            $this->failed++;
                        }
                        $bar->advance();
                    }

                    usleep(500000);
                }

                $bar->finish();
                $this->newLine();
            }
        }

        $this->info("Готово. Обновлено: {$this->updated}, не найдено описания: {$this->failed}");
        return self::SUCCESS;
    }

    // ── Shikimori GraphQL (батч) ─────────────────────────────────────────────

    /**
     * @param  string[]  $ids
     * @return array<string, string>  [shikimori_id => description]
     */
    private function fetchShikimoriDescriptions(array $ids): array
    {
        $idsStr = implode(',', $ids);

        $query = '
            query ($ids: String!, $limit: Int!) {
                animes(ids: $ids, limit: $limit) {
                    id
                    description
                }
            }
        ';

        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'User-Agent' => 'Aniyume/1.0',
                    'Accept'     => 'application/json',
                ])
                ->post('https://shikimori.one/api/graphql', [
                    'query'     => $query,
                    'variables' => ['ids' => $idsStr, 'limit' => count($ids)],
                ]);

            if (!$response->successful()) {
                Log::warning("FillDescriptions: Shikimori batch failed: " . $response->status());
                return [];
            }

            $animes = $response->json('data.animes') ?? [];
            $result = [];

            foreach ($animes as $item) {
                $desc = $this->cleanText($item['description'] ?? null);
                if ($desc) {
                    $result[(string) $item['id']] = $desc;
                }
            }

            return $result;

        } catch (\Exception $e) {
            Log::warning("FillDescriptions: Shikimori batch error: " . $e->getMessage());
            return [];
        }
    }

    // ── Anilist GraphQL (батч) ───────────────────────────────────────────────

    /**
     * @param  int[]  $ids
     * @return array<int, string>  [anilist_id => description]
     */
    private function fetchAnilistDescriptions(array $ids): array
    {
        $query = '
            query ($ids: [Int]) {
                Page(perPage: 50) {
                    media(id_in: $ids, type: ANIME) {
                        id
                        description(asHtml: false)
                    }
                }
            }
        ';

        try {
            $response = Http::timeout(15)
                ->post('https://graphql.anilist.co', [
                    'query'     => $query,
                    'variables' => ['ids' => $ids],
                ]);

            if (!$response->successful()) {
                Log::warning("FillDescriptions: Anilist batch failed: " . $response->status());
                return [];
            }

            $media = $response->json('data.Page.media') ?? [];
            $result = [];

            foreach ($media as $item) {
                $desc = $this->cleanText($item['description'] ?? null);
                if ($desc) {
                    $result[$item['id']] = $desc;
                }
            }

            return $result;

        } catch (\Exception $e) {
            Log::warning("FillDescriptions: Anilist batch error: " . $e->getMessage());
            return [];
        }
    }

    // ── Хелперы ──────────────────────────────────────────────────────────────

    private function cleanText(?string $text): ?string
    {
        if (empty($text)) {
            return null;
        }

        $text = strip_tags($text);
        $text = preg_replace('/\[.*?\]/s', '', $text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = trim($text);

        return mb_strlen($text) >= 20 ? $text : null;
    }
}
