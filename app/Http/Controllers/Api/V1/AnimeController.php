<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AnimeResource;
use App\Http\Resources\EpisodeResource;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

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

        $anime = $query->with('tags')->paginate(20);

        return AnimeResource::collection($anime);
    }

    public function show($id)
    {
        try {
            $anime = Anime::with('tags')->findOrFail($id);

            return new AnimeResource($anime);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Anime not found',
                'message' => $e->getMessage(),
            ], 404);
        }
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
        return response()->json([]);
    }

    public function studios()
    {
        return response()->json([]);
    }

    public function search(Request $request)
    {
        $query = Anime::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'ILIKE', '%'.$request->q.'%')
                    ->orWhere('description', 'ILIKE', '%'.$request->q.'%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }

        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        if ($request->filled('rating_min')) {
            $query->where('rating', '>=', $request->rating_min);
        }

        if ($request->filled('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('slug', $request->genre);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $sortBy = $request->get('sort', 'popularity');
        $sortOrder = $request->get('order', 'desc');

        switch ($sortBy) {
            case 'rating':
                $query->orderByRaw('rating DESC NULLS LAST');
                break;
            case 'popularity':
                $query->orderByRaw('popularity DESC NULLS LAST');
                break;
            case 'year':
                $query->orderByRaw("year $sortOrder NULLS LAST");
                break;
            case 'title':
                $query->orderByRaw("REGEXP_REPLACE(LOWER(title), '[^a-z0-9]', '', 'g') ASC");
                break;
            default:
                $query->orderByRaw('popularity DESC NULLS LAST');
        }

        $anime = $query->with('tags')->paginate(20);

        return AnimeResource::collection($anime);
    }
}
