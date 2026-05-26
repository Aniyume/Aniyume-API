<div align="center">

<img src="https://github.com/user-attachments/assets/d7779d05-b096-4ffc-b7e5-830fdd0c62c6" width="450" alt="AniYume Logo" />

# AniYume Backend

**Laravel backend для AniYume: JSON API + текущая Blade-admin панель**

[![Laravel](https://img.shields.io/badge/Laravel_12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)](https://postgresql.org)

</div>

---

## Содержание

- [Текущий статус](#текущий-статус)
- [Целевая архитектура](#целевая-архитектура)
- [Реальная структура backend](#реальная-структура-backend)
- [Ключевые модули](#ключевые-модули)
- [Технологический стек](#технологический-стек)
- [Установка и запуск](#установка-и-запуск)
- [Проверки и полезные команды](#проверки-и-полезные-команды)
- [Endpoint baseline](#endpoint-baseline)
- [Документация](#документация)
- [Deployment notes](#deployment-notes)

---

## Текущий статус

`aniyume-backend` сейчас является **смешанным Laravel-приложением**:

- предоставляет JSON API под `/api/v1` для пользовательского frontend;
- содержит встроенную Blade-admin панель под `/admin/*`;
- использует Laravel Sanctum для API-auth;
- содержит realtime/broadcast маршруты для Watch Party;
- содержит сервисы импорта и внешних интеграций.

Важно: проект пока **не является чистым API-only backend**. В нём одновременно живут API-слой, web/admin routes, Blade views и часть бизнес-логики внутри контроллеров.

---

## Целевая архитектура

Planned target state:

- `aniyume-backend` — API-only Laravel backend;
- отдельный Next.js admin client вместо встроенной Blade-admin панели;
- admin работает с backend через JSON API;
- legacy `/admin/*` web routes удаляются только после достижения functional parity с новым admin client.

До завершения миграции Blade-admin считается legacy, но поддерживаемым слоем: его нельзя удалять или ломать без замены на API + Next admin.

---

## Реальная структура backend

Основные директории, которые сейчас используются:

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/V1/        # пользовательский JSON API
│   │   └── Admin/         # текущая Blade-admin панель
│   ├── Requests/          # Form Request validation
│   ├── Resources/         # API Resources
│   └── Middleware/        # auth/admin/security boundaries
├── Models/                # Eloquent models
├── Services/              # часть бизнес-логики и внешние интеграции
├── Events/                # realtime events для Watch Party
└── Jobs/                  # import/background jobs

routes/
├── api.php                # /api/v1 endpoints
├── web.php                # /admin/* Blade-admin и web fallbacks
└── channels.php           # broadcast channels

resources/views/admin/     # Blade-admin UI
```

Архитектура находится в переходном состоянии. Часть логики уже вынесена в сервисы, но значительная часть use case logic всё ещё находится в контроллерах и Eloquent queries.

---

## Ключевые модули

Фактически существующие backend-модули:

- **Auth** — register/login/logout/me через Sanctum (`AuthController`).
- **Public catalog** — anime catalog, details, schedule, tags, episodes, player sources.
- **Profile and statistics** — профиль, avatar upload, пользовательская статистика.
- **Comments** — public comments list, user comments, create/update/delete.
- **Ratings** — пользовательские оценки и агрегаты рейтинга.
- **Favorites** — избранное пользователя.
- **User anime list** — статусы anime и количество просмотренных эпизодов.
- **Watch history** — прогресс просмотра и история.
- **Friendship** — друзья, заявки, поиск пользователей.
- **Watch Party** — комнаты совместного просмотра, чат, invite, realtime sync.
- **AI chat** — backend AI endpoint, session history, provider gateway/fallback, role/policy guardrails and tool allowlist.
- **Payment stub** — `POST /api/v1/payment/premium`.
- **Blade-admin** — dashboard, users, anime, tags, episodes/imports, comments moderation, audit logs.
- **Admin JSON API** — protected `/api/v1/admin/*` endpoints for separate admin scaffold/readiness.
- **Import/integrations** — Shikimori/AniLibria/Kodik/VideoCDN/AI description-related services.

Подробная карта ответственности: `../docs/backend-module-responsibility-map.md`.

---

## Технологический стек

| Категория | Текущее состояние |
|---|---|
| Framework | Laravel 12 |
| Language | PHP `^8.2` по `composer.json` |
| Database | PostgreSQL используется как основной целевой вариант окружения |
| Authentication | Laravel Sanctum |
| Realtime | Laravel Broadcasting / Reverb dependencies |
| API Docs packages | Scribe и L5 Swagger присутствуют в зависимостях |
| Admin UI | Legacy Blade views внутри backend |
| Admin API | `/api/v1/admin/*` subset protected by Sanctum + admin middleware |
| AI | Backend AI chat/session module with provider config and safety guardrails |
| Frontend assets | Vite/Tailwind для backend-side assets |

---

## Установка и запуск

Команды выполнять из директории `aniyume-backend`.

### 1. Установка зависимостей

```bash
composer install
npm install
```

### 2. Настройка окружения

```bash
cp .env.example .env
php artisan key:generate
```

Настройте подключение к базе данных в `.env`. Для PostgreSQL типовой вариант:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=aniyume
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Не коммитьте `.env` с реальными секретами.

### 3. Миграции и seed data

```bash
php artisan migrate --seed
```

### 4. Storage link

```bash
php artisan storage:link
```

### 5. Запуск разработки

Минимально:

```bash
php artisan serve
npm run dev
```

Также в `composer.json` есть composite dev script:

```bash
composer run dev
```

Он запускает Laravel server, queue listener, logs через Pail и Vite dev server через `concurrently`.

---

## Проверки и полезные команды

Актуальные базовые команды:

```bash
php artisan route:list
php artisan test
composer test
php artisan schedule:list
php artisan migrate --pretend
npm run build
```

Для документации API:

```bash
php artisan scribe:generate
```

После запуска приложения документация/Swagger routes зависят от текущей конфигурации пакетов. На момент baseline в route list присутствуют `/docs`, `/api/documentation`, `/api/oauth2-callback`.

---

## Endpoint baseline

Коротко о surface area:

- API prefix: `/api/v1`;
- public endpoints: `/api/v1/public/*`;
- protected user endpoints: `auth:sanctum`;
- AI endpoints: `/api/v1/ai/chat`, `/api/v1/ai/chat/sessions*` behind `auth:sanctum` and AI throttling;
- admin API endpoints: `/api/v1/admin/*` behind `auth:sanctum` + `admin`;
- broadcast auth внутри `/api/v1/broadcasting/auth` и также framework route `/broadcasting/auth`;
- legacy admin UI: `/admin/*`.

Не используйте таблицу endpoints из README как полный контракт. Полный baseline ведётся отдельно:

- `../docs/backend-endpoint-inventory.md` — inventory API, realtime и web/admin routes;
- `../docs/admin-api-migration-map.md` — карта переноса Blade-admin в API + Next admin;
- `../docs/regression-checklist.md` — ручные и технические проверки.

---

## Документация

Baseline docs для команды:

- `../docs/backend-endpoint-inventory.md` — текущая карта endpoints;
- `../docs/backend-module-responsibility-map.md` — распределение ответственности модулей;
- `../docs/admin-api-migration-map.md` — план миграции admin;
- `../docs/regression-checklist.md` — обязательный regression checklist.
- `../docs/docker-setup.md` — рабочий local/dev Docker baseline;
- `../docs/final-thesis-readiness-audit.md` — финальный defense/demo audit.

Если код меняется, эти документы нужно обновлять вместе с изменениями в routes/controllers/use cases.

---

## Deployment notes

Перед production/staging deployment проверить минимум:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

Также нужны:

- корректный `.env` без debug в production;
- web server document root на `public/`;
- `php artisan storage:link`;
- queue worker для фоновых задач/imports;
- scheduler, если используются scheduled tasks;
- realtime/broadcast configuration для Watch Party сценариев.

---

## Лицензия

Этот проект распространяется под лицензией MIT. Подробности см. в файле [LICENSE](LICENSE).

---

<div align="center">

**Laravel Backend • JSON API • Legacy Blade Admin • Migration to API-only planned**

</div>
