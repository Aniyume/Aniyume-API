<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AnimeResource;
use App\Http\Resources\EpisodeResource;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimeController extends Controller
{
    public function index(Request $request)
    {
        $query = Anime::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('year')) {
            $query->whereYear('aired_from', $request->year);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('title_english', 'like', "%{$request->search}%")
                  ->orWhere('title_japanese', 'like', "%{$request->search}%");
            });
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'rating':
                    $query->orderByRaw('rating DESC NULLS LAST');
                    break;
                case 'popularity':
                    $query->orderByRaw('popularity DESC NULLS LAST');
                    break;
                case 'newest':
                    $query->where('aired_from', '<=', now())
                          ->orderByRaw('aired_from DESC NULLS LAST');
                    break;
                case 'upcoming':
                    $query->where('aired_from', '>', now())
                          ->orderByRaw('aired_from ASC NULLS LAST');
                    break;
                case 'oldest':
                    $query->orderByRaw('aired_from ASC NULLS LAST');
                    break;
                case 'title':
                    $query->orderByRaw("REGEXP_REPLACE(LOWER(title), '[^a-z0-9]', '', 'g') ASC");
                    break;
                case 'title_raw':
                    $query->orderBy('title', 'asc');
                    break;
                case 'id_asc':
                    $query->orderBy('id', 'asc');
                    break;
                case 'id_desc':
                    $query->orderByDesc('id');
                    break;
                default:
                    $query->orderBy('id', 'asc');
            }
        } else {
            $query->orderBy('id', 'asc');
        }
        

        $anime = $query->paginate(20);

        return AnimeResource::collection($anime);
    }

    public function show(Anime $anime)
    {
        $anime->load(['genres', 'studios', 'tags']);
        return new AnimeResource($anime);
    }

    public function episodes(Anime $anime)
    {
        $episodes = $anime->episodes()
            ->orderBy('episode_number')
            ->orderBy('translator')
            ->paginate(50);

        return EpisodeResource::collection($episodes);
    }

    public function episode(Anime $anime, Episode $episode)
    {
        if ($episode->anime_id !== $anime->id) {
            abort(404, 'Episode not found for this anime');
        }

        return new EpisodeResource($episode);
    }

    public function genres()
    {
        $genres = \App\Models\Genre::withCount('anime')
            ->orderBy('name')
            ->get();

        return response()->json($genres);
    }

    public function studios()
    {
        $studios = \App\Models\Studio::withCount('anime')
            ->orderBy('name')
            ->get();

        return response()->json($studios);
    }
}
