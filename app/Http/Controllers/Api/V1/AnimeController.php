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
        $query = Anime::query()
            ->with(['tags'])
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('year'), fn ($q) => $q->where('release_year', $request->year))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($subQ) use ($request) {
                    $subQ->where('title', 'ILIKE', "%{$request->search}%")
                        ->orWhere('title_en', 'ILIKE', "%{$request->search}%");
                });
            });

        if ($request->has('sort')) {
            $sortMap = [
                'rating' => ['rating', 'DESC'],
                'popularity' => ['popularity', 'DESC'],
                'newest' => ['aired_from', 'DESC'],
                'title' => ['title', 'ASC'],
            ];

            $sort = $sortMap[$request->sort] ?? ['id', 'ASC'];
            $query->orderByRaw("{$sort[0]} {$sort[1]} NULLS LAST");
        } else {
            $query->orderBy('id', 'ASC');
        }

        $anime = $query->paginate(20);

        return AnimeResource::collection($anime);
    }

    public function show(Anime $anime)
    {
        $anime->load(['tags', 'studio', 'genres', 'episodes']);

        return new AnimeResource($anime);
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
        return $this->index($request);
    }

    public function updateStatus(Request $request, Anime $anime)
    {
        $user = $request->user();
        $status = $request->input('status');
        $validStatuses = ['watching', 'planned', 'completed', 'on_hold', 'dropped'];

        if ($status && ! in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 422);
        }

        try {
            if ($status === null) {
                $user->animes()->detach($anime->id);
            } else {
                $user->animes()->syncWithoutDetaching([
                    $anime->id => ['status' => $status, 'updated_at' => now()],
                ]);
            }

            return response()->json(['success' => true, 'status' => $status]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCommunityStats(Anime $anime)
    {
        return response()->json($anime->getCommunityStats());
    }

    public function getUserStatus(Request $request, Anime $anime)
    {
        $user = $request->user();
        $pivot = \DB::table('anime_user')
            ->where('user_id', $user->id)
            ->where('anime_id', $anime->id)
            ->first();

        return response()->json([
            'status' => $pivot?->status,
            'found' => $pivot !== null,
        ]);
    }
}
