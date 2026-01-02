@extends('layouts.admin')
@section('page_title', 'Логи аудита')
@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-title {
        color: #FFF;
        font-weight: 900;
        font-size: clamp(1.5rem, 5vw, 2.5rem);
        text-transform: uppercase;
        letter-spacing: -0.05em;
        margin-bottom: 2rem;
        animation: fadeInUp 0.5s ease;
    }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .filter-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2.5rem;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }

    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; }
    .filter-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
    .filter-label i { width: 14px; height: 14px; color: #2EC4B6; }

    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem; transition: all 0.3s ease; font-size: 0.9rem; font-weight: 700; width: 100%; }
    .filter-input:focus, .filter-select:focus { outline: none; border-color: #2EC4B6; box-shadow: 0 0 15px rgba(46,196,182,0.1); }

    .btn-filter { background: #2EC4B6; color: #000; border: none; border-radius: 12px; padding: 1rem; font-weight: 900; cursor: pointer; transition: all 0.3s ease; font-size: 0.85rem; text-transform: uppercase; display: flex; align-items: center; gap: 0.5rem; justify-content: center; box-shadow: 0 0 20px rgba(46, 196, 182, 0.2); }
    .btn-filter:hover { transform: translateY(-2px); background: #26a69a; }

    .table-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        overflow-x: auto;
        animation: fadeInUp 0.5s ease 0.2s forwards;
        opacity: 0;
    }

    table { width: 100%; border-collapse: collapse; min-width: 900px; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    tbody tr { border-bottom: 1px solid rgba(255,255,255,0.02); transition: all 0.2s ease; }
    tbody tr:hover { background: rgba(255,255,255,0.02); }
    td { padding: 1.25rem 1.5rem; color: #FFF; font-size: 0.875rem; font-weight: 600; }

    .user-badge { display: flex; align-items: center; gap: 0.75rem; }
    .user-avatar { width: 36px; height: 36px; background: #161616; color: #2EC4B6; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 0.9rem; flex-shrink: 0; }
    .user-name { font-weight: 900; text-transform: uppercase; font-style: italic; }

    .action-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.1); letter-spacing: 0.05em; white-space: nowrap; }
    .action-badge.action-delete { color: #FF4D4D; background: rgba(255, 77, 77, 0.1); border-color: rgba(255, 77, 77, 0.2); }
    .action-badge.action-create { color: #2EC4B6; background: rgba(46, 196, 182, 0.1); border-color: rgba(46, 196, 182, 0.2); }

    .ip-text { font-family: 'JetBrains Mono', monospace; color: rgba(255,255,255,0.3); font-size: 0.75rem; font-weight: 700; }
    .date-text { color: rgba(255,255,255,0.5); font-size: 0.8rem; font-weight: 800; white-space: nowrap; }

    .pagination-container { margin-top: 3rem; display: flex; justify-content: center; }

    @media (max-width: 768px) {
        .filter-grid { grid-template-columns: 1fr; }
        .filter-card { padding: 1.25rem; }
        .btn-filter { width: 100%; }
    }
</style>

<h1 class="page-title">Аудит <span>Событий</span></h1>

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label"><i data-lucide="zap"></i> Тип действия</label>
            <select name="action" class="filter-select">
                <option value="">Все операции</option>
                @foreach($actions as $action)
                    <option value="{{ $action }}" {{ request('action') === $action ? 'selected' : '' }}>
                        {{ strtoupper(str_replace('_', ' ', $action)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label"><i data-lucide="calendar"></i> Период от</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="filter-input">
        </div>
        <div class="filter-group">
            <label class="filter-label"><i data-lucide="calendar"></i> Период до</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="filter-input">
        </div>
        <button type="submit" class="btn-filter"><i data-lucide="filter"></i> Применить</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Администратор</th>
                <th>Событие</th>
                <th>Лог данных</th>
                <th>IP / Хост</th>
                <th>Таймштамп</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>
                        <div class="user-badge">
                            <div class="user-avatar">{{ substr($log->user ? $log->user->name : 'S', 0, 1) }}</div>
                            <span class="user-name">{{ $log->user ? $log->user->name : 'SYSTEM' }}</span>
                        </div>
                    </td>
                    <td>
                        @php $actionClass = str_contains($log->action, 'delete') ? 'action-delete' : (str_contains($log->action, 'create') ? 'action-create' : ''); @endphp
                        <span class="action-badge {{ $actionClass }}">{{ str_replace('_', ' ', $log->action) }}</span>
                    </td>
                    <td style="max-width: 300px;"><div class="truncate font-bold text-white/60 italic">{{ $log->description }}</div></td>
                    <td><span class="ip-text">{{ $log->ip_address }}</span></td>
                    <td><span class="date-text">{{ $log->created_at->format('d.m / H:i') }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:5rem; color:rgba(255,255,255,0.2); font-weight: 900; text-transform: uppercase;">Записей не обнаружено</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $logs->links() }}
</div>
<script>lucide.createIcons();</script>
@endsection
