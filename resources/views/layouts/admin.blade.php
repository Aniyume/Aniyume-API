<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AniYume Admin')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0A0A0A;
            color: #FFFFFF;
            overflow-x: hidden;
        }

        .admin-layout { display: flex; min-height: 100vh; }

        .sidebar {
            width: 280px;
            background: #111111;
            border-right: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 50;
        }

        .sidebar-logo { padding: 2.5rem 2rem; display: flex; align-items: center; gap: 1rem; }

        .sidebar-logo-icon {
            width: 45px; height: 45px;
            background: linear-gradient(135deg, #2EC4B6 0%, #26a69a 100%);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: #000; font-weight: 900; font-size: 1.5rem;
            box-shadow: 0 0 20px rgba(46, 196, 182, 0.3);
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            font-weight: 900; font-size: 1.4rem;
            letter-spacing: -0.05em; text-transform: uppercase;
            line-height: 1;
        }

        .sidebar-logo-sub {
            display: block; font-size: 0.6rem; color: #2EC4B6;
            letter-spacing: 0.4em; margin-top: 4px; font-style: italic;
        }

        .sidebar-nav { flex: 1; padding: 0 1.25rem; display: flex; flex-direction: column; gap: 0.4rem; }

        .sidebar-link {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.25rem; border-radius: 14px;
            color: rgba(255,255,255,0.4); font-weight: 800; font-size: 0.75rem;
            text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase; letter-spacing: 0.05em;
        }

        .sidebar-link i { width: 18px; height: 18px; margin-right: 12px; }
        .sidebar-link .nav-label { display: flex; align-items: center; }

        .sidebar-link:hover { background: rgba(255,255,255,0.05); color: #FFFFFF; }

        .sidebar-link.active {
            background: #2EC4B6; color: #000;
            box-shadow: 0 10px 25px rgba(46, 196, 182, 0.2);
        }

        .sidebar-link.active i { color: #000; }

        .sidebar-footer { padding: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); }

        .sidebar-logout {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 1rem 1.25rem; border-radius: 14px;
            color: #ff4d4d; font-weight: 800; background: rgba(255, 77, 77, 0.05);
            border: none; cursor: pointer; transition: all 0.2s ease;
            width: 100%; font-size: 0.75rem; text-transform: uppercase;
        }

        .sidebar-logout:hover { background: #ff4d4d; color: #fff; }

        .main-content { flex: 1; min-width: 0; }

        .main-header {
            height: 100px; display: flex; justify-content: space-between; align-items: center;
            padding: 0 3rem; background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05);
            position: sticky; top: 0; z-index: 40;
        }

        .main-title h1 {
            font-size: 1.75rem; font-weight: 900; text-transform: uppercase;
            italic: italic; letter-spacing: -0.02em;
        }

        .main-title h1 span { color: #2EC4B6; font-style: italic; }

        .main-user { display: flex; align-items: center; gap: 1.25rem; }

        .main-user-info { text-align: right; }
        .main-user-info .name { display: block; font-weight: 900; font-size: 0.9rem; text-transform: uppercase; }
        .main-user-info .role { display: block; font-size: 0.65rem; color: #2EC4B6; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; }

        .main-user-avatar {
            width: 52px; height: 52px; border-radius: 16px;
            background: #111111; border: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            color: #2EC4B6; font-weight: 900; font-size: 1.25rem;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
        }

        .content-body { padding: 3rem; }

        .success-alert {
            margin-bottom: 2.5rem; padding: 1.25rem 1.5rem;
            background: rgba(46, 196, 182, 0.1);
            border: 1px solid rgba(46, 196, 182, 0.2);
            color: #2EC4B6; border-radius: 16px;
            display: flex; align-items: center; gap: 1rem;
            font-weight: 800; font-size: 0.85rem; text-transform: uppercase;
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0A0A0A; }
        ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #2EC4B6; }

        @media (max-width: 1024px) {
            .sidebar { width: 80px; }
            .sidebar-logo-text, .sidebar-logo-sub, .nav-text, .sidebar-logout span { display: none; }
            .sidebar-logo { justify-content: center; padding: 2rem 0; }
            .sidebar-link { justify-content: center; padding: 1.25rem; }
            .sidebar-link i { margin-right: 0; }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">A</div>
                <div class="sidebar-logo-text-wrap">
                    <span class="sidebar-logo-text">AniYume</span>
                    <span class="sidebar-logo-sub">ADMIN BOARD</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="layout-dashboard"></i> <span class="nav-text">Панель</span></span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="users"></i> <span class="nav-text">Юзеры</span></span>
                </a>
                <a href="{{ route('admin.anime.index') }}" class="sidebar-link {{ request()->routeIs('admin.anime.*') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="film"></i> <span class="nav-text">Аниме</span></span>
                </a>
                <a href="{{ route('admin.episodes.index') }}" class="sidebar-link {{ request()->routeIs('admin.episodes.*') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="play-circle"></i> <span class="nav-text">Эпизоды</span></span>
                </a>
                <a href="{{ route('admin.comments.index') }}" class="sidebar-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="message-square"></i> <span class="nav-text">Комменты</span></span>
                </a>
                <a href="{{ route('admin.tags.index') }}" class="sidebar-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="tags"></i> <span class="nav-text">Теги</span></span>
                </a>
                <a href="{{ route('admin.import.index') }}" class="sidebar-link {{ request()->routeIs('admin.import.*') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="refresh-cw"></i> <span class="nav-text">Импорт</span></span>
                </a>
                <a href="{{ route('admin.audit-logs') }}" class="sidebar-link {{ request()->routeIs('admin.audit-logs') ? 'active' : '' }}">
                    <span class="nav-label"><i data-lucide="clipboard-list"></i> <span class="nav-text">Логи</span></span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-logout">
                        <i data-lucide="log-out"></i>
                        <span>Выйти из системы</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="main-title">
                    <h1>@yield('page_title', 'Dashboard') <span>Управление</span></h1>
                </div>
                <div class="main-user">
                    <div class="main-user-info">
                        <span class="name">{{ auth()->user()->name }}</span>
                        <span class="role">Administrator</span>
                    </div>
                    <div class="main-user-avatar">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="content-body">
                @if(session('success'))
                    <div class="success-alert">
                        <i data-lucide="check-circle-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
