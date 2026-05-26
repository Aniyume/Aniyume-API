<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserResource;
use Illuminate\Http\Request;

class AuthMeController extends Controller
{
    public function __invoke(Request $request): AdminUserResource
    {
        return new AdminUserResource($request->user()->loadMissing('roles'));
    }
}
