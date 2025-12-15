<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="AniYume API",
 *     version="1.0.0",
 *     description="REST API for AniYume - Anime Streaming Platform",
 *     @OA\Contact(
 *         email="support@aniyume.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://127.0.0.1:8000/api/v1",
 *     description="Development Server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter token in format: Bearer {your-token}"
 * )
 */
class SwaggerController extends Controller
{
    //
}
