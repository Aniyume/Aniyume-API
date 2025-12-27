<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Anime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 20);

        $favorites = Favorite::query()
            ->where('user_id', $user->id)
            ->with(['anime:id,title,slug,poster_url'])
            ->paginate($perPage);

        $data = $favorites->map(function (Favorite $favorite) {
            return [
                'id' => $favorite->id,
                'anime_id' => $favorite->anime_id,
                'title' => $favorite->anime?->title,
                'slug' => $favorite->anime?->slug,
                'poster_url' => $favorite->anime?->poster_url,
                'created_at' => $favorite->created_at,
            ];
        })->values();

        return response()->json([
            'data' => $data,
            'pagination' => [
                'total' => $favorites->total(),
                'per_page' => $favorites->perPage(),
                'current_page' => $favorites->currentPage(),
                'last_page' => $favorites->lastPage(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $request->validate([
            'anime_id' => 'required|exists:anime,id',
        ]);

        $animeId = (int) $request->input('anime_id');

        $exists = Favorite::query()
            ->where('user_id', $user->id)
            ->where('anime_id', $animeId)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already in favorites'], 409);
        }

        Favorite::create([
            'user_id' => $user->id,
            'anime_id' => $animeId,
        ]);

        return response()->json([
            'message' => 'Added to favorites',
            'anime_id' => $animeId,
        ], 201);
    }

    public function destroy(Request $request, int $animeId): JsonResponse
    {
        $user = $request->user();

        $favorite = Favorite::query()
            ->where('user_id', $user->id)
            ->where('anime_id', $animeId)
            ->first();

        if (! $favorite) {
            return response()->json(['message' => 'Not found in favorites'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Removed from favorites']);
    }

    public function checkFavorite(Request $request, int $animeId): JsonResponse
    {
        $user = $request->user();

        $isFavorite = Favorite::query()
            ->where('user_id', $user->id)
            ->where('anime_id', $animeId)
            ->exists();

        return response()->json(['is_favorite' => $isFavorite]);
    }
}
