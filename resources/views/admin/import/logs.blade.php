@extends('layouts.admin')
@section('title', 'Архив логов - AniYume Админ')
@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        gap: 1.5rem;
        flex-wrap: wrap;
        animation: fadeInUp 0.5s ease;
    }

    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 5vw, 2.5rem); text-transform: uppercase; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .btn-back {
        background: #161616;
        color: #2EC4B6;
        border: 1px solid rgba(46, 196, 182, 0.2);
        padding: 0.8rem 1.25rem;
        border-radius: 12px;
        font-weight: 900;
        text-transform: uppercase;
        text-decoration: none;
        font-size: 0.75rem;
        transition: 0.3s;
    }
    .btn-back:hover { background: #2EC4B6; color: #000; }

    .table-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        overflow-x: auto;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }

    table { width: 100%; border-collapse: collapse; min-width: 900px; }
    th { color: rgba(255,255,255,0.3); padding: 1.25rem 1.5rem; text-align: left; font-weight: 900; font-size: 0.65rem; text-transform: uppercase; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.25rem 1.5rem; color: #FFF; font-size: 0.85rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .status-badge { padding: 5px 10px; border-radius: 6px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; }
    .status-completed { background: rgba(73, 204, 144, 0.1); color: #49cc90; }
    .status-failed { background: rgba(255, 77, 77, 0.1); color: #ff4d4d; }
    .status-running { background: rgba(255, 193, 7, 0.1); color: #ffc107; }

    .error-pre {
        background: #000;
        color: #ff4d4d;
        padding: 1rem;
        border-radius: 12px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        border: 1px solid rgba(255, 77, 77, 0.1);
        margin-top: 0.5rem;
        white-space: pre-wrap;
        max-height: 200px;
        overflow-y: auto;
    }

    .pagination-wrapper { margin-top: 2.5rem; display: flex; justify-content: center; }
    nav[role="navigation"] { display: flex; gap: 0.5rem; }
    nav[role="navigation"] a, nav[role="navigation"] span { background: #111 !important; border: 1px solid rgba(255,255,255,0.1) !important; color: #fff !important; padding: 0.75rem 1rem !important; border-radius: 10px !important; text-decoration: none !important; font-weight: 800 !important; font-size: 0.8rem !important; }
    nav[role="navigation"] .active span { background: #2EC4B6 !important; color: #000 !important; }
</style>

<div class="page-header">
    <h1 class="page-title">Архив <span>Логов</span></h1>
    <a href="{{ route('admin.import.index') }}" class="btn-back">← Назад</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Тип</th>
                <th>Статус</th>
                <th>Результат (C/U/S)</th>
                <th>Дата / Длительность</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td style="color: #2EC4B6; font-family: monospace; font-weight: 900;">#{{ $log->id }}</td>
                <td><span style="background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 6px; font-size: 0.7rem; text-transform: uppercase;">{{ $log->import_type }}</span></td>
                <td><span class="status-badge status-{{ $log->status }}">{{ $log->status }}</span></td>
                <td>
                    <span style="color:#49cc90">{{ $log->total_created }}</span> /
                    <span style="color:#2EC4B6">{{ $log->total_updated }}</span> /
                    <span style="color:#ffc107">{{ $log->total_skipped }}</span>
                </td>
                <td>
                    <div style="font-weight: 800;">{{ $log->started_at->format('d.m.Y H:i') }}</div>
                    <div style="font-size: 0.7rem; opacity: 0.4;">
                        @if($log->finished_at)
                            {{ $log->started_at->diff($log->finished_at)->format('%iм %sс') }}
                        @else
                            В процессе...
                        @endif
                    </div>
                </td>
            </tr>
            @if($log->errors)
            <tr>
                <td colspan="5" style="padding: 0 1.5rem 1.5rem;">
                    <div style="font-weight: 900; color: #ff4d4d; font-size: 0.6rem; text-transform: uppercase; margin-bottom: 0.5rem;">Ошибка выполнения:</div>
                    <pre class="error-pre">{{ $log->errors }}</pre>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

<div class="pagination-wrapper">
    {{ $logs->links() }}
</div>

<script>lucide.createIcons();</script>
@endsection
