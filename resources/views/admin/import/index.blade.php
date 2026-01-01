@extends('layouts.admin')
@section('title', 'Управление импортом - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 2.5rem; }
    .page-title { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .page-subtitle { color: #6f767e; font-size: 0.9rem; margin-top: 0.5rem; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .stat-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); transition: all 0.2s ease; }
    .stat-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.04); transform: translateY(-2px); }
    .stat-card.cyan { border-left: 4px solid #00f2ea; }
    .stat-card.green { border-left: 4px solid #16a34a; }
    .stat-card.red { border-left: 4px solid #dc2626; }
    .stat-card.yellow { border-left: 4px solid #d97706; }
    .stat-label { color: #6f767e; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .stat-value { color: #1a1d1f; font-size: 2.5rem; font-weight: 800; line-height: 1; }
    .stat-value.cyan { color: #00f2ea; }
    .stat-value.green { color: #16a34a; }
    .stat-value.red { color: #dc2626; }
    .stat-value.yellow { color: #d97706; }
    .stat-badge { color: #6f767e; font-size: 0.7rem; margin-top: 0.5rem; }
    .form-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .form-title { color: #1a1d1f; font-weight: 800; font-size: 1.5rem; margin-bottom: 1.5rem; }
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { display: flex; flex-direction: column; }
    .form-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem; }
    .form-select, .form-input { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.875rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .form-select:focus, .form-input:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .form-hint { color: #6f767e; font-size: 0.8rem; margin-top: 0.75rem; line-height: 1.5; }
    .form-hint strong { color: #1a1d1f; font-weight: 700; }
    .info-box { background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem; display: flex; gap: 0.75rem; }
    .info-box-content { color: #0d9488; font-size: 0.85rem; }
    .info-box-title { font-weight: 700; margin-bottom: 0.375rem; color: #0d9488; }
    .info-box ul { margin: 0.375rem 0 0 1.25rem; padding: 0; }
    .info-box li { margin-bottom: 0.25rem; }
    .info-box code { background: #ffffff; padding: 0.125rem 0.375rem; border-radius: 0.25rem; font-family: monospace; font-size: 0.8rem; }
    .btn-submit { background: #00f2ea; color: #ffffff; padding: 0.875rem 2rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 1rem; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-submit:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .status-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .status-title { color: #1a1d1f; font-weight: 800; font-size: 1.5rem; margin-bottom: 1.5rem; }
    .status-header { background: #fcfdfe; border: 1px solid #f0f2f5; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem; }
    .status-header.completed { background: #f0fdf4; border-color: #d1fae5; }
    .status-header.failed { background: #fef2f2; border-color: #fecaca; }
    .status-header.running { background: #fffbeb; border-color: #fde68a; }
    .status-main { display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem; }
    .status-badge { font-size: 2rem; font-weight: 800; margin-bottom: 0.5rem; }
    .status-badge.completed { color: #16a34a; }
    .status-badge.failed { color: #dc2626; }
    .status-badge.running { color: #d97706; }
    .status-type { color: #6f767e; font-size: 0.85rem; text-transform: capitalize; }
    .status-link { color: #00f2ea; text-decoration: none; font-weight: 700; font-size: 0.85rem; }
    .status-link:hover { color: #00d1ca; text-decoration: underline; }
    .progress-bar { background: #f4f4f4; border-radius: 0.5rem; height: 1rem; overflow: hidden; margin-bottom: 1rem; }
    .progress-fill { background: #00f2ea; height: 100%; border-radius: 0.5rem; transition: width 0.3s ease; }
    .progress-label { display: flex; justify-content: space-between; color: #6f767e; font-size: 0.8rem; font-weight: 700; margin-bottom: 0.5rem; }
    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem; font-size: 0.85rem; }
    .stats-item { display: flex; flex-direction: column; }
    .stats-item-label { color: #6f767e; font-size: 0.7rem; margin-bottom: 0.25rem; }
    .stats-item-value { font-size: 1.5rem; font-weight: 800; }
    .stats-item-value.green { color: #16a34a; }
    .stats-item-value.blue { color: #00f2ea; }
    .stats-item-value.orange { color: #d97706; }
    .meta-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-top: 1.5rem; }
    .meta-item { background: #fcfdfe; border: 1px solid #f0f2f5; border-radius: 0.75rem; padding: 1rem; }
    .meta-label { color: #6f767e; font-size: 0.75rem; margin-bottom: 0.375rem; }
    .meta-value { color: #1a1d1f; font-weight: 700; font-size: 0.95rem; }
    .meta-sub { color: #6f767e; font-size: 0.7rem; margin-top: 0.25rem; }
    .error-box { background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; padding: 1rem; margin-top: 1.5rem; }
    .error-title { color: #dc2626; font-weight: 700; margin-bottom: 0.5rem; }
    .error-content { background: #ffffff; padding: 0.75rem; border-radius: 0.5rem; overflow-x: auto; }
    .error-content pre { color: #dc2626; font-size: 0.75rem; margin: 0; font-family: monospace; }
    .history-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .history-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .history-title { color: #1a1d1f; font-weight: 800; font-size: 1.5rem; }
    .history-link { color: #00f2ea; text-decoration: none; font-weight: 700; }
    .history-link:hover { color: #00d1ca; text-decoration: underline; }
    .history-empty { text-align: center; padding: 3rem 1.25rem; color: #6f767e; }
    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
        .form-grid { grid-template-columns: 1fr; }
        .stats-row { grid-template-columns: repeat(2, 1fr); }
        .meta-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Управление импортом</h1>
    <p class="page-subtitle">Управление импортом аниме и эпизодов из AniList</p>
</div>

<div class="stats-grid">
    <div class="stat-card cyan">
        <div class="stat-label">Всего импортов</div>
        <div class="stat-value cyan">{{ $stats['total_imports'] }}</div>
        <div class="stat-badge">За все время</div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Успешных</div>
        <div class="stat-value green">{{ $stats['successful_imports'] }}</div>
        <div class="stat-badge">Завершено</div>
    </div>
    <div class="stat-card red">
        <div class="stat-label">Ошибок</div>
        <div class="stat-value red">{{ $stats['failed_imports'] }}</div>
        <div class="stat-badge">С ошибками</div>
    </div>
    <div class="stat-card yellow">
        <div class="stat-label">Выполняется</div>
        <div class="stat-value yellow">{{ $stats['running_imports'] }}</div>
        <div class="stat-badge">В процессе</div>
    </div>
</div>

<div class="form-card">
    <h2 class="form-title">Начать новый импорт</h2>

    <form action="{{ route('admin.import.run') }}" method="POST">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Тип импорта</label>
                <select name="type" required class="form-select">
                    <option value="initial">Начальный импорт (только новые)</option>
                    <option value="update">Обновление (обновить все данные)</option>
                </select>
                <p class="form-hint">
                    <strong>Начальный:</strong> Загружает только новые аниме из AniList<br>
                    <strong>Обновление:</strong> Обновляет данные для всех существующих аниме
                </p>
            </div>

            <div class="form-group">
                <label class="form-label">Описание (необязательно)</label>
                <input type="text" name="description" placeholder="например: Еженедельное обновление..."
                       class="form-input">
            </div>
        </div>

        <div class="info-box">
            <div class="info-box-content">
                <div class="info-box-title">Перед началом импорта:</div>
                <ul>
                    <li>Убедитесь, что запущен worker очереди Laravel: <code>php artisan queue:work</code></li>
                    <li>Процесс может занять несколько минут в зависимости от объёма данных</li>
                    <li>Вы можете проверить прогресс в разделе "Статус последнего импорта" ниже</li>
                </ul>
            </div>
        </div>

        <div>
            <button type="submit" class="btn-submit"
                    onclick="return confirm('Начать импорт?\n\nУбедитесь, что worker очереди запущен!\nphp artisan queue:work');">
                Начать импорт
            </button>
        </div>
    </form>
</div>

@if($latestImport)
<div class="status-card">
    <h2 class="status-title">Статус последнего импорта</h2>

    @php
        $progressPercent = 0;
        if ($latestImport->total_processed > 0) {
            $progressPercent = round(($latestImport->total_created + $latestImport->total_updated + $latestImport->total_skipped) / $latestImport->total_processed * 100);
        }
    @endphp

    <div class="status-header {{ $latestImport->status }}">
        <div class="status-main">
            <div>
                <div class="status-badge {{ $latestImport->status }}">
                    @if($latestImport->status === 'completed') Завершено
                    @elseif($latestImport->status === 'failed') Ошибка
                    @elseif($latestImport->status === 'running') Выполняется
                    @else {{ ucfirst($latestImport->status) }}
                    @endif
                </div>
                <div class="status-type">{{ $latestImport->import_type === 'initial' ? 'Начальный' : 'Обновление' }} импорт</div>
            </div>
            <a href="{{ route('admin.import.logs') }}" class="status-link">Все логи →</a>
        </div>

        @if($latestImport->status === 'running')
        <div>
            <div class="progress-label">
                <span>Прогресс</span>
                <span>{{ $progressPercent }}%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $progressPercent }}%"></div>
            </div>
        </div>
        @endif

        <div class="stats-row">
            <div class="stats-item">
                <div class="stats-item-label">Обработано</div>
                <div class="stats-item-value">{{ number_format($latestImport->total_processed) }}</div>
            </div>
            <div class="stats-item">
                <div class="stats-item-label">Создано</div>
                <div class="stats-item-value green">{{ number_format($latestImport->total_created) }}</div>
            </div>
            <div class="stats-item">
                <div class="stats-item-label">Обновлено</div>
                <div class="stats-item-value blue">{{ number_format($latestImport->total_updated) }}</div>
            </div>
            <div class="stats-item">
                <div class="stats-item-label">Пропущено</div>
                <div class="stats-item-value orange">{{ number_format($latestImport->total_skipped) }}</div>
            </div>
        </div>
    </div>

    <div class="meta-grid">
        <div class="meta-item">
            <div class="meta-label">Начато</div>
            <div class="meta-value">{{ $latestImport->started_at->format('d.m.Y H:i') }}</div>
            <div class="meta-sub">{{ $latestImport->started_at->diffForHumans() }}</div>
        </div>

        @if($latestImport->finished_at)
        <div class="meta-item">
            <div class="meta-label">Завершено</div>
            <div class="meta-value">{{ $latestImport->finished_at->format('d.m.Y H:i') }}</div>
            <div class="meta-sub">{{ $latestImport->finished_at->diffForHumans() }}</div>
        </div>

        <div class="meta-item">
            <div class="meta-label">Длительность</div>
            <div class="meta-value">{{ $latestImport->started_at->diffInMinutes($latestImport->finished_at) }}м {{ $latestImport->started_at->diff($latestImport->finished_at)->format('%s') }}с</div>
            <div class="meta-sub">Время выполнения</div>
        </div>

        <div class="meta-item">
            <div class="meta-label">Скорость</div>
            <div class="meta-value">{{ $latestImport->total_processed > 0 ? round($latestImport->total_processed / max(1, $latestImport->started_at->diffInSeconds($latestImport->finished_at)), 1) : 0 }} эл/сек</div>
            <div class="meta-sub">Пропускная способность</div>
        </div>
        @endif
    </div>

    @if($latestImport->errors)
    <div class="error-box">
        <div class="error-title">Ошибки</div>
        <div class="error-content">
            <pre>{{ $latestImport->errors }}</pre>
        </div>
    </div>
    @endif
</div>
@endif

<div class="history-card">
    <div class="history-header">
        <h2 class="history-title">История импорта (последние 5)</h2>
        <a href="{{ route('admin.import.logs') }}" class="history-link">Все логи →</a>
    </div>

    <p class="history-empty">
        Детальная история импорта и логи доступны на <a href="{{ route('admin.import.logs') }}" class="history-link">странице логов импорта</a>
    </p>
</div>
@endsection
