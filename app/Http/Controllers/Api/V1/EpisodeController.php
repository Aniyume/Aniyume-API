<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use App\Services\KodikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @group Эпизоды
 *
 * Управление эпизодами и плеером.
 */
class EpisodeController extends Controller
{
    /**
     * Все эпизоды (пагинация)
     */
    public function index(Request $request)
    {
        $query = Episode::query();
        /** @var mixed $query */

        return $query->paginate(20);
    }

    /**
     * Список переводчиков
     *
     * Возвращает уникальный список всех доступных переводчиков и типов озвучки.
     */
    public function getAllTranslators()
    {
        $query = Episode::query();
        /** @var mixed $query */

        $translators = $query->whereNotNull('translator')
            ->select('translator', 'translation_type')
            ->distinct()
            ->get();

        return response()->json(['data' => $translators]);
    }

    /**
     * Детали эпизода
     *
     * @urlParam id integer ID эпизода. Example: 1
     */
    public function show($id)
    {
        $episode = Episode::findOrFail($id);
        return response()->json($episode);
    }

    /**
     * Ссылка на плеер
     *
     * Возвращает URL плеера и iframe для вставки.
     * @urlParam id integer ID эпизода. Example: 1
     */
    public function getPlayer($id)
    {
        $episode = Episode::findOrFail($id);

        return response()->json([
            'player_url' => $episode->player_url,
            'player_iframe' => $episode->player_iframe,
        ]);
    }

    /**
     * Эпизоды конкретного аниме
     *
     * @urlParam anime integer ID аниме. Example: 3
     */
    public function getByAnime(Anime $anime)
    {
        // Get all episodes, order by episode_number
        $episodes = $anime->episodes()
            ->orderBy('episode_number', 'asc')
            ->get();

        // Group by translator
        $grouped = $episodes->groupBy('translator')->map(function ($eps) {
            return $eps->map(function ($ep) {
                return [
                    'id' => $ep->id,
                    'episode_number' => $ep->episode_number,
                    'season_number' => $ep->season_number,
                    'title' => $ep->title,
                    'source' => $ep->source,
                    'player_url' => $ep->player_url,
                    'player_iframe' => $ep->player_iframe,
                    'translation_type' => $ep->translation_type,
                    'quality' => $ep->quality,
                    'skip_times' => is_string($ep->skip_times) ? json_decode($ep->skip_times, true) : $ep->skip_times,
                ];
            });
        });

        return response()->json(['data' => $grouped]);
    }

    /**
     * Источники плеера для конкретного эпизода
     * 
     * Возвращает все доступные источники (Anilibria, Kodik).
     * Если в БД нет эпизодов — пытается найти через Kodik в реальном времени.
     * 
     * @urlParam anime integer ID аниме. Example: 3
     * @urlParam episode integer Номер эпизода. Example: 1
     */
    public function getPlayerSources(Anime $anime, int $episodeNumber)
    {
        $query = Episode::query();
        /** @var mixed $query */

        $episodes = $query->where('anime_id', '=', $anime->id, 'and')
            ->where('episode_number', '=', $episodeNumber, 'and')
            ->orderByDesc('priority')
            ->get();

        $sources = $episodes->map(function ($ep) {
            $isHls = str_ends_with($ep->player_url ?? '', '.m3u8') || $ep->source === 'anilibria';
            
            // Better label format: "AniLibria" instead of "anilibria (AniLibria)"
            $label = $ep->translator ?: ucfirst($ep->source ?? 'Unknown');
            if ($ep->source === 'kodik' && $ep->translator && $ep->translator !== 'Kodik') {
                $label = "Kodik ({$ep->translator})";
            }

            return [
                'id' => $ep->id,
                'source' => $ep->source,
                'translator' => $ep->translator,
                'label' => $label,
                'type' => $isHls ? 'hls' : 'iframe',
                'url' => $ep->player_url,
                'iframe' => $ep->player_iframe,
                'quality' => $ep->quality,
                'priority' => $ep->priority,
                'skip_times' => is_string($ep->skip_times) ? json_decode($ep->skip_times, true) : $ep->skip_times,
                'poster_url' => $ep->poster_url,
            ];
        })->toArray();

        // Live Kodik fallback: if no sources found in DB, try Kodik in real-time
        if (empty($sources) && $anime->shikimori_id) {
            try {
                $kodikService = app(KodikService::class);
                $iframeUrl = $kodikService->buildEpisodeIframeUrl(
                    (int) $anime->shikimori_id, 
                    $episodeNumber
                );

                if ($iframeUrl) {
                    $sources[] = [
                        'id' => 0,
                        'source' => 'kodik',
                        'translator' => 'Kodik',
                        'label' => 'Kodik (авто)',
                        'type' => 'iframe',
                        'url' => $iframeUrl,
                        'iframe' => null,
                        'quality' => 'auto',
                        'priority' => 1,
                        'skip_times' => null,
                        'poster_url' => null,
                    ];
                }
            } catch (\Throwable $e) {
                // Silently fail — Kodik might be down
                Log::debug('Kodik live fallback failed: ' . $e->getMessage());
            }
        }

        if (empty($sources)) {
            return response()->json(['message' => 'Эпизод не найден'], 404);
        }

        return response()->json([
            'data' => [
                'episode_number' => $episodeNumber,
                'sources' => $sources,
            ]
        ]);
    }
}
