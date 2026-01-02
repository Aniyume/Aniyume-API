@extends('layouts.admin')
@section('title', 'Импорт данных - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; font-style: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }
    .page-subtitle { color: rgba(255,255,255,0.3); font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.2em; margin-top: 10px; display: block; }

    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
    .stat-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; transition: 0.3s; position: relative; overflow: hidden; }
    .stat-card:hover { transform: translateY(-5px); border-color: rgba(46, 196, 182, 0.3); }
    
    .stat-card::after { content: ''; position: absolute; left: 0; top: 0; width: 4px; height: 100%; }
    .stat-card.cyan::after { background: #2EC4B6; }
    .stat-card.green::after { background: #49cc90; }
    .stat-card.red::after { background: #ff4d4d; }
    .stat-card.yellow::after { background: #ffc107; }

    .stat-label { color: rgba(255,255,255,0.4); font-size: 0.65rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.75rem; }
    .stat-value { font-size: 2.5rem; font-weight: 900; line-height: 1; letter-spacing: -0.05em; }
    .stat-value.cyan { color: #2EC4B6; }
    .stat-value.green { color: #49cc90; }
    .stat-value.red { color: #ff4d4d; }
    .stat-value.yellow { color: #ffc107; }

    .form-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 3rem; margin-bottom: 3rem; }
    .form-title { color: #FFF; font-weight: 900; font-size: 1.5rem; text-transform: uppercase; italic: italic; margin-bottom: 2rem; border-left: 4px solid #2EC4B6; padding-left: 15px; }
    
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1rem; display: block; }
    
    .form-select, .form-input { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 14px; padding: 1.25rem; font-size: 1rem; font-weight: 600; width: 100%; transition: 0.3s; }
    .form-select:focus, .form-input:focus { border-color: #2EC4B6; outline: none; box-shadow: 0 0 20px rgba(46, 196, 182, 0.1); }

    .info-box { background: rgba(46, 196, 182, 0.05); border: 1px solid rgba(46, 196, 182, 0.1); border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem; color: #2EC4B6; }
    .info-box-title { font-weight: 900; text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 8px; }
    .info-box ul { padding-left: 1.5rem; font-size: 0.85rem; font-weight: 500; }
    .info-box code { background: #000; padding: 2px 6px; border-radius: 4px; font-family: monospace; color: #FFF; }

    .btn-submit { background: #2EC4B6; color: #000; padding: 1.25rem 3rem; border-radius: 14px; border: none; font-weight: 900; cursor: pointer; text-transform: uppercase; transition: 0.3s; font-size: 0.9rem; letter-spacing: 0.1em; box-shadow: 0 0 30px rgba(46, 196, 182, 0.2); }
    .btn-submit:hover { transform: scale(1.02); box-shadow: 0 0 40px rgba(46, 196, 182, 0.4); }

    .status-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 3rem; margin-bottom: 3rem; }
    .status-header { background: #161616; border-radius: 16px; padding: 2rem; border-left: 5px solid transparent; }
    .status-header.completed { border-left-color: #49cc90; }
    .status-header.failed { border-left-color: #ff4d4d; }
    .status-header.running { border-left-color: #ffc107; }

    .status-badge { font-size: 2.5rem; font-weight: 900; text-transform: uppercase; font-style: italic; letter-spacing: -0.05em; }
    .status-badge.completed { color: #49cc90; }
    .status-badge.failed { color: #ff4d4d; }
    .status-badge.running { color: #ffc107; }

    .progress-bar { background: #000; border-radius: 50px; height: 12px; overflow: hidden; margin: 1.5rem 0; border: 1px solid rgba(255,255,255,0.05); }
    .progress-fill { background: #2EC4B6; height: 100%; border-radius: 50px; transition: width 0.5s ease; box-shadow: 0 0 15px #2EC4B6; }

    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
    .stats-item-label { color: rgba(255,255,255,0.3); font-size: 0.65rem; font-weight: 900; text-transform: uppercase; margin-bottom: 5px; }
    .stats-item-value { font-size: 1.5rem; font-weight: 900; color: #FFF; }
</style>

<div class="page-header">
    <h1 class="page-title">Система <span>Импорта</span></h1>
    <span class="page-subtitle">AniList API Integration Engine</span>
</div>

<div class="stats-grid">
    <div class="stat-card cyan">
        <div class="stat-label">Всего сессий</div>
        <div class="stat-value cyan">{{ $stats['total_imports'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Успешно</div>
        <div class="stat-value green">{{ $stats['successful_imports'] }}</div>
    </div>
    <div class="stat-card red">
        <div class="stat-label">Ошибки</div>
        <div class="stat-value red">{{ $stats['failed_imports'] }}</div>
    </div>
    <div class="stat-card yellow">
        <div class="stat-label">В работе</div>
        <div class="stat-value yellow">{{ $stats['running_imports'] }}</div>
    </div>
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
                <input type="text" name="description" placeholder="..." class="form-input">
            </div>
        </div>

        <div class="info-box">
            <div class="info-box-title"><i data-lucide="alert-triangle"></i> Внимание перед запуском</div>
            <ul>
                <li>Worker очереди должен быть активен: <code>php artisan queue:work</code></li>
                <li>Среднее время обработки одного пака: ~45-90 сек.</li>
            </ul>
        </div>

        <button type="submit" class="btn-submit" onclick="return confirm('Запустить процесс импорта?')">
            Инициализировать импорт
        </button>
    </form>
</div>

@if($latestImport)
<div class="status-card">
    <h2 class="form-title">Мониторинг последней задачи</h2>
    @php
        $progressPercent = $latestImport->total_processed > 0 
            ? round(($latestImport->total_created + $latestImport->total_updated + $latestImport->total_skipped) / $latestImport->total_processed * 100) 
            : 0;
    @endphp

    <div class="status-header {{ $latestImport->status }}">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div>
                <div class="status-badge {{ $latestImport->status }}">{{ $latestImport->status }}</div>
                <div style="font-weight: 900; color: rgba(255,255,255,0.4); text-transform: uppercase; font-size: 0.7rem; margin-top: 5px;">
                    Type: {{ $latestImport->import_type }} / ID: #{{ $latestImport->id }}
                </div>
            </div>
            <a href="{{ route('admin.import.logs') }}" style="color: #2EC4B6; font-weight: 900; text-transform: uppercase; text-decoration: none; font-size: 0.8rem;">История логов →</a>
        </div>

        @if($latestImport->status === 'running')
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $progressPercent }}%"></div>
        </div>
        @endif

        <div class="stats-row">
            <div class="stats-item"><div class="stats-item-label">Target</div><div class="stats-item-value">{{ $latestImport->total_processed }}</div></div>
            <div class="stats-item"><div class="stats-item-label">Created</div><div class="stats-item-value" style="color:#49cc90">{{ $latestImport->total_created }}</div></div>
            <div class="stats-item"><div class="stats-item-label">Updated</div><div class="stats-item-value" style="color:#2EC4B6">{{ $latestImport->total_updated }}</div></div>
            <div class="stats-item"><div class="stats-item-label">Skipped</div><div class="stats-item-value" style="color:#ffc107">{{ $latestImport->total_skipped }}</div></div>
        </div>
    </div>
</div>
@endif
@endsection