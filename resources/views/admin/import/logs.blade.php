@extends('layouts.admin')
@section('title', 'Логи импорта - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title-block h1 { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .page-subtitle { color: #6f767e; font-size: 0.9rem; margin-top: 0.5rem; }
    .btn-back { background: #00f2ea; color: #ffffff; padding: 0.75rem 1.5rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-back:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .table-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); margin-bottom: 2rem; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #fcfdfe; }
    th { color: #6f767e; padding: 1.25rem 1.5rem; text-align: left; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f0f2f5; }
    th.text-center { text-align: center; }
    tbody tr { border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease; }
    tbody tr:hover { background: #fcfdfe; }
    td { padding: 1.25rem 1.5rem; color: #1a1d1f; font-size: 0.9rem; font-weight: 500; }
    td.text-center { text-align: center; }
    .log-id { color: #00f2ea; font-weight: 700; }
    .type-badge { background: #f0fdfa; color: #0d9488; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
    .status-badge { padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
    .status-completed { background: #f0fdf4; color: #16a34a; }
    .status-failed { background: #fef2f2; color: #dc2626; }
    .status-running { background: #fffbeb; color: #d97706; }
    .count-cell { font-weight: 700; font-size: 1.125rem; }
    .count-cell.green { color: #16a34a; }
    .count-cell.blue { color: #00f2ea; }
    .count-cell.orange { color: #d97706; }
    .date-cell { font-size: 0.85rem; }
    .date-main { font-weight: 700; color: #1a1d1f; }
    .date-sub { color: #6f767e; }
    .duration-cell { font-size: 0.85rem; font-weight: 700; }
    .duration-main { color: #0d9488; }
    .duration-sub { color: #6f767e; font-weight: 500; }
    .duration-running { color: #d97706; }
    .error-row { background: #fef2f2; border-left: 4px solid #dc2626; }
    .error-content { display: flex; gap: 0.75rem; padding: 1rem 1.5rem; }
    .error-title { color: #dc2626; font-weight: 700; margin-bottom: 0.5rem; }
    .error-box { background: #ffffff; padding: 1rem; border-radius: 0.5rem; border: 1px solid #fecaca; overflow-x: auto; flex: 1; }
    .error-box pre { color: #dc2626; font-size: 0.75rem; margin: 0; font-family: monospace; }
    .empty-state { padding: 4rem 1.25rem; text-align: center; }
    .empty-emoji { font-size: 3.75rem; margin-bottom: 1rem; display: block; }
    .empty-title { color: #1a1d1f; font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem; }
    .empty-text { color: #6f767e; margin-bottom: 1.5rem; }
    .btn-primary { background: #00f2ea; color: #ffffff; padding: 0.75rem 1.5rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-primary:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .pagination-container { margin-top: 0; display: flex; justify-content: center; background: #fcfdfe; padding: 1.5rem; border-top: 1px solid #f0f2f5; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
    .stat-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .stat-card.cyan { border-left: 4px solid #00f2ea; }
    .stat-card.green { border-left: 4px solid #16a34a; }
    .stat-card.red { border-left: 4px solid #dc2626; }
    .stat-card.yellow { border-left: 4px solid #d97706; }
    .stat-label { color: #6f767e; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.5rem; }
    .stat-value { color: #1a1d1f; font-size: 2rem; font-weight: 800; }
    .stat-value.cyan { color: #00f2ea; }
    .stat-value.green { color: #16a34a; }
    .stat-value.red { color: #dc2626; }
    .stat-value.yellow { color: #d97706; }
    @media (max-width: 1024px) {
        th, td { padding: 0.875rem; font-size: 0.8rem; }
        .count-cell { font-size: 1rem; }
    }
    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-back { width: 100%; justify-content: center; }
        .table-container { overflow-x: auto; }
        table { min-width: 1000px; }
        .stats-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-header">
    <div class="page-title-block">
        <h1>Логи импорта</h1>
        <p class="page-subtitle">Детальная история всех операций импорта</p>
    </div>
    <a href="{{ route('admin.import.index') }}" class="btn-back">← Назад к импорту</a>
</div>

<div class="table-container">
    @if($logs->count() > 0)
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Тип</th>
                <th>Статус</th>
                <th class="text-center">Обработано</th>
                <th class="text-center">Создано</th>
                <th class="text-center">Обновлено</th>
                <th class="text-center">Пропущено</th>
                <th>Начато</th>
                <th>Длительность</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td><span class="log-id">#{{ $log->id }}</span></td>
                <td>
                    <span class="type-badge">
                        {{ $log->import_type === 'initial' ? 'Новый' : 'Обновление' }}
                    </span>
                </td>
                <td>
                    <span class="status-badge status-{{ $log->status }}">
                        @if($log->status === 'completed') Завершено
                        @elseif($log->status === 'failed') Ошибка
                        @elseif($log->status === 'running') Выполняется
                        @else {{ ucfirst($log->status) }}
                        @endif
                    </span>
                </td>
                <td class="text-center count-cell">{{ number_format($log->total_processed) }}</td>
                <td class="text-center count-cell green">{{ number_format($log->total_created) }}</td>
                <td class="text-center count-cell blue">{{ number_format($log->total_updated) }}</td>
                <td class="text-center count-cell orange">{{ number_format($log->total_skipped) }}</td>
                <td class="date-cell">
                    <div class="date-main">{{ $log->started_at->format('d.m.Y') }}</div>
                    <div class="date-sub">{{ $log->started_at->format('H:i:s') }}</div>
                </td>
                <td class="duration-cell">
                    @if($log->finished_at)
                        <div class="duration-main">{{ $log->started_at->diffInMinutes($log->finished_at) }}м {{ $log->started_at->diff($log->finished_at)->format('%s') }}с</div>
                        <div class="duration-sub">{{ $log->finished_at->diffForHumans() }}</div>
                    @else
                        <div class="duration-running">В процессе...</div>
                    @endif
                </td>
            </tr>
            @if($log->errors)
            <tr class="error-row">
                <td colspan="9">
                    <div class="error-content">
                        <div style="flex: 1;">
                            <div class="error-title">Ошибки импорта</div>
                            <div class="error-box">
                                <pre>{{ $log->errors }}</pre>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container">
        {{ $logs->links('pagination::tailwind') }}
    </div>
    @else
    <div class="empty-state">
        <span class="empty-emoji">📊</span>
        <div class="empty-title">Логи импорта не найдены</div>
        <p class="empty-text">История импорта появится здесь после первого запуска импорта</p>
        <a href="{{ route('admin.import.index') }}" class="btn-primary">Начать первый импорт</a>
    </div>
    @endif
</div>

<div class="stats-grid">
    <div class="stat-card cyan">
        <div class="stat-label">Всего импортов</div>
        <div class="stat-value cyan">{{ $logs->total() }}</div>
    </div>

    <div class="stat-card green">
        <div class="stat-label">Успешных</div>
        <div class="stat-value green">{{ $logs->where('status', 'completed')->count() }}</div>
    </div>

    <div class="stat-card red">
        <div class="stat-label">С ошибками</div>
        <div class="stat-value red">{{ $logs->where('status', 'failed')->count() }}</div>
    </div>

    <div class="stat-card yellow">
        <div class="stat-label">Процент успеха</div>
        @php
            $completed = $logs->where('status', 'completed')->count();
            $total = $logs->count();
            $rate = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp
        <div class="stat-value yellow">{{ $rate }}%</div>
    </div>
</div>
@endsection
