<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetCodeMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        $user->forceFill([
            'is_active' => true,
        ]);
        $user->save();

        $userRole = Role::query()->where('name', '=', 'user', 'and')->first();
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

        $user = User::query()->where('email', '=', $validated['email'], 'and')->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные.'],
            ]);
        }

        if (! $user->is_active) {
            return response()->json(['message' => 'Аккаунт деактивирован.'], 403);
        }

        $user->clearExpiredBan();

        if ($user->hasActiveBan()) {
            return response()->json([
                'message' => 'Аккаунт заблокирован.',
                'ban_reason' => $user->ban_reason,
                'ban_expires_at' => $user->ban_expires_at?->toISOString(),
            ], 403);
        }

        $user->forceFill([
            'is_online' => true,
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ])->save();

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
     *
     * @authenticated
     */
    public function me(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $user->clearExpiredBan();

        if ($user->hasActiveBan()) {
            $token = $user->currentAccessToken();
            if ($token !== null) {
                $user->tokens()->where('id', '=', $token->id, 'and')->delete();
            }

            return response()->json([
                'message' => 'Аккаунт заблокирован.',
                'ban_reason' => $user->ban_reason,
                'ban_expires_at' => $user->ban_expires_at?->toISOString(),
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user->load('roles'),
        ]);
    }

    /**
     * Выход
     *
     * Удаляет текущий токен доступа.
     *
     * @authenticated
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $token = $user->currentAccessToken();

        if ($token !== null) {
            $user->tokens()->where('id', '=', $token->id, 'and')->delete();
        }

        if ($user->tokens()->count() === 0) {
            $user->forceFill(['is_online' => false])->save();
        }

        return response()->json(['status' => 'success']);
    }

    private const RESET_CODE_TTL_MINUTES = 15;

    private const RESET_CODE_MAX_ATTEMPTS = 5;

    /**
     * Запрос кода для сброса пароля
     *
     * Отправляет 6-значный код на email пользователя. Ответ всегда успешный,
     * чтобы не раскрывать существование аккаунта.
     *
     * @bodyParam email string required Email. Example: ivan@example.com
     */
    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $email = mb_strtolower(trim($validated['email']));
        $user = User::query()->where('email', '=', $email, 'and')->first();

        if ($user) {
            $code = (string) random_int(100000, 999999);

            DB::table('password_reset_codes')->where('email', '=', $email)->delete();
            DB::table('password_reset_codes')->insert([
                'email' => $email,
                'code_hash' => Hash::make($code),
                'attempts' => 0,
                'expires_at' => now()->addMinutes(self::RESET_CODE_TTL_MINUTES),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            try {
                Mail::to($email)->send(new PasswordResetCodeMail($code, self::RESET_CODE_TTL_MINUTES));
            } catch (\Throwable $e) {
                Log::error('Не удалось отправить код сброса пароля', ['email' => $email, 'error' => $e->getMessage()]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Если аккаунт с таким email существует, код для сброса пароля отправлен.',
        ]);
    }

    /**
     * Проверка кода сброса пароля
     *
     * Проверяет валидность кода без его использования (для UX-шага).
     *
     * @bodyParam email string required Email. Example: ivan@example.com
     * @bodyParam code string required 6-значный код. Example: 123456
     */
    public function verifyResetCode(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'code' => 'required|string',
        ]);

        $this->ensureValidResetCode(mb_strtolower(trim($validated['email'])), $validated['code']);

        return response()->json([
            'status' => 'success',
            'message' => 'Код подтверждён.',
        ]);
    }

    /**
     * Сброс пароля по коду
     *
     * @bodyParam email string required Email. Example: ivan@example.com
     * @bodyParam code string required 6-значный код. Example: 123456
     * @bodyParam password string required Новый пароль (мин. 8 симв). Example: newpassword123
     * @bodyParam password_confirmation string required Подтверждение пароля. Example: newpassword123
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'code' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = mb_strtolower(trim($validated['email']));
        $record = $this->ensureValidResetCode($email, $validated['code']);

        $user = User::query()->where('email', '=', $email, 'and')->first();
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['Аккаунт не найден.'],
            ]);
        }

        $user->forceFill(['password' => Hash::make($validated['password'])])->save();

        // Удаляем код и завершаем все активные сессии для безопасности.
        DB::table('password_reset_codes')->where('id', '=', $record->id)->delete();
        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Пароль обновлён. Войдите с новым паролем.',
        ]);
    }

    /**
     * Проверяет код сброса и возвращает запись. Бросает ValidationException при ошибке.
     */
    private function ensureValidResetCode(string $email, string $code): object
    {
        $record = DB::table('password_reset_codes')
            ->where('email', '=', $email)
            ->orderByDesc('id')
            ->first();

        if (! $record) {
            throw ValidationException::withMessages([
                'code' => ['Код не найден. Запросите новый.'],
            ]);
        }

        if (Carbon::parse($record->expires_at)->isPast()) {
            DB::table('password_reset_codes')->where('id', '=', $record->id)->delete();
            throw ValidationException::withMessages([
                'code' => ['Срок действия кода истёк. Запросите новый.'],
            ]);
        }

        if ($record->attempts >= self::RESET_CODE_MAX_ATTEMPTS) {
            DB::table('password_reset_codes')->where('id', '=', $record->id)->delete();
            throw ValidationException::withMessages([
                'code' => ['Превышено число попыток. Запросите новый код.'],
            ]);
        }

        if (! Hash::check($code, $record->code_hash)) {
            DB::table('password_reset_codes')
                ->where('id', '=', $record->id)
                ->update(['attempts' => $record->attempts + 1, 'updated_at' => now()]);
            throw ValidationException::withMessages([
                'code' => ['Неверный код.'],
            ]);
        }

        return $record;
    }
}
