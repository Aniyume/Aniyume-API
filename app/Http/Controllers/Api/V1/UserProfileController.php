<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Services\ProfileFrames\ProfileFrameService;
use App\Enums\ProfileVisibility;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Services\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
                'custom_status' => $updated->custom_status,
                'social_links' => $updated->social_links ?? [],
                'is_premium' => (bool) $updated->is_premium,
            ],
        ], 200);
    }

    public function updateAccount(Request $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'confirmed'],
        ]);

        if (! array_key_exists('email', $validated) && ! array_key_exists('password', $validated)) {
            throw ValidationException::withMessages([
                'account' => ['Укажите новый email или пароль.'],
            ]);
        }

        if (! Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Текущий пароль указан неверно.'],
            ]);
        }

        if (array_key_exists('email', $validated)) {
            $user->email = mb_strtolower(trim($validated['email']));
            $user->email_verified_at = null;
        }

        if (array_key_exists('password', $validated)) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        if (array_key_exists('password', $validated)) {
            $currentTokenId = $user->currentAccessToken()?->id;
            $user->tokens()
                ->when($currentTokenId, fn ($query) => $query->whereKeyNot($currentTokenId))
                ->delete();
        }

        return response()->json([
            'message' => 'Данные аккаунта обновлены.',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
            ],
        ]);
    }

    public function nameAvailability(Request $request): JsonResponse
    {
        $validated = $request->validate(['name' => ['required', 'string', 'min:2', 'max:255']]);
        $name = trim($validated['name']);
        $query = User::query()->whereRaw('LOWER(name) = ?', [mb_strtolower($name)]);
        if ($request->user()) {
            $query->whereKeyNot($request->user()->id);
        }
        $available = ! $query->exists();
        $suggestions = [];

        if (! $available) {
            $suggestionBase = mb_substr($name, 0, 250);
            foreach (range(1, 20) as $attempt) {
                $candidate = $suggestionBase.random_int(10, 9999);
                if (! User::query()->whereRaw('LOWER(name) = ?', [mb_strtolower($candidate)])->exists()) {
                    $suggestions[] = $candidate;
                }
                if (count($suggestions) === 3) {
                    break;
                }
            }
        }

        return response()->json(['available' => $available, 'suggestions' => $suggestions]);
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

    public function frames(Request $request, ProfileFrameService $frames): JsonResponse
    {
        return response()->json([
            'data' => $frames->framesFor($request->user()),
            'selected' => $request->user()->selected_profile_frame ?: 'none',
        ]);
    }

    public function selectFrame(Request $request, ProfileFrameService $frames): JsonResponse
    {
        $validated = $request->validate([
            'frame_key' => ['required', 'string', 'max:80'],
        ]);

        abort_unless($frames->canUserSelect($request->user(), $validated['frame_key']), 422, 'Frame is locked.');

        $request->user()->update(['selected_profile_frame' => $validated['frame_key']]);

        return response()->json([
            'message' => 'Frame selected.',
            'selected' => $validated['frame_key'],
            'data' => $frames->framesFor($request->user()->fresh()),
        ]);
    }

    public function getPrivacy(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'favorites' => $user->privacy_favorites,
            'watch_history' => $user->privacy_watch_history,
            'ratings' => $user->privacy_ratings,
        ]);
    }

    public function updatePrivacy(Request $request): JsonResponse
    {
        $rule = ['required', Rule::in(ProfileVisibility::values())];
        $validated = $request->validate([
            'favorites' => $rule,
            'watch_history' => $rule,
            'ratings' => $rule,
        ]);

        $user = $request->user();
        $user->update([
            'privacy_favorites' => $validated['favorites'],
            'privacy_watch_history' => $validated['watch_history'],
            'privacy_ratings' => $validated['ratings'],
        ]);

        return response()->json([
            'favorites' => $user->privacy_favorites,
            'watch_history' => $user->privacy_watch_history,
            'ratings' => $user->privacy_ratings,
        ]);
    }
}
