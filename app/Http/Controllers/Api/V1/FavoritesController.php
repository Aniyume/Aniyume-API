<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $favorites = Favorite::where('user_id', auth()->id())
            ->with('anime')
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json($favorites);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'anime_id' => 'required|integer|exists:anime,id',
        ]);

        $favorite = Favorite::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'anime_id' => $validated['anime_id'],
            ]
        );

        return response()->json($favorite->load('anime'), 201);
    }

    public function show($id): JsonResponse
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('id', $id)
            ->with('anime')
            ->firstOrFail();

        return response()->json($favorite);
    }

    public function destroy($id): JsonResponse
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $favorite->delete();

        return response()->json(['message' => 'Removed from favorites']);
    }

    public function checkFavorite($anime_id): JsonResponse
    {
        $isFavorite = Favorite::where('user_id', auth()->id())
            ->where('anime_id', $anime_id)
            ->exists();

        return response()->json([
            'anime_id' => $anime_id,
            'is_favorite' => $isFavorite,
        ]);
    }
}
