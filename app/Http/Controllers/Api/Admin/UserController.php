<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserResource;
use App\Models\AuditLog;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use BuildsPaginationMeta;

    private const PROFILE_FRAME_KEYS = [
        'none',
        'ramka1000people',
        'ramka1-10lvl',
        'ramka11-20lvl',
        'ramka21-30lvl',
        'ramka31-40lvl',
        'ramka41-50lvl',
        'ramka51-60lvl',
        'ramka61-70lvl',
        'ramka67',
        'ramka+5friend',
        'ramka+10friend',
        'ramka+25friend',
        'ramkaShark',
        'ramkaUborka',
    ];

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'search' => ['sometimes', 'string', 'max:255'],
            'role' => ['sometimes', 'string', 'max:80'],
            'banned' => ['sometimes', 'boolean'],
            'premium' => ['sometimes', 'boolean'],
            'online' => ['sometimes', 'boolean'],
            'sort' => ['sometimes', 'string', Rule::in(['created_at', 'updated_at', 'name', 'email', 'last_login_at'])],
            'direction' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
        ]);

        $query = User::query()
            ->with('roles')
            ->withCount(['comments', 'ratings', 'favorites'])
            ->when($validated['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('id', $search);
                });
            })
            ->when($validated['role'] ?? null, fn ($query, string $role) => $query->whereHas('roles', fn ($query) => $query->where('name', $role)))
            ->when(array_key_exists('banned', $validated), fn ($query) => $query->where('is_banned', $validated['banned']))
            ->when(array_key_exists('premium', $validated), fn ($query) => $query->where('is_premium', $validated['premium']))
            ->when(array_key_exists('online', $validated), fn ($query) => $query->where('is_online', $validated['online']));

        $query->orderBy($validated['sort'] ?? 'created_at', $validated['direction'] ?? 'desc');
        $paginator = $query->paginate($validated['per_page'] ?? 20)->withQueryString();

        return response()->json([
            'data' => AdminUserResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function show(Request $request, User $user): JsonResponse
    {
        $user->load('roles');
        $user->loadCount(['comments', 'ratings', 'favorites']);

        return response()->json([
            'data' => (new AdminUserResource($user))->resolve($request),
        ]);
    }

    public function ban(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:255'],
            'expires_at' => ['nullable', 'date', 'after:now'],
        ]);
        $before = $user->getOriginal();
        $user->update([
            'is_banned' => true,
            'is_online' => false,
            'ban_reason' => $validated['reason'],
            'ban_expires_at' => $validated['expires_at'] ?? null,
        ]);
        $user->tokens()->delete();

        $until = $user->ban_expires_at ? ' until '.$user->ban_expires_at->toISOString() : ' permanently';
        app(AuditService::class)->log($request, 'ban_user', "Banned user {$user->email}{$until}: {$validated['reason']}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function grantPremiumByNickname(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nickname' => ['required', 'string', 'max:255'],
        ]);

        $nickname = trim($validated['nickname']);
        $user = User::query()->where('name', $nickname)->first();
        abort_if(! $user, 404, 'Пользователь с таким ником не найден.');

        $before = $user->getOriginal();
        $user->update(['is_premium' => true]);
        app(AuditService::class)->log($request, 'grant_premium', "Granted premium to {$user->email} by nickname {$nickname}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function updatePremium(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'is_premium' => ['required', 'boolean'],
        ]);

        $before = $user->getOriginal();
        $user->update(['is_premium' => (bool) $validated['is_premium']]);
        $action = $user->is_premium ? 'grant_premium' : 'revoke_premium';
        app(AuditService::class)->log($request, $action, ucfirst(str_replace('_', ' ', $action))." for {$user->email}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function updateProfile(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user->id)],
            'custom_status' => ['nullable', 'string', 'max:100'],
            'selected_profile_frame' => ['nullable', 'string', Rule::in(self::PROFILE_FRAME_KEYS)],
        ]);

        if (array_key_exists('selected_profile_frame', $validated)) {
            $validated['selected_profile_frame'] = $validated['selected_profile_frame'] ?: 'none';
        }

        $before = $user->getOriginal();
        $user->update($validated);

        app(AuditService::class)->log($request, 'update_user_profile', "Updated profile fields for {$user->email}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function uploadAvatar(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $before = $user->getOriginal();
        $path = $validated['avatar']->store('avatars', 'public');
        $this->deleteStoredAvatar($user->avatar);
        $user->update(['avatar' => $path]);

        app(AuditService::class)->log($request, 'update_user_avatar', "Updated avatar for {$user->email}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function deleteAvatar(Request $request, User $user): JsonResponse
    {
        $before = $user->getOriginal();
        $this->deleteStoredAvatar($user->avatar);
        $user->update(['avatar' => null]);

        app(AuditService::class)->log($request, 'delete_user_avatar', "Deleted avatar for {$user->email}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function unban(Request $request, User $user): JsonResponse
    {
        $before = $user->getOriginal();
        $user->update(['is_banned' => false, 'ban_reason' => null, 'ban_expires_at' => null]);
        app(AuditService::class)->log($request, 'unban_user', "Unbanned user {$user->email}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function destroy(Request $request, User $user): JsonResponse
    {
        abort_if($request->user()?->id === $user->id, 422, 'You cannot delete your own admin account.');
        $email = $user->email;
        $user->delete();
        $this->audit($request, 'delete_user', "Deleted user {$email}");

        return response()->json(null, 204);
    }

    private function audit(Request $request, string $action, string $description): void
    {
        AuditLog::create([
            'user_id' => $request->user()?->id,
            'action' => $action,
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);
    }

    private function deleteStoredAvatar(?string $avatar): void
    {
        if (! $avatar || str_starts_with($avatar, 'http://') || str_starts_with($avatar, 'https://')) {
            return;
        }

        Storage::disk('public')->delete(ltrim(str_replace(['/api-storage/', 'api-storage/', '/storage/', 'storage/'], '', $avatar), '/'));
    }
}
