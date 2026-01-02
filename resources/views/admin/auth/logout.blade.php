<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выход | AniYume Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0A0A0A; color: #FFFFFF; overflow: hidden; }

        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            70% { box-shadow: 0 0 0 20px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        .logout-card {
            background: #111111;
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 32px;
            animation: zoomIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .btn-terminate {
            background: #ef4444; color: #fff; border-radius: 16px;
            padding: 1.25rem; width: 100%; font-weight: 900;
            text-transform: uppercase; transition: all 0.3s ease;
            letter-spacing: 0.1em;
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.2);
        }
        .btn-terminate:hover { background: #dc2626; transform: translateY(-3px); box-shadow: 0 15px 40px rgba(239, 68, 68, 0.4); }

        .btn-cancel {
            background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.4); border-radius: 16px;
            padding: 1.25rem; width: 100%; font-weight: 900;
            text-transform: uppercase; transition: all 0.3s ease;
            letter-spacing: 0.1em; border: 1px solid rgba(255,255,255,0.05);
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.08); color: #fff; }

        .warning-icon-box {
            width: 80px; height: 80px; background: rgba(239, 68, 68, 0.1);
            border: 2px solid #ef4444; border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            color: #ef4444; margin: 0 auto 2rem;
            animation: pulse-red 2s infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm text-center">
        <div class="logout-card p-10 ani-glow">
            <div class="warning-icon-box">
                <i data-lucide="log-out" class="w-10 h-10"></i>
            </div>

            <h1 class="text-2xl font-black uppercase italic tracking-tighter mb-2">Завершить сессию?</h1>
            <p class="text-white/30 font-bold text-[10px] uppercase tracking-[0.2em] mb-10 leading-relaxed">
                Вы собираетесь выйти из <br>панели управления <span class="text-[#2EC4B6]">AniYume Admin</span>
            </p>

            <div class="space-y-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-terminate flex items-center justify-center gap-3">
                        <span>Завершить работу</span>
                    </button>
                </form>

                <a href="{{ route('admin.dashboard') }}" class="btn-cancel block">
                    Вернуться назад
                </a>
            </div>
        </div>

        <p class="mt-10 text-white/5 text-[8px] font-black uppercase tracking-[0.6em]">System ID: {{ Auth::id() ?? 'SESSION_NULL' }}</p>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
