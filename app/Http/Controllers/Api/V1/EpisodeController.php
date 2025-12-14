<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\EpisodeResource;
use App\Models\Episode;
use App\Models\Anime;
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
            $query->where('translator', 'ILIKE', '%' . $request->translator . '%');
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
}
