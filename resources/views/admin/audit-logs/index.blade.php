@extends('layouts.admin')
@section('page_title', 'Логи аудита')
@section('content')
<style>
    .filter-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; }
    .filter-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.625rem; display: flex; align-items: center; gap: 0.5rem; }
    .filter-label i { width: 14px; height: 14px; color: #00f2ea; }
    .filter-input, .filter-select { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .filter-input:focus, .filter-select:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .btn-filter { background: #00f2ea; color: #ffffff; border: none; border-radius: 0.75rem; padding: 0.75rem 1.25rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; justify-content: center; box-shadow: 0 4px 12px rgba(0, 242, 234, 0.2); }
    .btn-filter:hover { background: #00d1ca; transform: translateY(-1px); }
    .table-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #fcfdfe; }
    th { color: #6f767e; padding: 1.25rem 1.5rem; text-align: left; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f0f2f5; }
    tbody tr { border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease; }
    tbody tr:hover { background: #fcfdfe; }
    td { padding: 1.25rem 1.5rem; color: #1a1d1f; font-size: 0.875rem; font-weight: 500; }
    .user-badge { display: flex; align-items: center; gap: 0.75rem; }
    .user-avatar { width: 32px; height: 32px; background: #f0fdfa; color: #0d9488; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; }
    .action-badge { padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .ip-text { font-family: monospace; color: #6f767e; font-size: 0.8rem; }
    .date-text { color: #6f767e; font-size: 0.8rem; font-weight: 600; }
    .pagination-container { margin-top: 2.5rem; display: flex; justify-content: center; }
</style>

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label"><i data-lucide="zap"></i> Действие</label>
            <select name="action" class="filter-select">
                <option value="">Все действия</option>
                @foreach($actions as $action)
                    <option value="{{ $action }}" {{ request('action') === $action ? 'selected' : '' }}>
                        {{ str_replace('_', ' ', ucfirst($action)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label"><i data-lucide="calendar"></i> От</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="filter-input">
        </div>
        <div class="filter-group">
            <label class="filter-label"><i data-lucide="calendar"></i> До</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="filter-input">
        </div>
        <button type="submit" class="btn-filter"><i data-lucide="filter"></i> Фильтровать</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Пользователь</th>
                <th>Действие</th>
                <th>Описание</th>
                <th>IP Адрес</th>
                <th>Дата</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>
                        <div class="user-badge">
                            <div class="user-avatar">{{ substr($log->user ? $log->user->name : 'S', 0, 1) }}</div>
                            <span class="font-bold">{{ $log->user ? $log->user->name : 'Система' }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="action-badge">{{ str_replace('_', ' ', $log->action) }}</span>
                    </td>
                    <td class="max-w-xs truncate font-medium text-gray-600">{{ $log->description }}</td>
                    <td><span class="ip-text">{{ $log->ip_address }}</span></td>
                    <td><span class="date-text">{{ $log->created_at->format('d.m.Y H:i') }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:4rem; color:#6f767e">Логи не найдены</td>
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
