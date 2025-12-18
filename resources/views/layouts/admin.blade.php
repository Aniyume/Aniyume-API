<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'АниЮм Админ-панель')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;400;500;700;800&family=Onest:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-cyan: #00f2ea;
            --primary-pink: #ff0050;
            --bg-dark: #090910;
            --glass-bg: rgba(20, 20, 35, 0.6);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            font-family: 'M PLUS Rounded 1c', 'Onest', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-dark);
            background-image:
                linear-gradient(rgba(9, 9, 16, 0.9), rgba(9, 9, 16, 0.9)),
                linear-gradient(90deg, rgba(0, 242, 234, 0.03) 1px, transparent 1px),
                linear-gradient(rgba(0, 242, 234, 0.03) 1px, transparent 1px),
                radial-gradient(circle at 50% 0%, #1a1a40 0%, #090910 70%);
            background-size: 100% 100%, 40px 40px, 40px 40px, 100% 100%;
            color: #e0e0e0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 15% 50%, rgba(255, 0, 80, 0.08) 0%, transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(0, 242, 234, 0.08) 0%, transparent 25%);
            pointer-events: none;
            z-index: 0;
            animation: pulseBackground 8s ease-in-out infinite alternate;
        }

        @keyframes pulseBackground {
            0% { opacity: 0.5; transform: scale(1); }
            100% { opacity: 1; transform: scale(1.1); }
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        nav::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-cyan), var(--primary-pink), transparent);
            box-shadow: 0 0 10px var(--primary-cyan);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 76px;
            padding: 0 24px;
            max-width: 1600px;
            margin: 0 auto;
        }
        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            position: relative;
            group: hover;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #2a2a4a, #1a1a2e);
            border: 2px solid var(--primary-cyan);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #fff;
            font-size: 22px;
            box-shadow: 0 0 15px rgba(0, 242, 234, 0.3);
            transform: rotate(-5deg);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .logo-wrapper:hover .logo-icon {
            transform: rotate(0deg) scale(1.1);
            box-shadow: 0 0 25px rgba(0, 242, 234, 0.6);
            border-color: #fff;
        }

        .logo-text-container {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 800;
            background: linear-gradient(to right, #fff, var(--primary-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .logo-subtext {
            font-size: 10px;
            color: var(--primary-pink);
            font-weight: 700;
            letter-spacing: 2px;
            text-shadow: 0 0 5px rgba(255, 0, 80, 0.5);
        }
        .nav-center {
            display: flex;
            gap: 6px;
            align-items: center;
            background: rgba(255, 255, 255, 0.03);
            padding: 6px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .nav-link-item {
            position: relative;
            padding: 10px 18px;
            border-radius: 12px;
            color: #a0a0b0;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            overflow: hidden;
        }
        .nav-link-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link-item svg {
            transition: transform 0.3s ease;
        }

        .nav-link-item:hover svg {
            transform: translateY(-2px);
            color: var(--primary-cyan);
            filter: drop-shadow(0 0 5px var(--primary-cyan));
        }
        .nav-link-item.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(0, 242, 234, 0.15), rgba(255, 0, 80, 0.15));
            border: 1px solid rgba(0, 242, 234, 0.3);
            box-shadow: 0 0 15px rgba(0, 242, 234, 0.1);
        }

        .nav-link-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 100%;
            width: 3px;
            background: var(--primary-cyan);
            box-shadow: 0 0 10px var(--primary-cyan);
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 16px 6px 6px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .user-section:hover {
            border-color: var(--primary-pink);
            box-shadow: 0 0 15px rgba(255, 0, 80, 0.2);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-pink), #ff5e9a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 16px;
            border: 2px solid rgba(255,255,255,0.2);
            position: relative;
        }
        .user-avatar::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: #00ff88;
            border-radius: 50%;
            border: 2px solid var(--bg-dark);
            box-shadow: 0 0 5px #00ff88;
        }

        .user-name {
            font-size: 14px;
            color: #fff;
            font-weight: 600;
        }

        .btn-logout {
            background: transparent;
            color: #ff6b6b;
            padding: 8px;
            border-radius: 10px;
            border: 1px solid rgba(255, 107, 107, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-logout:hover {
            background: rgba(255, 107, 107, 0.1);
            border-color: #ff6b6b;
            box-shadow: 0 0 15px rgba(255, 107, 107, 0.3);
            transform: rotate(90deg);
        }
        .mobile-menu-btn {
            display: none;
            background: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .main-content {
            position: relative;
            z-index: 1;
            animation: slideUpFade 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-notification {
            border-radius: 12px;
            padding: 16px 20px;
            backdrop-filter: blur(10px);
            border-left: 4px solid;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
            background: rgba(20, 20, 35, 0.8);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .alert-success {
            border-color: #00ff88;
            background: linear-gradient(90deg, rgba(0, 255, 136, 0.1), transparent);
            color: #00ff88;
        }

        .alert-error {
            border-color: #ff0050;
            background: linear-gradient(90deg, rgba(255, 0, 80, 0.1), transparent);
            color: #ff0050;
        }

        @media (max-width: 1024px) {
            .nav-center {
                display: none;
                position: absolute;
                top: 76px;
                left: 0;
                width: 100%;
                flex-direction: column;
                background: rgba(9, 9, 16, 0.95);
                backdrop-filter: blur(20px);
                padding: 20px;
                border-bottom: 1px solid var(--primary-cyan);
                gap: 10px;
            }

            .nav-center.active {
                display: flex;
            }

            .nav-link-item {
                width: 100%;
                justify-content: center;
            }

            .mobile-menu-btn {
                display: block;
            }

            .user-name {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="{{ route('admin.dashboard') }}" class="logo-wrapper">
                <div class="logo-icon">A</div>
                <div class="logo-text-container">
                    <div class="logo-text">AniYume</div>
                    <div class="logo-subtext">アドミン</div>
                </div>
            </a>

            <div class="nav-center" id="navCenter">
                <a href="{{ route('admin.dashboard') }}" class="nav-link-item">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>Панель</span>
                </a>
                <a href="{{ route('admin.anime.index') }}" class="nav-link-item">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                    <span>Аниме</span>
                </a>
                <a href="{{ route('admin.comments.index') }}" class="nav-link-item">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                    <span>Комменты</span>
                </a>
                <a href="{{ route('admin.tags.index') }}" class="nav-link-item">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                    <span>Теги</span>
                </a>
                <a href="{{ route('admin.episodes.index') }}" class="nav-link-item">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polygon points="10 8 16 12 10 16 10 8"></polygon>
                    </svg>
                    <span>Эпизоды</span>
                </a>
                <a href="{{ route('admin.import.index') }}" class="nav-link-item">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Импорт</span>
                </a>
                <a href="{{ route('admin.audit-logs') }}" class="nav-link-item">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="4 17 10 11 4 5"></polyline>
                        <line x1="12" y1="19" x2="20" y2="19"></line>
                    </svg>
                    <span>Логи</span>
                </a>
            </div>

            <div class="nav-right">
                <div class="user-section">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <span class="user-name">{{ auth()->user()->name }}</span>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-logout" title="Выйти">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                </form>

                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <main class="main-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="alert-notification alert-success">
                <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-notification alert-error">
                <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            const navCenter = document.getElementById('navCenter');
            navCenter.classList.toggle('active');
        });

        document.querySelectorAll('.alert-notification').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'all 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });

        const currentUrl = window.location.href;
        document.querySelectorAll('.nav-link-item').forEach(link => {
            if(link.href === currentUrl || currentUrl.startsWith(link.href)) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>
