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

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('year')) {
            $query->where('release_year', $request->year);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'ILIKE', "%{$request->search}%")
                    ->orWhere('title_en', 'ILIKE', "%{$request->search}%");
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
                    $query->orderByRaw('aired_from DESC NULLS LAST');
                    break;
                case 'title':
                    $query->orderBy('title', 'asc');
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
            ->orderBy('season_number')
            ->orderBy('episode_number')
            ->paginate(50);

        return EpisodeResource::collection($episodes);
    }

    public function episode(Anime $anime, Episode $episode)
    {
        if ($episode->anime_id !== $anime->id) {
            abort(404);
        }

        return new EpisodeResource($episode);
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
            $query->where('release_year', $request->year);
        }

        $anime = $query->with('tags')->paginate(20);

        return AnimeResource::collection($anime);
    }

    public function updateStatus(Request $request, $id)
    {
        $user = $request->user();
        $status = $request->input('status');
        $validStatuses = ['watching', 'planned', 'completed', 'on_hold', 'dropped'];

        if ($status && ! in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 422);
        }

        try {
            if ($status === null) {
                $user->users()->detach($id);
            } else {
                $user->users()->syncWithoutDetaching([
                    $id => ['status' => $status, 'updated_at' => now()],
                ]);
            }

            return response()->json(['success' => true, 'status' => $status]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCommunityStats($id)
    {
        $anime = Anime::findOrFail($id);

        return response()->json($anime->getCommunityStats());
    }

    public function getUserStatus(Request $request, $id)
    {
        $user = $request->user();
        $pivot = \DB::table('anime_user')
            ->where('user_id', $user->id)
            ->where('anime_id', $id)
            ->first();

        return response()->json([
            'status' => $pivot?->status,
            'found' => $pivot !== null,
        ]);
    }
}
