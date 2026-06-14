# AniYume API

Laravel 12 backend for AniYume. The repository provides a JSON API, background imports, realtime broadcasting, and Swagger documentation. The admin interface is a separate Next.js application in `aniyume-admin-web`.

## Stack

- PHP 8.2+
- Laravel 12
- PostgreSQL
- Laravel Sanctum and Clerk admin authentication
- Laravel Reverb
- L5 Swagger / OpenAPI
- PHPUnit and Larastan

## Setup

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

Start the API:

```bash
php artisan serve
```

The root and legacy `/admin/*` URLs redirect to the separate Next.js admin application configured by `ADMIN_WEB_URL`.

## API

- API prefix: `/api/v1`
- Public catalog: `/api/v1/public/*`
- Authenticated user API: `/api/v1/*`
- Admin API: `/api/v1/admin/*`
- Health check: `/up`

## Swagger

Generate the OpenAPI specification:

```bash
php artisan l5-swagger:generate
```

After starting the backend:

- Swagger UI: `/docs`
- OpenAPI JSON: `/api/documentation`

## Quality Checks

```bash
composer validate --no-check-publish
php artisan test
php artisan route:list
php artisan l5-swagger:generate
vendor/bin/phpstan analyse --memory-limit=1G
vendor/bin/pint --test
```

The backend intentionally has no Vite or frontend asset pipeline. Keep user and admin interfaces in their Next.js repositories.
