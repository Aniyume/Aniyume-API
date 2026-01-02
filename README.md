<div align="center">

  <!-- КОМПОЗИЦИЯ: ТЯНКА — ЛОГОТИП — ТЯНКА -->
  <table>
    <tr>
      <!-- Левый маскот -->
      <td align="right" valign="bottom" width="25%">
        <img src="https://github.com/user-attachments/assets/ac1a5892-f3cf-4d60-99c9-e5216260b69f" height="280" alt="Left Mascot" />
      </td>
      <!-- Логотип и описание по центру -->
      <td align="center" valign="middle" width="50%">
        <img src="https://github.com/user-attachments/assets/d7779d05-b096-4ffc-b7e5-830fdd0c62c6" width="100%" style="max-width: 450px;" alt="Aniyume Logo" />
        <br />
        <br />
        <b>RESTful API для платформы AniYume.</b>
        <br />
        <sub>SOLID Architecture • Type Safety • API Documentation</sub>
        <br />
        <br />
        <p>
          <img src="https://img.shields.io/badge/Laravel_12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
          <img src="https://img.shields.io/badge/PHP_8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" />
          <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
        </p>
      </td>
      <!-- Правый маскот -->
      <td align="left" valign="bottom" width="25%">
        <img src="https://github.com/user-attachments/assets/d69861b3-a166-4b87-89fb-a5a9feeaa7c9" height="280" alt="Right Mascot" />
      </td>
    </tr>
  </table>

</div>

<br />

---

## <img src="https://api.iconify.design/heroicons/server-stack-solid.svg?color=%2321D0B8" width="28" height="28" style="vertical-align: middle; margin-bottom: 4px;" alt="icon" /> Архитектура

> **Примечание:** Backend реализован с соблюдением принципов SOLID, DRY и KISS.

Проект построен на чистой архитектуре с четким разделением слоев ответственности:

### <img src="https://api.iconify.design/heroicons/cube-solid.svg?color=%2321D0B8" width="24" height="24" style="vertical-align: middle; margin-bottom: 2px;" alt="icon" /> Структура слоев

```text
app/
├── Http/
│   ├── Controllers/  # Тонкий слой обработки HTTP-запросов
│   ├── Requests/     # Валидация входящих данных (Form Requests)
│   ├── Resources/    # Трансформация данных для API ответов (v1)
│   └── Middleware/   # Промежуточная обработка (Auth, CORS)
├── Models/           # Eloquent модели (Anime, Episode, User, etc.)
├── Services/         # Бизнес-логика (Statistics, Profile Services)
├── Policies/         # Правила доступа к комментариям и спискам
└── Exceptions/       # Централизованная обработка ошибок
<img src="https://api.iconify.design/heroicons/check-circle-solid.svg?color=%2321D0B8" width="24" height="24" style="vertical-align: middle; margin-bottom: 2px;" alt="icon" /> Принципы разработки
Single Responsibility: Каждый контроллер и сервис отвечает за свою узкую задачу.
Dependency Injection: Активное использование контейнера зависимостей Laravel.
Strict Typing: Полная поддержка типизации PHP 8.3.
Self-Documenting Code: Понятный нейминг и использование API Resources вместо сырых массивов.
<img src="https://api.iconify.design/heroicons/sparkles-solid.svg?color=%2321D0B8" width="28" height="28" style="vertical-align: middle; margin-bottom: 4px;" alt="icon" /> Основные возможности
<img src="https://api.iconify.design/heroicons/shield-check-solid.svg?color=%2321D0B8" width="24" height="24" style="vertical-align: middle; margin-bottom: 2px;" alt="icon" /> Аутентификация
Laravel Sanctum: Безопасная авторизация через Bearer-токены.
User Profiles: Управление профилем, смена био и загрузка аватаров.
<img src="https://api.iconify.design/heroicons/play-solid.svg?color=%2321D0B8" width="24" height="24" style="vertical-align: middle; margin-bottom: 2px;" alt="icon" /> Контент и Плеер
Anime Catalog: Гибкий поиск, фильтрация по жанрам, годам и типам.
Episode Management: Поддержка сезонов, разных переводчиков и типов озвучки.
Watch History: Сохранение прогресса просмотра каждой серии в секундах.
<img src="https://api.iconify.design/heroicons/star-solid.svg?color=%2321D0B8" width="24" height="24" style="vertical-align: middle; margin-bottom: 2px;" alt="icon" /> Социальные функции
User Lists: Личные списки (Смотрю, В планах, Завершено, Брошено).
Ratings: Система оценок 1-5 с автоматическим пересчетом рейтинга аниме.
Comments: Система обсуждений с привязкой к тайтлам.
<img src="https://api.iconify.design/heroicons/code-bracket-solid.svg?color=%2321D0B8" width="28" height="28" style="vertical-align: middle; margin-bottom: 4px;" alt="icon" /> API Endpoints (v1)
Публичные данные
code
Text
GET    /api/v1/public/anime          # Список аниме с фильтрами
GET    /api/v1/public/anime/{id}     # Детали тайтла
GET    /api/v1/public/tags           # Все доступные жанры
GET    /api/v1/public/episodes       # Поиск эпизодов и плеера
Личный кабинет (Auth Required)
code
Text
POST   /api/v1/auth/login            # Вход и получение токена
GET    /api/v1/profile/me            # Данные моего профиля
POST   /api/v1/watch-history         # Сохранить прогресс просмотра
PUT    /api/v1/anime-list/status     # Изменить статус в моем списке
Документация
Полная интерактивная документация с примерами запросов доступна по адресу:
Scribe UI: http://your-server-ip/docs
<img src="https://api.iconify.design/heroicons/rocket-launch-solid.svg?color=%2321D0B8" width="28" height="28" style="vertical-align: middle; margin-bottom: 4px;" alt="icon" /> Быстрый старт
Установка
Шаг	Действие	Команда
1	Клонирование	git clone https://github.com/TamerlanWebd/AniYume.git
2	Зависимости	composer install
3	Конфигурация	cp .env.example .env
4	База данных	php artisan migrate --seed
5	Документация	php artisan scribe:generate
6	Запуск	php artisan serve
<img src="https://api.iconify.design/heroicons/lifebuoy-solid.svg?color=%2321D0B8" width="28" height="28" style="vertical-align: middle; margin-bottom: 4px;" alt="icon" /> Deployment
Production Checklist

Настроить APP_ENV=production

Выполнить php artisan optimize

Настроить CORS в config/cors.php для фронтенда

Настроить Symbolic Link: php artisan storage:link
<div align="center">
<sub>Crafted with 💻 by TamerlanWebd</sub> <br />
<sub>Backend Architecture • RESTful API • Laravel 12</sub>
</div>
