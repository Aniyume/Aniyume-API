<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __construct(private UserProfileService $profileService) {}

    public function getFullProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $profile = $this->profileService->getFullProfile($user);
        return response()->json($profile);
    }

    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'bio' => $user->bio,
            'custom_status' => $user->custom_status,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }

    public function update(UpdateUserProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $updated = $this->profileService->updateProfile($user, $request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => [
                'id' => $updated->id,
                'name' => $updated->name,
                'email' => $updated->email,
                'avatar' => $updated->avatar,
                'bio' => $updated->bio,
                'custom_status' => $updated->custom_status,
            ],
        ], 200);
    }

    public function uploadAvatar(Request $request): JsonResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

       if ($request->hasFile('avatar')) {
    $path = $request->file('avatar')->store('avatars', 'public');

    $user = $this->profileService->updateAvatar($request->user(), $path);

    return response()->json([
        'message' => 'Avatar uploaded successfully',
        'avatar' => $user->avatar,
    ], 200);
}
        return response()->json(['message' => 'No file provided'], 400);
    }
}
