<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Авторизация
 *
 * Регистрация, логин и управление сессиями.
 */
class AuthController extends Controller
{
    /**
     * Регистрация
     *
     * @bodyParam name string required Имя пользователя. Example: Ivan
     * @bodyParam email string required Email. Example: ivan@example.com
     * @bodyParam password string required Пароль (мин. 8 симв). Example: password123
     * @bodyParam password_confirmation string required Подтверждение пароля. Example: password123
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_active' => true,
        ]);

        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->roles()->attach($userRole->id);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $token,
                'user' => $user->load('roles'),
            ],
        ], 201);
    }

    /**
     * Логин
     *
     * @bodyParam email string required Email. Example: ivan@example.com
     * @bodyParam password string required Пароль. Example: password123
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные.'],
            ]);
        }

        if (! $user->is_active) {
            return response()->json(['message' => 'Аккаунт деактивирован.'], 403);
        }

        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $token,
                'user' => $user->load('roles'),
            ],
        ]);
    }

    /**
     * Текущий пользователь
     *
     * Возвращает данные авторизованного пользователя.
     * @authenticated
     */
    public function me(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()->load('roles'),
        ]);
    }

    /**
     * Выход
     *
     * Удаляет текущий токен доступа.
     * @authenticated
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => 'success']);
    }
}
