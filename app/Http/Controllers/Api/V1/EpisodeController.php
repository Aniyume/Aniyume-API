<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Request $request)
    {
        return Episode::paginate(20);
    }

    public function getAllTranslators()
    {
        $translators = Episode::whereNotNull('translator')
            ->select('translator', 'translation_type')
            ->distinct()
            ->get();

        return response()->json(['data' => $translators]);
    }

    public function show($id)
    {
        $episode = Episode::findOrFail($id);

        return response()->json($episode);
    }

    public function getPlayer($id)
    {
        $episode = Episode::findOrFail($id);

        return response()->json([
            'player_url' => $episode->player_url,
            'player_iframe' => $episode->player_iframe,
        ]);
    }

    public function getByAnime(Anime $anime)
    {
        return response()->json(['data' => $anime->episodes]);
    }
}
