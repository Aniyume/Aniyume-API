<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\FavoriteResource;
use App\Models\Favorite;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FavoritesController extends Controller
{
    public function index(Request $request)
    {
        $favorites = Favorite::with('anime')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return FavoriteResource::collection($favorites);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anime_id' => 'required|exists:anime,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $exists = Favorite::where('user_id', $request->user()->id)
            ->where('anime_id', $request->anime_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Anime already in favorites'
            ], 409);
        }

        DB::beginTransaction();
        try {
            $favorite = Favorite::create([
                'user_id' => $request->user()->id,
                'anime_id' => $request->anime_id,
            ]);

            $anime = Anime::find($request->anime_id);
            $anime->increment('favorites');

            DB::commit();

            $favorite->load('anime');
            return new FavoriteResource($favorite);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to add to favorites',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $animeId)
    {
        $favorite = Favorite::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->first();

        if (!$favorite) {
            return response()->json([
                'message' => 'Favorite not found'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $favorite->delete();

            $anime = Anime::find($animeId);
            $anime->decrement('favorites');

            DB::commit();

            return response()->json([
                'message' => 'Removed from favorites successfully'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to remove from favorites',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function check(Request $request, $animeId)
    {
        $exists = Favorite::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->exists();

        return response()->json([
            'is_favorite' => $exists
        ]);
    }
}
