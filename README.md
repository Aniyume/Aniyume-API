<div align="center">

<img src="https://github.com/user-attachments/assets/d7779d05-b096-4ffc-b7e5-830fdd0c62c6" width="450" alt="AniYume Logo" />

# AniYume API

**RESTful API для платформы просмотра аниме**

[![Laravel](https://img.shields.io/badge/Laravel_12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP_8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)

</div>

---

## 📋 Содержание

- [О проекте](#-о-проекте)
- [Архитектура](#-архитектура)
- [Основные возможности](#-основные-возможности)
- [Технологический стек](#-технологический-стек)
- [Установка](#-установка)
- [API Endpoints](#-api-endpoints)
- [Документация](#-документация)
- [Deployment](#-deployment)
- [Лицензия](#-лицензия)

---

## 🎯 О проекте

AniYume API — это backend-сервис для платформы просмотра аниме, построенный на современном стеке технологий с соблюдением принципов чистой архитектуры. Проект предоставляет полнофункциональный RESTful API для управления каталогом аниме, пользовательскими списками, историей просмотра и социальными функциями.

### Ключевые принципы разработки

- **SOLID Architecture** — четкое разделение ответственности между слоями
- **Type Safety** — полная типизация на PHP 8.3
- **DRY & KISS** — чистый и поддерживаемый код
- **API-First** — продуманная структура эндпоинтов

---

## 🏗 Архитектура

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

## ✨ Основные возможности

### 🔐 Аутентификация

- Laravel Sanctum для безопасной авторизации через Bearer-токены
- Управление профилем пользователя
- Загрузка и изменение аватаров

### 🎬 Контент и медиаплеер

- Каталог аниме с гибкой фильтрацией по жанрам, годам и типам
- Управление эпизодами с поддержкой сезонов и разных озвучек
- Сохранение прогресса просмотра с точностью до секунды

### ⭐ Социальные функции

- Личные списки аниме (Смотрю, В планах, Завершено, Брошено)
- Система оценок от 1 до 5 с автоматическим пересчетом рейтинга
- Комментарии и обсуждения к тайтлам

### 📊 Статистика

- История просмотров пользователя
- Персональная статистика по жанрам и тайтлам
- Аналитика активности

---

## 🛠 Технологический стек

- **Framework:** Laravel 12
- **Language:** PHP 8.3
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Documentation:** Scribe
- **API Versioning:** v1 (Resources)

---

## 🚀 Установка

### Требования

- PHP >= 8.3
- Composer
- MySQL >= 8.0
- Node.js & NPM (опционально)

### Шаги установки

1. **Клонирование репозитория**
```bash
git clone https://github.com/TamerlanWebd/AniYume.git
cd AniYume
```

2. **Установка зависимостей**
```bash
composer install
```

3. **Настройка окружения**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Конфигурация базы данных**

Отредактируйте `.env` файл:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aniyume
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Миграции и сидеры**
```bash
php artisan migrate --seed
```

6. **Генерация документации**
```bash
php artisan scribe:generate
```

7. **Создание symbolic link для хранилища**
```bash
php artisan storage:link
```

8. **Запуск сервера**
```bash
php artisan serve
```

API будет доступен по адресу: `http://localhost:8000`

---

## 📡 API Endpoints

### Публичные эндпоинты

```http
GET    /api/v1/public/anime          # Список аниме с фильтрами
GET    /api/v1/public/anime/{id}     # Детали конкретного тайтла
GET    /api/v1/public/tags           # Список всех жанров
GET    /api/v1/public/episodes       # Поиск эпизодов
```

### Аутентификация

```http
POST   /api/v1/auth/register         # Регистрация
POST   /api/v1/auth/login            # Вход (получение токена)
POST   /api/v1/auth/logout           # Выход
```

### Личный кабинет (требуется токен)

```http
GET    /api/v1/profile/me            # Данные профиля
PUT    /api/v1/profile/update        # Обновление профиля
POST   /api/v1/profile/avatar        # Загрузка аватара
```

### Списки и статусы

```http
GET    /api/v1/anime-list            # Мой список аниме
PUT    /api/v1/anime-list/status     # Изменить статус тайтла
POST   /api/v1/anime/{id}/rate       # Оценить аниме
```

### История просмотра

```http
POST   /api/v1/watch-history         # Сохранить прогресс
GET    /api/v1/watch-history         # История просмотров
```

### Комментарии

```http
GET    /api/v1/comments              # Комментарии к тайтлу
POST   /api/v1/comments              # Создать комментарий
DELETE /api/v1/comments/{id}         # Удалить комментарий
```

---

## 📚 Документация

Полная интерактивная документация API доступна после запуска проекта:

**Scribe UI:** `http://localhost:8000/docs`

Документация включает:
- Описание всех эндпоинтов
- Примеры запросов и ответов
- Параметры и валидацию
- Коды ответов

---

## 🌐 Deployment

### Production Checklist

- [ ] Установить `APP_ENV=production` в `.env`
- [ ] Установить `APP_DEBUG=false` в `.env`
- [ ] Выполнить оптимизацию:
  ```bash
  php artisan optimize
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
- [ ] Настроить CORS в `config/cors.php` для фронтенда
- [ ] Настроить Symbolic Link: `php artisan storage:link`
- [ ] Настроить планировщик задач (cron) для Laravel Scheduler
- [ ] Настроить очереди (Queue) для фоновых задач
- [ ] Настроить SSL-сертификат (Let's Encrypt)
- [ ] Настроить резервное копирование БД

### Рекомендуемые серверы

- **Web Server:** Nginx / Apache
- **PHP:** PHP-FPM 8.3
- **Database:** MySQL 8.0 / MariaDB
- **Cache:** Redis (опционально)
- **Queue:** Redis / Database

---

## 📝 Лицензия

Этот проект распространяется под лицензией MIT. См. файл [LICENSE](LICENSE) для подробностей.

---

## 👨‍💻 Автор

**TamerlanWebd**

- GitHub: [@TamerlanWebd](https://github.com/TamerlanWebd)

---

<div align="center">

**Создано с 💻 и ☕**

*Backend Architecture • RESTful API • Laravel 12*

</div>
