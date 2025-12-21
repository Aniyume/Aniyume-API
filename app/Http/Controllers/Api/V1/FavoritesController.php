<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function store($animeId): JsonResponse
    {
        $user = Auth::user();

        Favorite::firstOrCreate([
            'user_id' => $user->id,
            'anime_id' => $animeId,
        ]);

        return response()->json([
            'message' => 'Added to favorites',
            'anime_id' => $animeId,
        ], 201);
    }

    public function destroy($animeId): JsonResponse
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)
            ->where('anime_id', $animeId)
            ->delete();

        return response()->json([
            'message' => 'Removed from favorites',
            'anime_id' => $animeId,
        ]);
    }

    public function getFavorites(): JsonResponse
    {
        $user = Auth::user();

        $favorites = $user->favorites()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($favorites);
    }
}
