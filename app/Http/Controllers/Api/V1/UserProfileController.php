<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Профиль пользователя
 *
 * @authenticated
 */
class UserProfileController extends Controller
{
    public function __construct(private UserProfileService $profileService) {}

    /**
     * Полный профиль (со статистикой)
     */
    public function getFullProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $profile = $this->profileService->getFullProfile($user);

        return response()->json($profile);
    }

    /**
     * Обновить профиль
     *
     * @bodyParam name string Имя. Example: Ivan
     * @bodyParam bio string О себе. Example: Люблю меха и сенены.
     * @bodyParam custom_status string Статус. Example: Смотрю One Piece
     */
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
                'is_premium' => (bool) $updated->is_premium,
            ],
        ], 200);
    }

    /**
     * Загрузить аватар
     *
     * @bodyParam avatar file required Изображение (jpg, png, webp).
     */
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
