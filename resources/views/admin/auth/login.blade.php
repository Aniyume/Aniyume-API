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
        body { font-family: 'Inter', sans-serif; background-color: #0A0A0A; color: #FFFFFF; }
        .ani-glow { box-shadow: 0 0 50px rgba(46, 196, 182, 0.15); }
        .login-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; }
        
        .form-input { 
            background: #161616; border: 1px solid rgba(255,255,255,0.05); 
            border-radius: 14px; padding: 1.25rem 1.25rem 1.25rem 3.5rem; 
            transition: all 0.3s ease; width: 100%; font-weight: 700; color: #FFF;
        }
        .form-input:focus { outline: none; border-color: #2EC4B6; background: #1a1a1a; box-shadow: 0 0 20px rgba(46, 196, 182, 0.1); }
        
        .btn-login { 
            background: #2EC4B6; color: #000; border-radius: 14px; 
            padding: 1.25rem; width: 100%; font-weight: 900; 
            text-transform: uppercase; transition: all 0.3s ease; 
            box-shadow: 0 10px 30px rgba(46, 196, 182, 0.2); letter-spacing: 0.1em;
        }
        .btn-login:hover { transform: translateY(-3px); background: #26a69a; box-shadow: 0 15px 40px rgba(46, 196, 182, 0.3); }
        
        .input-icon { position: absolute; left: 1.25rem; top: 1.3rem; color: rgba(255,255,255,0.2); pointer-events: none; transition: all 0.3s ease; }
        .form-group:focus-within .input-icon { color: #2EC4B6; }
        
        .logo-box { 
            width: 80px; height: 80px; background: linear-gradient(135deg, #2EC4B6 0%, #26a69a 100%); 
            border-radius: 20px; display: flex; align-items: center; justify-content: center; 
            color: #000; font-weight: 900; font-size: 2.5rem; margin: 0 auto 1.5rem;
            box-shadow: 0 0 30px rgba(46, 196, 182, 0.4);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md animate-in fade-in zoom-in duration-700">
        <div class="text-center mb-10">
            <div class="logo-box">A</div>
            <h1 class="text-4xl font-black uppercase italic tracking-tighter">AniYume <span class="text-[#2EC4B6]">Admin</span></h1>
            <p class="text-white/30 font-black text-[10px] uppercase tracking-[0.4em] mt-3 italic">Restricted Access Area</p>
        </div>

        <div class="login-card p-10 ani-glow">
            @if($errors->any())
                <div class="mb-8 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl text-[11px] font-black uppercase tracking-widest flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="form-group relative">
                    <i data-lucide="mail" class="input-icon w-5 h-5"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="ADMIN EMAIL" class="form-input uppercase text-xs tracking-widest">
                </div>

                <div class="form-group relative">
                    <i data-lucide="lock" class="input-icon w-5 h-5"></i>
                    <input type="password" name="password" required placeholder="PASSWORD" class="form-input uppercase text-xs tracking-widest">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-white/10 bg-[#161616] checked:bg-[#2EC4B6] transition-all">
                            <i data-lucide="check" class="absolute h-3 w-3 text-black opacity-0 peer-checked:opacity-100 left-1 pointer-events-none"></i>
                        </div>
                        <span class="text-[10px] font-black text-white/40 uppercase tracking-widest group-hover:text-white transition">Запомнить сессию</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">Авторизоваться</button>
            </form>
        </div>

        <p class="text-center mt-12 text-white/10 text-[9px] font-black uppercase tracking-[0.5em]">© {{ date('Y') }} SYSTEM KERNEL v2.0</p>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>