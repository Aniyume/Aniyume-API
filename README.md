<div align="center">

<img src="https://github.com/user-attachments/assets/d7779d05-b096-4ffc-b7e5-830fdd0c62c6" width="450" alt="AniYume Logo" />

# AniYume API

**RESTful API для платформы просмотра аниме**

[![Laravel](https://img.shields.io/badge/Laravel_12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP_8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)](https://postgresql.org)

</div>

---

## Содержание

- [О проекте](#о-проекте)
- [Архитектура](#архитектура)
- [Основные возможности](#основные-возможности)
- [Технологический стек](#технологический-стек)
- [Установка](#установка)
- [API Endpoints](#api-endpoints)
- [Документация](#документация)
- [Production Deployment](#production-deployment)
- [Лицензия](#лицензия)

---

## О проекте

AniYume API — это backend-сервис для платформы просмотра аниме, построенный на современном стеке технологий с соблюдением принципов чистой архитектуры. Проект предоставляет полнофункциональный RESTful API для управления каталогом аниме, пользовательскими списками, историей просмотра и социальными функциями.

### Ключевые принципы

- **SOLID Architecture** — четкое разделение ответственности между слоями
- **Type Safety** — полная типизация на PHP 8.3
- **DRY & KISS** — чистый и поддерживаемый код
- **API-First** — продуманная структура эндпоинтов

---

## Архитектура

Проект построен с использованием многослойной архитектуры:

```
app/
├── Http/
│   ├── Controllers/      # Обработка HTTP-запросов
│   ├── Requests/         # Валидация входящих данных (Form Requests)
│   ├── Resources/        # Трансформация данных для API (v1)
│   └── Middleware/       # Промежуточная обработка (Auth, CORS)
├── Models/               # Eloquent модели (Anime, Episode, User)
├── Services/             # Бизнес-логика приложения
├── Policies/             # Правила доступа к ресурсам
└── Exceptions/           # Централизованная обработка ошибок
```

### Принципы

- **Single Responsibility** — каждый класс решает одну задачу
- **Dependency Injection** — использование IoC-контейнера Laravel
- **Strict Typing** — явная типизация всех методов и свойств
- **Self-Documenting Code** — читаемый код с понятным нейменгом

---

## Основные возможности

### Аутентификация и пользователи

- Laravel Sanctum для безопасной авторизации через Bearer-токены
- Управление профилем пользователя
- Загрузка и изменение аватаров

### Контент и медиаплеер

- Каталог аниме с гибкой фильтрацией по жанрам, годам и типам
- Управление эпизодами с поддержкой сезонов и разных озвучек
- Сохранение прогресса просмотра с точностью до секунды

### Социальные функции

- Личные списки аниме (Смотрю, В планах, Завершено, Брошено)
- Система оценок от 1 до 5 с автоматическим пересчетом рейтинга
- Комментарии и обсуждения к тайтлам

### Статистика и аналитика

- История просмотров пользователя
- Персональная статистика по жанрам и тайтлам
- Аналитика активности

---

## Технологический стек

| Категория | Технология |
|-----------|------------|
| **Framework** | Laravel 12 |
| **Language** | PHP 8.3 |
| **Database** | PostgreSQL 14+ |
| **Authentication** | Laravel Sanctum |
| **Documentation** | Scribe |
| **API Versioning** | v1 (Resources) |

---

## Установка

### Системные требования

- PHP >= 8.3
- Composer >= 2.0
- PostgreSQL >= 14.0
- Git

### Инструкция по установке

**Шаг 1. Клонирование репозитория**

```bash
git clone https://github.com/TamerlanWebd/AniYume.git
cd AniYume
```

**Шаг 2. Установка зависимостей**

```bash
composer install
```

**Шаг 3. Настройка окружения**

```bash
cp .env.example .env
php artisan key:generate
```

**Шаг 4. Конфигурация базы данных**

Отредактируйте файл `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=aniyume
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**Шаг 5. Создание и заполнение базы данных**

```bash
# Создайте базу данных
sudo -u postgres psql -c "CREATE DATABASE aniyume;"

# Или через psql консоль
psql -U postgres
CREATE DATABASE aniyume;
\q

# Запустите миграции и сидеры
php artisan migrate --seed
```

**Шаг 6. Настройка хранилища**

```bash
php artisan storage:link
```

**Шаг 7. Генерация документации API**

```bash
php artisan scribe:generate
```

**Шаг 8. Запуск сервера разработки**

```bash
php artisan serve
```

API будет доступен по адресу: **http://localhost:8000**

---

## API Endpoints

### Публичные эндпоинты

Не требуют аутентификации.

| Метод | Endpoint | Описание |
|-------|----------|----------|
| `GET` | `/api/v1/public/anime` | Список аниме с фильтрацией |
| `GET` | `/api/v1/public/anime/{id}` | Детальная информация о тайтле |
| `GET` | `/api/v1/public/tags` | Список всех жанров |
| `GET` | `/api/v1/public/episodes` | Поиск эпизодов |

### Аутентификация

| Метод | Endpoint | Описание |
|-------|----------|----------|
| `POST` | `/api/v1/auth/register` | Регистрация нового пользователя |
| `POST` | `/api/v1/auth/login` | Вход и получение токена |
| `POST` | `/api/v1/auth/logout` | Выход из системы |

### Профиль пользователя

Требуется Bearer Token в заголовке `Authorization`.

| Метод | Endpoint | Описание |
|-------|----------|----------|
| `GET` | `/api/v1/profile/me` | Получить данные профиля |
| `PUT` | `/api/v1/profile/update` | Обновить профиль |
| `POST` | `/api/v1/profile/avatar` | Загрузить аватар |

### Списки и оценки

| Метод | Endpoint | Описание |
|-------|----------|----------|
| `GET` | `/api/v1/anime-list` | Мой список аниме |
| `PUT` | `/api/v1/anime-list/status` | Изменить статус аниме в списке |
| `POST` | `/api/v1/anime/{id}/rate` | Оценить аниме (1-5) |

### История просмотра

| Метод | Endpoint | Описание |
|-------|----------|----------|
| `POST` | `/api/v1/watch-history` | Сохранить прогресс просмотра |
| `GET` | `/api/v1/watch-history` | Получить историю просмотров |

### Комментарии

| Метод | Endpoint | Описание |
|-------|----------|----------|
| `GET` | `/api/v1/comments` | Комментарии к аниме |
| `POST` | `/api/v1/comments` | Создать комментарий |
| `DELETE` | `/api/v1/comments/{id}` | Удалить комментарий |

### Пример запроса

```bash
# Получение токена
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Использование токена
curl -X GET http://localhost:8000/api/v1/profile/me \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## Документация

Полная интерактивная документация API доступна после запуска проекта по адресу:

**http://localhost:8000/docs**

Документация включает:

- Подробное описание каждого эндпоинта
- Примеры запросов и ответов в формате JSON
- Описание всех параметров запроса
- Правила валидации данных
- HTTP коды ответов и их значения
- Возможность тестирования API прямо в браузере

---

## Production Deployment

### Контрольный список перед деплоем

**1. Настройка переменных окружения**

В файле `.env` установите:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

**2. Оптимизация приложения**

```bash
# Кеширование конфигурации
php artisan config:cache

# Кеширование маршрутов
php artisan route:cache

# Кеширование представлений
php artisan view:cache

# Общая оптимизация
php artisan optimize
```

**3. Настройка CORS**

Отредактируйте `config/cors.php` для разрешения запросов с вашего фронтенда:

```php
'allowed_origins' => ['https://your-frontend-domain.com'],
```

**4. Настройка веб-сервера**

Убедитесь, что документ root указывает на папку `public/`.

**5. Настройка планировщика задач**

Добавьте в crontab:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

**6. Настройка очередей**

Для фоновых задач запустите worker:

```bash
php artisan queue:work --daemon
```

Рекомендуется использовать Supervisor для управления процессом.

**7. SSL-сертификат**

Настройте HTTPS с помощью Let's Encrypt или другого провайдера.

**8. Резервное копирование**

Настройте автоматическое резервное копирование базы данных:

```bash
# Пример команды для бэкапа PostgreSQL
pg_dump -U username aniyume > backup_$(date +%Y%m%d).sql

# Или с сжатием
pg_dump -U username aniyume | gzip > backup_$(date +%Y%m%d).sql.gz
```

### Рекомендуемое окружение

| Компонент | Рекомендация |
|-----------|--------------|
| **Web Server** | Nginx 1.20+ / Apache 2.4+ |
| **PHP** | PHP-FPM 8.3 |
| **Database** | PostgreSQL 14+ |
| **Cache** | Redis 6.0+ (опционально) |
| **Queue** | Redis / Database |
| **Process Manager** | Supervisor |

### Пример конфигурации Nginx

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/aniyume/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Лицензия

Этот проект распространяется под лицензией MIT. Подробности см. в файле [LICENSE](LICENSE).

---

## Контакты

**Автор:** TamerlanWebd

**GitHub:** [@TamerlanWebd](https://github.com/TamerlanWebd)

---

<div align="center">

**Backend Architecture • RESTful API • Laravel 12**

</div>
