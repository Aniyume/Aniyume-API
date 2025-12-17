<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Resources\Api\V1\RatingResource;
use App\Models\Rating;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingsController extends Controller
{
    public function index(Request $request)
    {
        $ratings = Rating::with('anime')
            ->where('user_id', $request->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return RatingResource::collection($ratings);
    }

    public function store(StoreRatingRequest $request)
    {
        $userId = $request->user()->id;
        $animeId = $request->validated('anime_id');
        $ratingValue = $request->validated('rating');

        DB::beginTransaction();
        try {
            $rating = Rating::updateOrCreate(
                [
                    'user_id' => $userId,
                    'anime_id' => $animeId,
                ],
                [
                    'rating' => $ratingValue,
                ]
            );

            $anime = Anime::find($animeId);
            $totalRatings = Rating::where('anime_id', $animeId)->count();
            $sumRatings = Rating::where('anime_id', $animeId)->sum('rating');

            $anime->update([
                'ratings_count' => $totalRatings,
                'rating_sum' => $sumRatings,
                'rating' => $totalRatings > 0 ? round($sumRatings / $totalRatings, 1) : null,
            ]);

            DB::commit();

            $rating->load('anime');
            return new RatingResource($rating);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to add rating',
            ], 500);
        }
    }

    public function destroy(Request $request, Rating $rating)
    {
        $this->authorize('delete', $rating);

        DB::beginTransaction();
        try {
            $animeId = $rating->anime_id;
            $rating->delete();

            $anime = Anime::find($animeId);
            $totalRatings = Rating::where('anime_id', $animeId)->count();
            $sumRatings = Rating::where('anime_id', $animeId)->sum('rating');

            $anime->update([
                'ratings_count' => $totalRatings,
                'rating_sum' => $sumRatings,
                'rating' => $totalRatings > 0 ? round($sumRatings / $totalRatings, 1) : null,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Rating deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete rating',
            ], 500);
        }
    }

    public function getUserRating(Request $request, $animeId)
    {
        $rating = Rating::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->first();

        if (!$rating) {
            return response()->json([
                'rating' => null
            ]);
        }

        return response()->json([
            'rating' => $rating->rating
        ]);
    }
}
