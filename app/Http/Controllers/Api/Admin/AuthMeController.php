<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthMeController extends Controller
{
    public function __invoke(Request $request): AdminUserResource|JsonResponse
    {
        if ($request->attributes->has('clerk_admin')) {
            return response()->json(['data' => $request->attributes->get('clerk_admin')]);
        }

        return new AdminUserResource($request->user()->loadMissing('roles'));
    }
}
