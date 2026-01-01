<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AniYume Admin')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #fcfdfe; color: #1a1d1f; }
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: #ffffff; border-right: 1px solid #f0f2f5; display: flex; flex-direction: column; position: sticky; top: 0; height: 100vh; }
        .sidebar-logo { padding: 2rem; display: flex; align-items: center; gap: 0.75rem; }
        .sidebar-logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #00f2ea 0%, #00d1ca 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #ffffff; font-weight: 700; font-size: 1.25rem; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
        .sidebar-logo-text { font-weight: 800; font-size: 1.25rem; letter-spacing: -0.025em; }
        .sidebar-logo-accent { color: #00f2ea; }
        .sidebar-nav { flex: 1; padding: 0 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; border-radius: 0.75rem; color: #6f767e; font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: all 0.2s ease; }
        .sidebar-link:hover { background: #f4f4f4; color: #1a1d1f; }
        .sidebar-link.active { background: #00f2ea; color: #ffffff; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
        .sidebar-footer { padding: 1.5rem; border-top: 1px solid #f0f2f5; }
        .sidebar-logout { display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; border-radius: 0.75rem; color: #dc2626; font-weight: 700; background: none; border: none; cursor: pointer; transition: all 0.2s ease; width: 100%; font-size: 0.9rem; }
        .sidebar-logout:hover { background: #fef2f2; }
        .main-content { flex: 1; padding: 2.5rem; overflow-y: auto; }
        .main-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; }
        .main-title { display: flex; flex-direction: column; }
        .main-title h1 { color: #1a1d1f; font-size: 2rem; font-weight: 800; }
        .main-title p { color: #6f767e; font-size: 0.9rem; font-weight: 500; margin-top: 0.25rem; }
        .main-user { display: flex; align-items: center; gap: 1rem; }
        .main-user-avatar { width: 48px; height: 48px; border-radius: 0.75rem; background: linear-gradient(135deg, #00f2ea 0%, #00d1ca 100%); display: flex; align-items: center; justify-content: center; color: #ffffff; font-weight: 700; font-size: 1.125rem; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
        .success-alert { margin-bottom: 2rem; padding: 1rem 1.25rem; background: #f0fdf4; border: 1px solid #d1fae5; color: #16a34a; border-radius: 0.75rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 600; font-size: 0.9rem; }
        @media (max-width: 1024px) {
            .sidebar { width: 240px; }
            .main-content { padding: 1.5rem; }
        }
        @media (max-width: 768px) {
            .admin-layout { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">A</div>
                <span class="sidebar-logo-text">AniYume <span class="sidebar-logo-accent">Admin</span></span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    📊 Панель
                </a>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    👥 Пользователи
                </a>
                <a href="{{ route('admin.anime.index') }}" class="sidebar-link {{ request()->routeIs('admin.anime.*') ? 'active' : '' }}">
                    🎬 Аниме
                </a>
                <a href="{{ route('admin.episodes.index') }}" class="sidebar-link {{ request()->routeIs('admin.episodes.*') ? 'active' : '' }}">
                    ▶️ Эпизоды
                </a>
                <a href="{{ route('admin.comments.index') }}" class="sidebar-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                    💬 Комменты
                </a>
                <a href="{{ route('admin.tags.index') }}" class="sidebar-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                    🏷️ Теги
                </a>
                <a href="{{ route('admin.import.index') }}" class="sidebar-link {{ request()->routeIs('admin.import.*') ? 'active' : '' }}">
                    🔄 Импорт
                </a>
                <a href="{{ route('admin.audit-logs') }}" class="sidebar-link {{ request()->routeIs('admin.audit-logs') ? 'active' : '' }}">
                    📋 Логи
                </a>
            </nav>
            <div class="sidebar-footer">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-logout">
                        🚪 Выйти
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="main-title">
                    <h1>@yield('page_title')</h1>
                    <p>Добро пожаловать обратно, {{ auth()->user()->name }}</p>
                </div>
                <div class="main-user">
                    <div class="main-user-avatar">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            @if(session('success'))
                <div class="success-alert">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
