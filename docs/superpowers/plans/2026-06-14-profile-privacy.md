# Profile Privacy Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Дать пользователю настройку приватности для трёх разделов профиля (избранное, история просмотров, оценки) с уровнями `everyone | friends | nobody` и эндпоинты, через которые друзья/все видят эти списки на чужом профиле.

**Architecture:** Три строковые колонки в `users` хранят уровень видимости каждого раздела (дефолт `friends`). Единый `ProfileVisibilityService::canView()` решает, может ли зритель видеть раздел владельца. Контроллеры списков (favorites / watch-history / ratings) получают gated-методы по `userId`, профильный эндпоинт обогащается блоком `visibility`. Настройками управляет пара `GET/PUT /profile/me/privacy`.

**Tech Stack:** Laravel (PHP 8.x), Sanctum auth, PHPUnit + RefreshDatabase, SQLite in-memory для тестов.

**Спека:** `docs/superpowers/specs/2026-06-14-profile-privacy-design.md`

---

## File Structure

- Create: `app/Enums/ProfileVisibility.php` — enum трёх уровней + хелпер маппинга секции на колонку.
- Create: `database/migrations/XXXX_XX_XX_XXXXXX_add_privacy_columns_to_users_table.php` — три колонки.
- Modify: `app/Models/User.php` — добавить три поля в `$fillable`.
- Create: `app/Services/ProfileVisibilityService.php` — единая авторизация видимости.
- Modify: `app/Http/Controllers/Api/V1/UserProfileController.php` — `getPrivacy`, `updatePrivacy`.
- Modify: `app/Http/Controllers/Api/V1/FavoritesController.php` — общий билдер + `userFavorites`.
- Modify: `app/Http/Controllers/Api/V1/WatchHistoryController.php` — `userHistory`.
- Modify: `app/Http/Controllers/Api/V1/RatingsController.php` — `userRatings`.
- Modify: `app/Http/Controllers/Api/V1/FriendshipController.php` — блок `visibility` в `profile`.
- Modify: `routes/api.php` — 5 новых маршрутов в private-группе.
- Create tests: `tests/Unit/ProfileVisibilityServiceTest.php`, `tests/Feature/Api/ProfilePrivacyApiTest.php`.

Конвенция секций (строки): `favorites`, `watch_history`, `ratings`.

---

## Task 1: Enum, миграция, поля модели

**Files:**
- Create: `app/Enums/ProfileVisibility.php`
- Create: `database/migrations/2026_06_14_100000_add_privacy_columns_to_users_table.php`
- Modify: `app/Models/User.php`
- Test: `tests/Feature/Api/ProfilePrivacyApiTest.php`

- [ ] **Step 1: Создать enum**

`app/Enums/ProfileVisibility.php`:

```php
<?php

namespace App\Enums;

enum ProfileVisibility: string
{
    case Everyone = 'everyone';
    case Friends = 'friends';
    case Nobody = 'nobody';

    /** Секции профиля → колонка в users. */
    public const SECTIONS = [
        'favorites' => 'privacy_favorites',
        'watch_history' => 'privacy_watch_history',
        'ratings' => 'privacy_ratings',
    ];

    public static function values(): array
    {
        return array_map(fn (self $c) => $c->value, self::cases());
    }
}
```

- [ ] **Step 2: Создать миграцию**

`database/migrations/2026_06_14_100000_add_privacy_columns_to_users_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('privacy_favorites')->default('friends');
            $table->string('privacy_watch_history')->default('friends');
            $table->string('privacy_ratings')->default('friends');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['privacy_favorites', 'privacy_watch_history', 'privacy_ratings']);
        });
    }
};
```

- [ ] **Step 3: Добавить поля в `$fillable` модели User**

В `app/Models/User.php` в массив `$fillable` добавить три строки после `'theme_type',`:

```php
        'theme_type',
        'privacy_favorites',
        'privacy_watch_history',
        'privacy_ratings',
```

- [ ] **Step 4: Написать падающий тест на дефолты**

Создать `tests/Feature/Api/ProfilePrivacyApiTest.php`:

```php
<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilePrivacyApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_user_defaults_to_friends_visibility(): void
    {
        $user = User::factory()->create();

        $this->assertSame('friends', $user->privacy_favorites);
        $this->assertSame('friends', $user->privacy_watch_history);
        $this->assertSame('friends', $user->privacy_ratings);
    }
}
```

- [ ] **Step 5: Запустить тест — должен пройти после миграции**

Run: `php artisan test --filter=test_new_user_defaults_to_friends_visibility`
Expected: PASS (RefreshDatabase прогоняет новую миграцию, дефолты применяются).

- [ ] **Step 6: Commit**

```bash
git add app/Enums/ProfileVisibility.php database/migrations/2026_06_14_100000_add_privacy_columns_to_users_table.php app/Models/User.php tests/Feature/Api/ProfilePrivacyApiTest.php
git commit -m "feat: add profile privacy columns and ProfileVisibility enum"
```

---

## Task 2: ProfileVisibilityService

**Files:**
- Create: `app/Services/ProfileVisibilityService.php`
- Test: `tests/Unit/ProfileVisibilityServiceTest.php`

- [ ] **Step 1: Написать падающий тест матрицы доступа**

`tests/Unit/ProfileVisibilityServiceTest.php`:

```php
<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\ProfileVisibilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProfileVisibilityServiceTest extends TestCase
{
    use RefreshDatabase;

    private function makeFriends(User $a, User $b): void
    {
        DB::table('friendships')->insert([
            'user_id' => $a->id,
            'friend_id' => $b->id,
            'status' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_owner_always_sees_own_section(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'nobody']);
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($owner, $owner, 'favorites'));
    }

    public function test_everyone_level_visible_to_stranger_and_guest(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'everyone']);
        $stranger = User::factory()->create();
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($stranger, $owner, 'favorites'));
        $this->assertTrue($service->canView(null, $owner, 'favorites'));
    }

    public function test_friends_level_visible_only_to_friends(): void
    {
        $owner = User::factory()->create(['privacy_ratings' => 'friends']);
        $friend = User::factory()->create();
        $stranger = User::factory()->create();
        $this->makeFriends($owner, $friend);
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($friend, $owner, 'ratings'));
        $this->assertFalse($service->canView($stranger, $owner, 'ratings'));
        $this->assertFalse($service->canView(null, $owner, 'ratings'));
    }

    public function test_nobody_level_hidden_from_everyone_but_owner(): void
    {
        $owner = User::factory()->create(['privacy_watch_history' => 'nobody']);
        $friend = User::factory()->create();
        $this->makeFriends($owner, $friend);
        $service = app(ProfileVisibilityService::class);

        $this->assertFalse($service->canView($friend, $owner, 'watch_history'));
    }

    public function test_friendship_is_detected_in_either_direction(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'friends']);
        $friend = User::factory()->create();
        // friend инициатор: friend_id = owner
        DB::table('friendships')->insert([
            'user_id' => $friend->id,
            'friend_id' => $owner->id,
            'status' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $service = app(ProfileVisibilityService::class);

        $this->assertTrue($service->canView($friend, $owner, 'favorites'));
    }
}
```

- [ ] **Step 2: Запустить — упадёт (класс не найден)**

Run: `php artisan test --filter=ProfileVisibilityServiceTest`
Expected: FAIL — `Class "App\Services\ProfileVisibilityService" not found`.

- [ ] **Step 3: Реализовать сервис**

`app/Services/ProfileVisibilityService.php`:

```php
<?php

namespace App\Services;

use App\Enums\ProfileVisibility;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileVisibilityService
{
    /**
     * Может ли $viewer видеть раздел $section профиля $owner.
     * $section: favorites | watch_history | ratings.
     */
    public function canView(?User $viewer, User $owner, string $section): bool
    {
        if ($viewer !== null && $viewer->id === $owner->id) {
            return true;
        }

        $column = ProfileVisibility::SECTIONS[$section] ?? null;
        if ($column === null) {
            return false;
        }

        $level = $owner->{$column} ?? ProfileVisibility::Friends->value;

        return match ($level) {
            ProfileVisibility::Everyone->value => true,
            ProfileVisibility::Friends->value => $viewer !== null && $this->areFriends($viewer->id, $owner->id),
            default => false, // nobody и любое неизвестное значение
        };
    }

    private function areFriends(int $a, int $b): bool
    {
        return DB::table('friendships')
            ->where('status', 'accepted')
            ->where(function ($q) use ($a, $b) {
                $q->where(function ($qq) use ($a, $b) {
                    $qq->where('user_id', $a)->where('friend_id', $b);
                })->orWhere(function ($qq) use ($a, $b) {
                    $qq->where('user_id', $b)->where('friend_id', $a);
                });
            })
            ->exists();
    }
}
```

- [ ] **Step 4: Запустить — должен пройти**

Run: `php artisan test --filter=ProfileVisibilityServiceTest`
Expected: PASS (5 тестов).

- [ ] **Step 5: Commit**

```bash
git add app/Services/ProfileVisibilityService.php tests/Unit/ProfileVisibilityServiceTest.php
git commit -m "feat: add ProfileVisibilityService with section access matrix"
```

---

## Task 3: Эндпоинты настроек приватности (GET/PUT /profile/me/privacy)

**Files:**
- Modify: `app/Http/Controllers/Api/V1/UserProfileController.php`
- Modify: `routes/api.php`
- Test: `tests/Feature/Api/ProfilePrivacyApiTest.php`

- [ ] **Step 1: Написать падающие тесты**

Добавить методы в `tests/Feature/Api/ProfilePrivacyApiTest.php` (внутри класса):

```php
    public function test_get_privacy_returns_current_settings(): void
    {
        $user = User::factory()->create([
            'privacy_favorites' => 'everyone',
            'privacy_watch_history' => 'friends',
            'privacy_ratings' => 'nobody',
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/profile/me/privacy')
            ->assertOk()
            ->assertJson([
                'favorites' => 'everyone',
                'watch_history' => 'friends',
                'ratings' => 'nobody',
            ]);
    }

    public function test_update_privacy_persists_values(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me/privacy', [
                'favorites' => 'everyone',
                'watch_history' => 'nobody',
                'ratings' => 'friends',
            ])
            ->assertOk()
            ->assertJson([
                'favorites' => 'everyone',
                'watch_history' => 'nobody',
                'ratings' => 'friends',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'privacy_favorites' => 'everyone',
            'privacy_watch_history' => 'nobody',
            'privacy_ratings' => 'friends',
        ]);
    }

    public function test_update_privacy_rejects_invalid_value(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/profile/me/privacy', [
                'favorites' => 'public',
                'watch_history' => 'friends',
                'ratings' => 'friends',
            ])
            ->assertStatus(422);
    }

    public function test_privacy_endpoints_require_authentication(): void
    {
        $this->getJson('/api/v1/profile/me/privacy')->assertUnauthorized();
        $this->putJson('/api/v1/profile/me/privacy', [])->assertUnauthorized();
    }
```

- [ ] **Step 2: Запустить — упадёт (404/маршрута нет)**

Run: `php artisan test --filter=test_get_privacy_returns_current_settings`
Expected: FAIL (маршрут не определён).

- [ ] **Step 3: Добавить методы в контроллер**

В `app/Http/Controllers/Api/V1/UserProfileController.php` добавить `use App\Enums\ProfileVisibility;` в начало (рядом с другими `use`), и два метода в класс:

```php
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
```

(`Rule` уже импортирован в этом контроллере — `use Illuminate\Validation\Rule;`.)

- [ ] **Step 4: Добавить маршруты**

В `routes/api.php`, в private-группе (`auth:sanctum`,`not_banned`), рядом с другими `profile/me`-маршрутами (после строки `Route::post('/profile/me/frames/select', ...)`), добавить:

```php
        Route::get('/profile/me/privacy', [UserProfileController::class, 'getPrivacy']);
        Route::put('/profile/me/privacy', [UserProfileController::class, 'updatePrivacy']);
```

- [ ] **Step 5: Запустить тесты раздела**

Run: `php artisan test --filter=ProfilePrivacyApiTest`
Expected: PASS (включая тесты дефолтов из Task 1 и 4 новых).

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Api/V1/UserProfileController.php routes/api.php tests/Feature/Api/ProfilePrivacyApiTest.php
git commit -m "feat: add GET/PUT /profile/me/privacy endpoints"
```

---

## Task 4: Gated список избранного `/users/{userId}/favorites`

**Files:**
- Modify: `app/Http/Controllers/Api/V1/FavoritesController.php`
- Modify: `routes/api.php`
- Test: `tests/Feature/Api/ProfilePrivacyApiTest.php`

- [ ] **Step 1: Написать падающие тесты**

Добавить в `tests/Feature/Api/ProfilePrivacyApiTest.php`. Сначала добавить импорты в начало файла:

```php
use App\Models\Anime;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
```

И приватный хелпер + тесты в класс:

```php
    private function befriend(User $a, User $b): void
    {
        DB::table('friendships')->insert([
            'user_id' => $a->id,
            'friend_id' => $b->id,
            'status' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_friend_can_view_favorites_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'friends']);
        $friend = User::factory()->create();
        $this->befriend($owner, $friend);
        $anime = Anime::factory()->create();
        Favorite::create(['user_id' => $owner->id, 'anime_id' => $anime->id]);

        $this->actingAs($friend, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/favorites")
            ->assertOk()
            ->assertJsonPath('data.0.anime_id', $anime->id);
    }

    public function test_stranger_blocked_from_favorites_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'friends']);
        $stranger = User::factory()->create();

        $this->actingAs($stranger, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/favorites")
            ->assertForbidden()
            ->assertJsonPath('reason', 'private');
    }

    public function test_anyone_views_favorites_when_level_everyone(): void
    {
        $owner = User::factory()->create(['privacy_favorites' => 'everyone']);
        $stranger = User::factory()->create();

        $this->actingAs($stranger, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/favorites")
            ->assertOk();
    }
```

- [ ] **Step 2: Запустить — упадёт (маршрута нет)**

Run: `php artisan test --filter=test_friend_can_view_favorites_when_level_friends`
Expected: FAIL (404).

- [ ] **Step 3: Рефакторинг + новый метод в FavoritesController**

В `app/Http/Controllers/Api/V1/FavoritesController.php` добавить импорты в начало:

```php
use App\Models\User;
use App\Services\ProfileVisibilityService;
```

Заменить тело метода `index` на вызов общего билдера и добавить два метода. Итоговый `index`:

```php
    public function index(Request $request): JsonResponse
    {
        return $this->paginatedFavorites(
            $request->user()->id,
            (int) $request->get('per_page', 20)
        );
    }
```

Добавить gated-метод и общий приватный билдер:

```php
    public function userFavorites(Request $request, int $userId, ProfileVisibilityService $visibility): JsonResponse
    {
        $owner = User::findOrFail($userId);

        if (! $visibility->canView($request->user(), $owner, 'favorites')) {
            return response()->json([
                'message' => 'This list is private.',
                'reason' => 'private',
            ], 403);
        }

        return $this->paginatedFavorites($owner->id, (int) $request->get('per_page', 20));
    }

    private function paginatedFavorites(int $userId, int $perPage): JsonResponse
    {
        $favorites = Favorite::query()
            ->where('user_id', $userId)
            ->with(['anime:id,title,slug,poster_url'])
            ->paginate($perPage);

        $data = $favorites->map(function (Favorite $favorite) {
            return [
                'id' => $favorite->id,
                'anime_id' => $favorite->anime_id,
                'title' => $favorite->anime?->title,
                'slug' => $favorite->anime?->slug,
                'poster_url' => $favorite->anime?->poster_url,
                'created_at' => $favorite->created_at,
            ];
        })->values();

        return response()->json([
            'data' => $data,
            'pagination' => [
                'total' => $favorites->total(),
                'per_page' => $favorites->perPage(),
                'current_page' => $favorites->currentPage(),
                'last_page' => $favorites->lastPage(),
            ],
        ]);
    }
```

- [ ] **Step 4: Добавить маршрут**

В `routes/api.php`, рядом с `Route::get('/users/{userId}/profile', ...)`, добавить:

```php
        Route::get('/users/{userId}/favorites', [FavoritesController::class, 'userFavorites'])
            ->where('userId', '[0-9]+');
```

- [ ] **Step 5: Запустить тесты**

Run: `php artisan test --filter=ProfilePrivacyApiTest`
Expected: PASS.

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Api/V1/FavoritesController.php routes/api.php tests/Feature/Api/ProfilePrivacyApiTest.php
git commit -m "feat: add gated GET /users/{id}/favorites endpoint"
```

---

## Task 5: Gated история просмотров `/users/{userId}/watch-history`

**Files:**
- Modify: `app/Http/Controllers/Api/V1/WatchHistoryController.php`
- Modify: `routes/api.php`
- Test: `tests/Feature/Api/ProfilePrivacyApiTest.php`

- [ ] **Step 1: Написать падающие тесты**

Добавить в `tests/Feature/Api/ProfilePrivacyApiTest.php` импорт:

```php
use App\Models\WatchHistory;
```

И тесты в класс:

```php
    public function test_friend_can_view_watch_history_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_watch_history' => 'friends']);
        $friend = User::factory()->create();
        $this->befriend($owner, $friend);
        $anime = Anime::factory()->create();
        WatchHistory::create([
            'user_id' => $owner->id,
            'anime_id' => $anime->id,
            'watch_time' => 100,
            'watched_at' => now(),
        ]);

        $this->actingAs($friend, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/watch-history")
            ->assertOk()
            ->assertJsonStructure(['data', 'pagination']);
    }

    public function test_stranger_blocked_from_watch_history_when_nobody(): void
    {
        $owner = User::factory()->create(['privacy_watch_history' => 'nobody']);
        $friend = User::factory()->create();
        $this->befriend($owner, $friend);

        $this->actingAs($friend, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/watch-history")
            ->assertForbidden()
            ->assertJsonPath('reason', 'private');
    }
```

- [ ] **Step 2: Запустить — упадёт (404)**

Run: `php artisan test --filter=test_friend_can_view_watch_history_when_level_friends`
Expected: FAIL.

- [ ] **Step 3: Добавить gated-метод в WatchHistoryController**

В `app/Http/Controllers/Api/V1/WatchHistoryController.php` добавить импорты:

```php
use App\Models\User;
use App\Services\ProfileVisibilityService;
```

Добавить метод (переиспользует уже инжектированный `$this->watchHistoryQuery`):

```php
    public function userHistory(Request $request, int $userId, ProfileVisibilityService $visibility): JsonResponse
    {
        $owner = User::findOrFail($userId);

        if (! $visibility->canView($request->user(), $owner, 'watch_history')) {
            return response()->json([
                'message' => 'This list is private.',
                'reason' => 'private',
            ], 403);
        }

        $history = $this->watchHistoryQuery->paginatedForUser($owner->id);

        return response()->json([
            'data' => $history->items(),
            'pagination' => [
                'total' => $history->total(),
                'per_page' => $history->perPage(),
                'current_page' => $history->currentPage(),
                'last_page' => $history->lastPage(),
            ],
        ]);
    }
```

- [ ] **Step 4: Добавить маршрут**

В `routes/api.php`, рядом с `/users/{userId}/favorites`, добавить:

```php
        Route::get('/users/{userId}/watch-history', [WatchHistoryController::class, 'userHistory'])
            ->where('userId', '[0-9]+');
```

- [ ] **Step 5: Запустить тесты**

Run: `php artisan test --filter=ProfilePrivacyApiTest`
Expected: PASS.

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Api/V1/WatchHistoryController.php routes/api.php tests/Feature/Api/ProfilePrivacyApiTest.php
git commit -m "feat: add gated GET /users/{id}/watch-history endpoint"
```

---

## Task 6: Gated оценки `/users/{userId}/ratings`

**Files:**
- Modify: `app/Http/Controllers/Api/V1/RatingsController.php`
- Modify: `routes/api.php`
- Test: `tests/Feature/Api/ProfilePrivacyApiTest.php`

- [ ] **Step 1: Написать падающие тесты**

Добавить в `tests/Feature/Api/ProfilePrivacyApiTest.php` импорт:

```php
use App\Models\Rating;
```

И тесты:

```php
    public function test_friend_can_view_ratings_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_ratings' => 'friends']);
        $friend = User::factory()->create();
        $this->befriend($owner, $friend);
        $anime = Anime::factory()->create();
        Rating::create(['user_id' => $owner->id, 'anime_id' => $anime->id, 'rating' => 4.5]);

        $this->actingAs($friend, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/ratings")
            ->assertOk()
            ->assertJsonStructure(['data', 'pagination']);
    }

    public function test_stranger_blocked_from_ratings_when_level_friends(): void
    {
        $owner = User::factory()->create(['privacy_ratings' => 'friends']);
        $stranger = User::factory()->create();

        $this->actingAs($stranger, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/ratings")
            ->assertForbidden()
            ->assertJsonPath('reason', 'private');
    }
```

- [ ] **Step 2: Запустить — упадёт (404)**

Run: `php artisan test --filter=test_friend_can_view_ratings_when_level_friends`
Expected: FAIL.

- [ ] **Step 3: Добавить gated-метод в RatingsController**

В `app/Http/Controllers/Api/V1/RatingsController.php` добавить импорты:

```php
use App\Models\User;
use App\Services\ProfileVisibilityService;
```

Добавить метод:

```php
    public function userRatings(Request $request, int $userId, ProfileVisibilityService $visibility): JsonResponse
    {
        $owner = User::findOrFail($userId);

        if (! $visibility->canView($request->user(), $owner, 'ratings')) {
            return response()->json([
                'message' => 'This list is private.',
                'reason' => 'private',
            ], 403);
        }

        $ratings = Rating::with('anime')
            ->where('user_id', $owner->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return response()->json([
            'data' => RatingResource::collection($ratings),
            'pagination' => [
                'total' => $ratings->total(),
                'per_page' => $ratings->perPage(),
                'current_page' => $ratings->currentPage(),
                'last_page' => $ratings->lastPage(),
            ],
        ]);
    }
```

(`Rating` и `RatingResource` уже импортированы в этом контроллере.)

- [ ] **Step 4: Добавить маршрут**

В `routes/api.php`, рядом с `/users/{userId}/watch-history`, добавить:

```php
        Route::get('/users/{userId}/ratings', [RatingsController::class, 'userRatings'])
            ->where('userId', '[0-9]+');
```

- [ ] **Step 5: Запустить тесты**

Run: `php artisan test --filter=ProfilePrivacyApiTest`
Expected: PASS.

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Api/V1/RatingsController.php routes/api.php tests/Feature/Api/ProfilePrivacyApiTest.php
git commit -m "feat: add gated GET /users/{id}/ratings endpoint"
```

---

## Task 7: Блок `visibility` в карточке профиля

**Files:**
- Modify: `app/Http/Controllers/Api/V1/FriendshipController.php`
- Test: `tests/Feature/Api/ProfilePrivacyApiTest.php`

- [ ] **Step 1: Написать падающий тест**

Добавить в `tests/Feature/Api/ProfilePrivacyApiTest.php`:

```php
    public function test_profile_includes_visibility_for_viewer(): void
    {
        $owner = User::factory()->create([
            'privacy_favorites' => 'everyone',
            'privacy_watch_history' => 'friends',
            'privacy_ratings' => 'nobody',
        ]);
        $stranger = User::factory()->create();

        $this->actingAs($stranger, 'sanctum')
            ->getJson("/api/v1/users/{$owner->id}/profile")
            ->assertOk()
            ->assertJsonPath('visibility.favorites', 'visible')   // everyone
            ->assertJsonPath('visibility.watch_history', 'hidden') // friends, не друг
            ->assertJsonPath('visibility.ratings', 'hidden');      // nobody
    }
```

- [ ] **Step 2: Запустить — упадёт (нет ключа visibility)**

Run: `php artisan test --filter=test_profile_includes_visibility_for_viewer`
Expected: FAIL (path `visibility.favorites` отсутствует).

- [ ] **Step 3: Дополнить метод profile**

В `app/Http/Controllers/Api/V1/FriendshipController.php` добавить импорт:

```php
use App\Services\ProfileVisibilityService;
```

В методе `profile`, перед `return response()->json($profile);`, добавить:

```php
        $visibility = app(ProfileVisibilityService::class);
        $viewer = $request->user();
        $profile['visibility'] = [
            'favorites' => $visibility->canView($viewer, $target, 'favorites') ? 'visible' : 'hidden',
            'watch_history' => $visibility->canView($viewer, $target, 'watch_history') ? 'visible' : 'hidden',
            'ratings' => $visibility->canView($viewer, $target, 'ratings') ? 'visible' : 'hidden',
        ];
```

- [ ] **Step 4: Запустить тест**

Run: `php artisan test --filter=test_profile_includes_visibility_for_viewer`
Expected: PASS.

- [ ] **Step 5: Прогнать весь набор приватности + соседние**

Run: `php artisan test --filter=ProfilePrivacy && php artisan test --filter=Favorites && php artisan test --filter=Ratings && php artisan test --filter=Friendship`
Expected: PASS (новые эндпоинты не сломали существующие self-эндпоинты).

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Api/V1/FriendshipController.php tests/Feature/Api/ProfilePrivacyApiTest.php
git commit -m "feat: include per-section visibility in user profile response"
```

---

## Финальная проверка

- [ ] **Прогнать полный тест-сьют**

Run: `php artisan test`
Expected: всё зелёное.

- [ ] При необходимости обновить генерируемую API-документацию (Scribe), если в проекте есть `php artisan scribe:generate` — проверить, что новые маршруты не ломают сборку.
