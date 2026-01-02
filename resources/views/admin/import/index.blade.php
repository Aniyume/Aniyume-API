@extends('layouts.admin')
@section('title', 'Импорт данных - AniYume Админ')
@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header { margin-bottom: 2.5rem; animation: fadeInUp 0.5s ease; }
    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 5vw, 2.5rem); text-transform: uppercase; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }
    .page-subtitle { color: rgba(255,255,255,0.3); font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.3em; margin-top: 8px; display: block; }

    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
    .stat-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 1.5rem;
        transition: 0.3s;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; border-left: 4px solid #2EC4B6; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; border-left: 4px solid #49cc90; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; border-left: 4px solid #ff4d4d; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; border-left: 4px solid #ffc107; }

    .stat-label { color: rgba(255,255,255,0.4); font-size: 0.6rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem; }
    .stat-value { font-size: 2rem; font-weight: 900; line-height: 1; }

    .form-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 24px;
        padding: clamp(1.5rem, 5vw, 3rem);
        margin-bottom: 3rem;
        animation: fadeInUp 0.5s ease 0.5s forwards;
        opacity: 0;
    }

    .form-title { color: #FFF; font-weight: 900; font-size: 1.25rem; text-transform: uppercase; margin-bottom: 2rem; border-left: 4px solid #2EC4B6; padding-left: 15px; }
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.8rem; display: block; }
    .form-select, .form-input { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 14px; padding: 1.1rem; font-size: 0.95rem; font-weight: 600; width: 100%; transition: 0.3s; }
    .form-select:focus, .form-input:focus { border-color: #2EC4B6; outline: none; }

    .info-box { background: rgba(46, 196, 182, 0.05); border: 1px solid rgba(46, 196, 182, 0.1); border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem; color: #2EC4B6; font-size: 0.85rem; }
    .btn-submit { background: #2EC4B6; color: #000; padding: 1.1rem 2.5rem; border-radius: 14px; border: none; font-weight: 900; cursor: pointer; text-transform: uppercase; transition: 0.3s; font-size: 0.85rem; width: 100%; max-width: 300px; box-shadow: 0 10px 20px rgba(46, 196, 182, 0.2); }
    .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(46, 196, 182, 0.4); }

    .status-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 2rem; animation: fadeInUp 0.5s ease 0.6s forwards; opacity: 0; }
    .progress-bar { background: #000; border-radius: 50px; height: 10px; overflow: hidden; margin: 1.5rem 0; border: 1px solid rgba(255,255,255,0.05); }
    .progress-fill { background: linear-gradient(90deg, #2EC4B6, #26a69a); height: 100%; border-radius: 50px; transition: width 1s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 0 15px rgba(46, 196, 182, 0.5); }

    .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 1rem; }
    .stats-item-label { color: rgba(255,255,255,0.3); font-size: 0.6rem; font-weight: 900; text-transform: uppercase; margin-bottom: 4px; }
    .stats-item-value { font-size: 1.25rem; font-weight: 900; color: #FFF; }

    @media (max-width: 640px) {
        .btn-submit { max-width: 100%; }
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Система <span>Импорта</span></h1>
    <span class="page-subtitle">AniList API Integration Engine</span>
</div>

<div class="stats-grid">
    <div class="stat-card"><div class="stat-label">Всего сессий</div><div class="stat-value" style="color:#2EC4B6">{{ $stats['total_imports'] }}</div></div>
    <div class="stat-card"><div class="stat-label">Успешно</div><div class="stat-value" style="color:#49cc90">{{ $stats['successful_imports'] }}</div></div>
    <div class="stat-card"><div class="stat-label">Ошибки</div><div class="stat-value" style="color:#ff4d4d">{{ $stats['failed_imports'] }}</div></div>
    <div class="stat-card"><div class="stat-label">В работе</div><div class="stat-value" style="color:#ffc107">{{ $stats['running_imports'] }}</div></div>
</div>

<div class="form-card">
    <h2 class="form-title">Запуск синхронизации</h2>
    <form action="{{ route('admin.import.run') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Метод обработки</label>
                <select name="type" required class="form-select">
                    <option value="initial">ТОЛЬКО НОВЫЕ (INITIAL)</option>
                    <option value="update">ПОЛНОЕ ОБНОВЛЕНИЕ (FORCE)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Комментарий к логу</label>
                <input type="text" name="description" placeholder="Напр: Еженедельное обновление" class="form-input">
            </div>
        </div>

        <div class="info-box">
            <div style="font-weight: 900; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="info" style="width:16px"></i> ПАМЯТКА
            </div>
            Процесс выполняется в фоновом режиме. Убедитесь, что очереди Laravel запущены.
        </div>

        <button type="submit" class="btn-submit" onclick="return confirm('Запустить импорт?')">Начать процесс</button>
    </form>
</div>

@if($latestImport)
<div class="status-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <span style="font-weight: 900; text-transform: uppercase; font-size: 0.7rem; color: #2EC4B6;">Последняя задача #{{ $latestImport->id }}</span>
            <h3 style="font-weight: 900; text-transform: uppercase; font-style: italic; font-size: 1.5rem; color: {{ $latestImport->status === 'running' ? '#ffc107' : ($latestImport->status === 'completed' ? '#49cc90' : '#ff4d4d') }}">
                {{ strtoupper($latestImport->status) }}
            </h3>
        </div>
        <a href="{{ route('admin.import.logs') }}" style="color: rgba(255,255,255,0.4); font-weight: 800; text-transform: uppercase; font-size: 0.7rem; text-decoration: none; border-bottom: 1px dashed rgba(255,255,255,0.2);">История логов →</a>
    </div>

    @php
        $progress = $latestImport->total_processed > 0
            ? round(($latestImport->total_created + $latestImport->total_updated + $latestImport->total_skipped) / $latestImport->total_processed * 100)
            : 0;
    @endphp

    @if($latestImport->status === 'running')
    <div class="progress-bar"><div class="progress-fill" style="width: {{ $progress }}%"></div></div>
    @endif

    <div class="stats-row">
        <div class="stats-item"><div class="stats-item-label">Цель</div><div class="stats-item-value">{{ $latestImport->total_processed }}</div></div>
        <div class="stats-item"><div class="stats-item-label">Создано</div><div class="stats-item-value" style="color:#49cc90">{{ $latestImport->total_created }}</div></div>
        <div class="stats-item"><div class="stats-item-label">Обновлено</div><div class="stats-item-value" style="color:#2EC4B6">{{ $latestImport->total_updated }}</div></div>
        <div class="stats-item"><div class="stats-item-label">Пропущено</div><div class="stats-item-value" style="color:#ffc107">{{ $latestImport->total_skipped }}</div></div>
    </div>
</div>
@endif
<script>lucide.createIcons();</script>
@endsection
