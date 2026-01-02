<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход | AniYume Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0A0A0A; color: #FFFFFF; overflow: hidden; }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .ani-glow { box-shadow: 0 0 80px rgba(46, 196, 182, 0.1); }

        .login-card {
            background: #111111;
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 32px;
            animation: zoomIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .form-input {
            background: #161616; border: 1px solid rgba(255,255,255,0.05);
            border-radius: 16px; padding: 1.25rem 1.25rem 1.25rem 3.5rem;
            transition: all 0.3s ease; width: 100%; font-weight: 700; color: #FFF;
        }
        .form-input:focus { outline: none; border-color: #2EC4B6; background: #1a1a1a; box-shadow: 0 0 25px rgba(46, 196, 182, 0.15); transform: translateY(-2px); }

        .btn-login {
            background: #2EC4B6; color: #000; border-radius: 16px;
            padding: 1.25rem; width: 100%; font-weight: 900;
            text-transform: uppercase; transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(46, 196, 182, 0.2); letter-spacing: 0.1em;
        }
        .btn-login:hover { transform: translateY(-3px); background: #26a69a; box-shadow: 0 15px 40px rgba(46, 196, 182, 0.4); }

        .input-icon { position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.2); pointer-events: none; transition: all 0.3s ease; }
        .form-group:focus-within .input-icon { color: #2EC4B6; }

        .logo-box {
            width: 70px; height: 70px; background: linear-gradient(135deg, #2EC4B6 0%, #26a69a 100%);
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            color: #000; font-weight: 900; font-size: 2rem; margin: 0 auto 1.5rem;
            box-shadow: 0 0 30px rgba(46, 196, 182, 0.4);
            transition: transform 0.5s ease;
        }
        .logo-box:hover { transform: rotate(10deg) scale(1.1); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="logo-box">A</div>
            <h1 class="text-3xl font-black uppercase italic tracking-tighter">AniYume <span class="text-[#2EC4B6]">Admin</span></h1>
            <p class="text-white/20 font-black text-[9px] uppercase tracking-[0.5em] mt-2">Secure Authentication Portal</p>
        </div>

        <div class="login-card p-8 md:p-10 ani-glow">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-3 animate-pulse">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div class="form-group relative">
                    <i data-lucide="mail" class="input-icon w-5 h-5"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="EMAIL ADDRESS" class="form-input uppercase text-[11px] tracking-widest">
                </div>

                <div class="form-group relative">
                    <i data-lucide="lock" class="input-icon w-5 h-5"></i>
                    <input type="password" name="password" required placeholder="PASSWORD" class="form-input uppercase text-[11px] tracking-widest">
                </div>

                <div class="flex items-center justify-between py-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-white/10 bg-[#161616] checked:bg-[#2EC4B6] transition-all">
                            <i data-lucide="check" class="absolute h-3 w-3 text-black opacity-0 peer-checked:opacity-100 left-1 pointer-events-none"></i>
                        </div>
                        <span class="text-[10px] font-black text-white/30 uppercase tracking-widest group-hover:text-white transition">Запомнить меня</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">Войти в панель</button>
            </form>
        </div>

        <p class="text-center mt-10 text-white/5 text-[8px] font-black uppercase tracking-[0.6em]">Terminal Access v2.4.0</p>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
