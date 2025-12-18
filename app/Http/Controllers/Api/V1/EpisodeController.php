<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\EpisodeResource;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Request $request)
    {
        $query = Episode::with('anime');

        if ($request->has('anime_id')) {
            $query->where('anime_id', $request->anime_id);
        }

        if ($request->has('season_number')) {
            $query->where('season_number', $request->season_number);
        }

        if ($request->has('translator')) {
            $query->where('translator', 'ILIKE', '%'.$request->translator.'%');
        }

        $sortBy = $request->get('sort', 'episode_number');
        $sortOrder = $request->get('order', 'asc');

        $allowedSorts = ['episode_number', 'season_number', 'aired_date', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('episode_number', 'asc');
        }

        $episodes = $query->paginate(50);

        return EpisodeResource::collection($episodes);
    }

    public function show(Episode $episode)
    {
        $episode->load('anime');

        return new EpisodeResource($episode);
    }

    public function getByAnime(Anime $anime)
    {
        $episodes = $anime->episodes()
            ->orderBy('season_number')
            ->orderBy('episode_number')
            ->orderBy('translator')
            ->paginate(50);

        return EpisodeResource::collection($episodes);
    }

    public function getAllTranslators()
    {
        $translators = Episode::whereNotNull('translator')
            ->select('translator', 'translation_type')
            ->groupBy('translator', 'translation_type')
            ->orderBy('translator')
            ->get();

        return response()->json([
            'data' => $translators,
        ]);
    }

    public function getPlayer(Episode $episode)
    {
        if (! $episode->player_url && ! $episode->player_iframe) {
            return response()->json([
                'error' => 'Video not available',
                'message' => 'This episode does not have a video source yet',
                'episode_number' => $episode->episode_number,
                'translator' => $episode->translator,
                'anime_title' => $episode->anime->title,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'player_url' => $episode->player_url,
            'player_iframe' => $episode->player_iframe,
            'thumbnail_url' => $episode->thumbnail_url,
            'poster_url' => $episode->poster_url,
            'quality' => $episode->quality,
            'episode_number' => $episode->episode_number,
            'season_number' => $episode->season_number,
            'translator' => $episode->translator,
            'translation_type' => $episode->translation_type,
            'title' => $episode->title,
            'duration' => $episode->duration,
            'source' => $episode->source,
            'anime' => [
                'id' => $episode->anime->id,
                'title' => $episode->anime->title,
                'slug' => $episode->anime->slug,
                'poster_url' => $episode->anime->poster_url,
            ],
        ]);
    }
}
