<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="AniYume API",
 *     version="1.0.0",
 *     description="REST API for the AniYume user applications and Next.js admin panel."
 * )
 *
 * @OA\Server(
 *     url="/api/v1",
 *     description="Current AniYume backend"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="Sanctum or Clerk JWT"
 * )
 *
 * @OA\Tag(name="Public", description="Public catalog endpoints")
 * @OA\Tag(name="Authentication", description="User authentication")
 * @OA\Tag(name="Profile", description="Authenticated user profile")
 * @OA\Tag(name="Admin", description="Next.js admin panel API")
 *
 * @OA\Get(
 *     path="/public/anime",
 *     tags={"Public"},
 *     summary="List anime",
 *
 *     @OA\Parameter(name="page", in="query", @OA\Schema(type="integer", minimum=1)),
 *     @OA\Parameter(name="search", in="query", @OA\Schema(type="string")),
 *
 *     @OA\Response(response=200, description="Paginated anime list")
 * )
 *
 * @OA\Get(
 *     path="/public/anime/{anime}",
 *     tags={"Public"},
 *     summary="Get anime details",
 *
 *     @OA\Parameter(name="anime", in="path", required=true, @OA\Schema(type="integer")),
 *
 *     @OA\Response(response=200, description="Anime details"),
 *     @OA\Response(response=404, description="Anime not found")
 * )
 *
 * @OA\Get(
 *     path="/public/anime/{anime}/episodes",
 *     tags={"Public"},
 *     summary="List anime episodes",
 *
 *     @OA\Parameter(name="anime", in="path", required=true, @OA\Schema(type="integer")),
 *
 *     @OA\Response(response=200, description="Episode list")
 * )
 *
 * @OA\Get(
 *     path="/public/schedule",
 *     tags={"Public"},
 *     summary="Get release schedule",
 *
 *     @OA\Response(response=200, description="Weekly anime schedule")
 * )
 *
 * @OA\Get(
 *     path="/public/tags",
 *     tags={"Public"},
 *     summary="List tags",
 *
 *     @OA\Response(response=200, description="Anime tags")
 * )
 *
 * @OA\Post(
 *     path="/auth/register",
 *     tags={"Authentication"},
 *     summary="Register a user",
 *
 *     @OA\RequestBody(required=true, @OA\JsonContent(
 *         required={"name","email","password","password_confirmation"},
 *
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string", format="email"),
 *         @OA\Property(property="password", type="string", format="password"),
 *         @OA\Property(property="password_confirmation", type="string", format="password")
 *     )),
 *
 *     @OA\Response(response=201, description="User registered"),
 *     @OA\Response(response=422, description="Validation failed")
 * )
 *
 * @OA\Post(
 *     path="/auth/login",
 *     tags={"Authentication"},
 *     summary="Log in",
 *
 *     @OA\RequestBody(required=true, @OA\JsonContent(
 *         required={"email","password"},
 *
 *         @OA\Property(property="email", type="string", format="email"),
 *         @OA\Property(property="password", type="string", format="password")
 *     )),
 *
 *     @OA\Response(response=200, description="User and bearer token"),
 *     @OA\Response(response=422, description="Invalid credentials")
 * )
 *
 * @OA\Get(
 *     path="/profile/me",
 *     tags={"Profile"},
 *     summary="Get current user profile",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(response=200, description="Current user profile"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 *
 * @OA\Get(
 *     path="/admin/auth/me",
 *     tags={"Admin"},
 *     summary="Verify admin access",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(response=200, description="Current admin"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=403, description="Admin access required")
 * )
 *
 * @OA\Get(
 *     path="/admin/dashboard",
 *     tags={"Admin"},
 *     summary="Get admin dashboard",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(response=200, description="Dashboard metrics")
 * )
 *
 * @OA\Get(
 *     path="/admin/anime",
 *     tags={"Admin"},
 *     summary="List anime for administration",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(response=200, description="Paginated anime list")
 * )
 *
 * @OA\Get(
 *     path="/admin/users",
 *     tags={"Admin"},
 *     summary="List users",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(response=200, description="Paginated user list")
 * )
 *
 * @OA\Get(
 *     path="/admin/comments",
 *     tags={"Admin"},
 *     summary="List comments for moderation",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(response=200, description="Paginated comment list")
 * )
 */
class SwaggerDocumentationController extends Controller {}
