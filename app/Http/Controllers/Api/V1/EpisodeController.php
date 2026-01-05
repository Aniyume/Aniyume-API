<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

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
        return Episode::paginate(20);
    }

    /**
     * Список переводчиков
     *
     * Возвращает уникальный список всех доступных переводчиков и типов озвучки.
     */
    public function getAllTranslators()
    {
        $translators = Episode::whereNotNull('translator')
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
    $episodes = $anime->episodes()
        ->orderBy('episode_number', 'asc')
        ->get();

    return response()->json(['data' => $episodes]);
}
}
