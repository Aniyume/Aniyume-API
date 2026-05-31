<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="AniYume API",
 *     version="1.0.0",
 *     description="Complete REST API documentation for AniYume - Anime Streaming Platform with user features",
 *
 *     @OA\Contact(
 *         email="support@aniyume.com",
 *         name="AniYume Support"
 *     ),
 *
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000/api/v1",
 *     description="Local Development Server"
 * )
 * @OA\Server(
 *     url="https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1",
 *     description="Ngrok Tunnel Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="Sanctum",
 *     description="Enter your Sanctum token in format: Bearer {your-token}"
 * )
 *
 * @OA\Tag(
 *     name="Authentication",
 *     description="User authentication and authorization endpoints"
 * )
 * @OA\Tag(
 *     name="Anime",
 *     description="Anime catalog endpoints - browse and search anime"
 * )
 * @OA\Tag(
 *     name="Episodes",
 *     description="Episode management and video player endpoints"
 * )
 * @OA\Tag(
 *     name="Watch History",
 *     description="Track user's watch progress and history"
 * )
 * @OA\Tag(
 *     name="Favorites",
 *     description="User's favorite anime management"
 * )
 * @OA\Tag(
 *     name="Ratings",
 *     description="User ratings for anime (1.0 to 10.0)"
 * )
 * @OA\Tag(
 *     name="Comments",
 *     description="User comments and discussions"
 * )
 * @OA\Tag(
 *     name="User Profile",
 *     description="User statistics and activity information"
 * )
 * @OA\Tag(
 *     name="Tags",
 *     description="Anime tags and genres"
 * )
 */
class SwaggerDocumentationController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"Authentication"},
     *     summary="Register a new user",
     *     description="Create a new user account with email and password",
     *     operationId="register",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *
     *             @OA\Property(property="name", type="string", example="John Doe", description="Full name of the user"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com", description="Valid email address"),
     *             @OA\Property(property="password", type="string", format="password", example="password123", minLength=8, description="Password (minimum 8 characters)"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="password123", description="Password confirmation (must match password)")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="User successfully registered",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="token", type="string", example="3|vWUOWe2DhVNMqcFLANNguxNuPCWVJJkYMa3Jog9s9c61ba6f"),
     *             @OA\Property(property="user", ref="#/components/schemas/User")
     *         )
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error", @OA\JsonContent(@OA\Property(property="message", type="string"), @OA\Property(property="errors", type="object")))
     * )
     */

    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Authentication"},
     *     summary="User login",
     *     description="Authenticate user and get access token",
     *     operationId="login",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"email","password"},
     *
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="token", type="string", example="3|vWUOWe2DhVNMqcFLANNguxNuPCWVJJkYMa3Jog9s9c61ba6f"),
     *             @OA\Property(property="user", ref="#/components/schemas/User")
     *         )
     *     ),
     *
     *     @OA\Response(response=422, description="Invalid credentials"),
     *     @OA\Response(response=403, description="Account not active")
     * )
     */

    /**
     * @OA\Post(
     *     path="/logout",
     *     tags={"Authentication"},
     *     summary="User logout",
     *     description="Invalidate current access token",
     *     operationId="logout",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful",
     *
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Logged out successfully"))
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */

    /**
     * @OA\Get(
     *     path="/user",
     *     tags={"Authentication"},
     *     summary="Get current user",
     *     description="Get authenticated user information",
     *     operationId="getCurrentUser",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="User data retrieved",
     *
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */

    /**
     * @OA\Get(
     *     path="/anime",
     *     tags={"Anime"},
     *     summary="Get list of anime",
     *     description="Get paginated list of anime with optional filters and sorting",
     *     operationId="getAnimeList",
     *
     *     @OA\Parameter(name="type", in="query", description="Filter by anime type", @OA\Schema(type="string", enum={"tv","movie","ova","ona","special","music"})),
     *     @OA\Parameter(name="status", in="query", description="Filter by status", @OA\Schema(type="string", enum={"planned","ongoing","finished","paused"})),
     *     @OA\Parameter(name="year", in="query", description="Filter by year", @OA\Schema(type="integer", example=2023)),
     *     @OA\Parameter(name="search", in="query", description="Search by title", @OA\Schema(type="string", example="Cowboy")),
     *     @OA\Parameter(name="sort", in="query", description="Sort order", @OA\Schema(type="string", enum={"rating","popularity","newest","oldest","title","id_asc","id_desc"}, default="id_asc")),
     *     @OA\Parameter(name="page", in="query", description="Page number", @OA\Schema(type="integer", example=1)),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Anime list retrieved",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Anime")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */

    /**
     * @OA\Get(
     *     path="/anime/search",
     *     tags={"Anime"},
     *     summary="Advanced anime search",
     *     description="Search anime with multiple filters",
     *     operationId="searchAnime",
     *
     *     @OA\Parameter(name="q", in="query", description="Search query", @OA\Schema(type="string")),
     *     @OA\Parameter(name="type", in="query", description="Anime type", @OA\Schema(type="string")),
     *     @OA\Parameter(name="status", in="query", description="Status", @OA\Schema(type="string")),
     *     @OA\Parameter(name="year_from", in="query", description="Year from", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="year_to", in="query", description="Year to", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="rating_min", in="query", description="Minimum rating", @OA\Schema(type="number", format="float")),
     *     @OA\Parameter(name="tag", in="query", description="Tag slug", @OA\Schema(type="string")),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Search results",
     *
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Anime")))
     *     )
     * )
     */

    /**
     * @OA\Get(
     *     path="/anime/{id}",
     *     tags={"Anime"},
     *     summary="Get anime details",
     *     description="Get detailed information about a specific anime",
     *     operationId="getAnimeById",
     *
     *     @OA\Parameter(name="id", in="path", required=true, description="Anime ID", @OA\Schema(type="integer")),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Anime details",
     *
     *         @OA\JsonContent(ref="#/components/schemas/AnimeDetailed")
     *     ),
     *
     *     @OA\Response(response=404, description="Anime not found")
     * )
     */

    /**
     * @OA\Get(
     *     path="/anime/{anime}/episodes",
     *     tags={"Episodes"},
     *     summary="Get anime episodes",
     *     description="Get all episodes for a specific anime",
     *     operationId="getAnimeEpisodes",
     *
     *     @OA\Parameter(name="anime", in="path", required=true, description="Anime ID", @OA\Schema(type="integer")),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Episodes list",
     *
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Episode")))
     *     )
     * )
     */

    /**
     * @OA\Get(
     *     path="/episodes/{episode}/player",
     *     tags={"Episodes"},
     *     summary="Get episode player URL",
     *     description="Get video player URL and episode information",
     *     operationId="getEpisodePlayer",
     *
     *     @OA\Parameter(name="episode", in="path", required=true, description="Episode ID", @OA\Schema(type="integer")),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Player information",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="player_url", type="string"),
     *             @OA\Property(property="player_iframe", type="string"),
     *             @OA\Property(property="episode_number", type="integer"),
     *             @OA\Property(property="translator", type="string"),
     *             @OA\Property(property="quality", type="string")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Episode not found or video not available")
     * )
     */

    /**
     * @OA\Get(
     *     path="/watch-history",
     *     tags={"Watch History"},
     *     summary="Get user watch history",
     *     description="Get paginated list of user's watch history",
     *     operationId="getWatchHistory",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Watch history retrieved",
     *
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/WatchHistory")))
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */

    /**
     * @OA\Post(
     *     path="/watch-history",
     *     tags={"Watch History"},
     *     summary="Add or update watch history",
     *     description="Track user's watch progress for an episode",
     *     operationId="addWatchHistory",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"anime_id","episode_id"},
     *
     *             @OA\Property(property="anime_id", type="integer", example=1),
     *             @OA\Property(property="episode_id", type="integer", example=78),
     *             @OA\Property(property="progress", type="integer", example=500, description="Progress in seconds"),
     *             @OA\Property(property="completed", type="boolean", example=false)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Watch history saved",
     *
     *         @OA\JsonContent(ref="#/components/schemas/WatchHistory")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */

    /**
     * @OA\Get(
     *     path="/favorites",
     *     tags={"Favorites"},
     *     summary="Get user favorites",
     *     description="Get list of user's favorite anime",
     *     operationId="getFavorites",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Favorites list",
     *
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Favorite")))
     *     )
     * )
     */

    /**
     * @OA\Post(
     *     path="/favorites",
     *     tags={"Favorites"},
     *     summary="Add anime to favorites",
     *     description="Add an anime to user's favorites",
     *     operationId="addFavorite",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"anime_id"},
     *
     *             @OA\Property(property="anime_id", type="integer", example=1)
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="Added to favorites", @OA\JsonContent(ref="#/components/schemas/Favorite")),
     *     @OA\Response(response=409, description="Already in favorites")
     * )
     */

    /**
     * @OA\Delete(
     *     path="/favorites/{anime_id}",
     *     tags={"Favorites"},
     *     summary="Remove from favorites",
     *     description="Remove anime from user's favorites",
     *     operationId="removeFavorite",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(name="anime_id", in="path", required=true, @OA\Schema(type="integer")),
     *
     *     @OA\Response(response=200, description="Removed from favorites")
     * )
     */

    /**
     * @OA\Get(
     *     path="/ratings",
     *     tags={"Ratings"},
     *     summary="Get user ratings",
     *     description="Get list of user's anime ratings",
     *     operationId="getRatings",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Ratings list",
     *
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Rating")))
     *     )
     * )
     */

    /**
     * @OA\Post(
     *     path="/ratings",
     *     tags={"Ratings"},
     *     summary="Rate an anime",
     *     description="Add or update rating for an anime (1.0 to 10.0)",
     *     operationId="rateAnime",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"anime_id","rating"},
     *
     *             @OA\Property(property="anime_id", type="integer", example=1),
     *             @OA\Property(property="rating", type="number", format="float", example=8.5, minimum=1, maximum=10)
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="Rating saved", @OA\JsonContent(ref="#/components/schemas/Rating"))
     * )
     */

    /**
     * @OA\Get(
     *     path="/comments",
     *     tags={"Comments"},
     *     summary="Get user comments",
     *     description="Get all comments made by authenticated user",
     *     operationId="getUserComments",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(response=200, description="Comments list")
     * )
     */

    /**
     * @OA\Post(
     *     path="/comments",
     *     tags={"Comments"},
     *     summary="Add comment",
     *     description="Add a comment to an anime",
     *     operationId="addComment",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"anime_id","comment"},
     *
     *             @OA\Property(property="anime_id", type="integer", example=1),
     *             @OA\Property(property="comment", type="string", example="Great anime!", minLength=3, maxLength=1000)
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="Comment added", @OA\JsonContent(ref="#/components/schemas/Comment"))
     * )
     */

    /**
     * @OA\Get(
     *     path="/user/profile/stats",
     *     tags={"User Profile"},
     *     summary="Get user statistics",
     *     description="Get comprehensive statistics about user activity",
     *     operationId="getUserStats",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="User statistics",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="watch_history", type="object"),
     *             @OA\Property(property="favorites", type="object"),
     *             @OA\Property(property="ratings", type="object"),
     *             @OA\Property(property="comments", type="object")
     *         )
     *     )
     * )
     */
}

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="john@example.com"),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="roles", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="created_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="Anime",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Cowboy Bebop"),
 *     @OA\Property(property="slug", type="string", example="cowboy-bebop"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="poster_url", type="string"),
 *     @OA\Property(property="rating", type="number", format="float", example=8.6),
 *     @OA\Property(property="year", type="integer", example=1998),
 *     @OA\Property(property="status", type="string", enum={"planned","ongoing","finished","paused"}),
 *     @OA\Property(property="type", type="string", enum={"tv","movie","ova","ona","special","music"}),
 *     @OA\Property(property="number_of_episodes", type="integer"),
 *     @OA\Property(property="nsfw_flag", type="boolean"),
 *     @OA\Property(property="popularity", type="integer"),
 *     @OA\Property(property="favorites", type="integer")
 * )
 *
 * @OA\Schema(
 *     schema="AnimeDetailed",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/Anime"),
 *         @OA\Schema(
 *
 *             @OA\Property(property="tags", type="array", @OA\Items(ref="#/components/schemas/Tag")),
 *             @OA\Property(property="viewed_count", type="integer"),
 *             @OA\Property(property="comments_count", type="integer"),
 *             @OA\Property(property="ratings_count", type="integer")
 *         )
 *     }
 * )
 *
 * @OA\Schema(
 *     schema="Episode",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=78),
 *     @OA\Property(property="anime_id", type="integer", example=1),
 *     @OA\Property(property="episode_number", type="integer", example=1),
 *     @OA\Property(property="season_number", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Asteroid Blues"),
 *     @OA\Property(property="player_url", type="string"),
 *     @OA\Property(property="translator", type="string", example="AniLibria"),
 *     @OA\Property(property="translation_type", type="string", enum={"voice","subtitles"}),
 *     @OA\Property(property="quality", type="string", example="720p"),
 *     @OA\Property(property="source", type="string", example="kodik")
 * )
 *
 * @OA\Schema(
 *     schema="WatchHistory",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="anime_id", type="integer"),
 *     @OA\Property(property="episode_id", type="integer"),
 *     @OA\Property(property="progress", type="integer", description="Progress in seconds"),
 *     @OA\Property(property="completed", type="boolean"),
 *     @OA\Property(property="watched_at", type="string", format="date-time"),
 *     @OA\Property(property="anime", ref="#/components/schemas/Anime"),
 *     @OA\Property(property="episode", ref="#/components/schemas/Episode")
 * )
 *
 * @OA\Schema(
 *     schema="Favorite",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="anime_id", type="integer"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="anime", ref="#/components/schemas/Anime")
 * )
 *
 * @OA\Schema(
 *     schema="Rating",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="anime_id", type="integer"),
 *     @OA\Property(property="rating", type="number", format="float", example=8.5),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="anime", ref="#/components/schemas/Anime")
 * )
 *
 * @OA\Schema(
 *     schema="Comment",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="anime_id", type="integer"),
 *     @OA\Property(property="comment", type="string"),
 *     @OA\Property(property="is_approved", type="boolean"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="user", ref="#/components/schemas/User"),
 *     @OA\Property(property="anime", ref="#/components/schemas/Anime")
 * )
 *
 * @OA\Schema(
 *     schema="Tag",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string", example="Action"),
 *     @OA\Property(property="slug", type="string", example="action")
 * )
 */
