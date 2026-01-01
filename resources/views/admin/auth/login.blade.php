<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - AniYume Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfdfe; }
        .turquoise-gradient { background: linear-gradient(135deg, #00f2ea 0%, #00d1ca 100%); }
        .login-card { background: white; border: 1px solid #f0f2f5; border-radius: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.03); }
        .form-input { background: #f4f4f4; border: 2px solid transparent; border-radius: 1rem; padding: 1rem 1rem 1rem 3rem; transition: all 0.2s ease; width: 100%; font-weight: 600; }
        .form-input:focus { outline: none; border-color: #00f2ea; background: white; box-shadow: 0 0 0 4px rgba(0, 242, 234, 0.1); }
        .btn-login { background: #00f2ea; color: white; border-radius: 1rem; padding: 1rem; width: 100%; font-weight: 800; transition: all 0.2s ease; box-shadow: 0 10px 20px rgba(0, 242, 234, 0.2); }
        .btn-login:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 15px 30px rgba(0, 242, 234, 0.3); }
        .input-icon { position: absolute; left: 1.25rem; top: 1.15rem; color: #9ca3af; pointer-events: none; transition: all 0.2s ease; }
        .form-group:focus-within .input-icon { color: #00f2ea; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="w-16 h-16 turquoise-gradient rounded-2xl flex items-center justify-center text-white font-black text-3xl mx-auto mb-6 shadow-xl shadow-cyan-100">A</div>
            <h1 class="text-3xl font-black text-gray-900">AniYume <span class="text-[#00f2ea]">Admin</span></h1>
            <p class="text-gray-400 font-bold mt-2">Панель управления контентом</p>
        </div>

        <div class="login-card p-10">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-500 rounded-xl text-sm font-bold flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="form-group relative">
                    <i data-lucide="mail" class="input-icon w-5 h-5"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email адрес" class="form-input">
                </div>

                <div class="form-group relative">
                    <i data-lucide="lock" class="input-icon w-5 h-5"></i>
                    <input type="password" name="password" required placeholder="Пароль" class="form-input">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-2 border-gray-200 text-[#00f2ea] focus:ring-[#00f2ea] transition cursor-pointer">
                        <span class="text-sm font-bold text-gray-500 group-hover:text-gray-700 transition">Запомнить меня</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">Войти в панель</button>
            </form>
        </div>

        <p class="text-center mt-10 text-gray-300 text-xs font-bold uppercase tracking-widest">© {{ date('Y') }} AniYume Team</p>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
