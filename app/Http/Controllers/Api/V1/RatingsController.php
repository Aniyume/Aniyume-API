<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Resources\Api\V1\RatingResource;
use App\Models\Anime;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $ratings = Rating::with('anime')
            ->where('user_id', $request->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return response()->json([
            'data' => RatingResource::collection($ratings),
            'pagination' => [
                'total' => $ratings->total(),
                'per_page' => $ratings->perPage(),
                'current_page' => $ratings->currentPage(),
                'last_page' => $ratings->lastPage(),
            ],
        ]);
    }

    public function store(StoreRatingRequest $request): JsonResponse
    {
        $userId = $request->user()->id;
        $animeId = $request->validated('anime_id');
        $ratingValue = $request->validated('rating');

        DB::beginTransaction();
        try {
            $rating = Rating::updateOrCreate(
                ['user_id' => $userId, 'anime_id' => $animeId],
                ['rating' => $ratingValue]
            );

            $anime = Anime::find($animeId);
            $totalRatings = Rating::where('anime_id', $animeId)->count();
            $sumRatings = Rating::where('anime_id', $animeId)->sum('rating');

            $anime->update([
                'rating' => $totalRatings > 0 ? round($sumRatings / $totalRatings, 2) : null,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Rating added',
                'data' => new RatingResource($rating->load('anime')),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to add rating'], 500);
        }
    }

    public function destroy(Request $request, Rating $rating): JsonResponse
    {
        if ($rating->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        DB::beginTransaction();
        try {
            $animeId = $rating->anime_id;
            $rating->delete();

            $anime = Anime::find($animeId);
            $totalRatings = Rating::where('anime_id', $animeId)->count();
            $sumRatings = Rating::where('anime_id', $animeId)->sum('rating');

            $anime->update([
                'rating' => $totalRatings > 0 ? round($sumRatings / $totalRatings, 2) : null,
            ]);

            DB::commit();
            return response()->json(['message' => 'Rating deleted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete rating'], 500);
        }
    }

    public function getUserRating(Request $request, $animeId): JsonResponse
    {
        $rating = Rating::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->first();

        return response()->json(['rating' => $rating?->rating]);
    }
}
