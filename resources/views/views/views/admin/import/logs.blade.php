@extends('layouts.admin')
@section('title', 'Архив логов - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; }

    .btn-back { background: #161616; color: #2EC4B6; border: 1px solid rgba(46, 196, 182, 0.2); padding: 1rem 1.5rem; border-radius: 12px; font-weight: 900; text-transform: uppercase; text-decoration: none; font-size: 0.8rem; transition: 0.3s; }
    .btn-back:hover { background: #2EC4B6; color: #000; }

    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; font-size: 0.9rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .log-id { color: #2EC4B6; font-weight: 900; font-family: monospace; }
    .type-badge { background: rgba(255,255,255,0.05); color: #FFF; padding: 4px 8px; border-radius: 6px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; }
    
    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; }
    .status-completed { background: rgba(73, 204, 144, 0.1); color: #49cc90; }
    .status-failed { background: rgba(255, 77, 77, 0.1); color: #ff4d4d; }
    .status-running { background: rgba(255, 193, 7, 0.1); color: #ffc107; }

    .count-text { font-weight: 900; font-size: 1rem; }
    .text-dim { color: rgba(255,255,255,0.3); font-size: 0.75rem; }

    .error-row { background: rgba(255, 77, 77, 0.03); }
    .error-pre { background: #000; color: #ff4d4d; padding: 15px; border-radius: 10px; font-family: monospace; font-size: 0.75rem; border: 1px solid rgba(255, 77, 77, 0.1); }
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
                <th>Начало / Длительность</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td><span class="log-id">#{{ $log->id }}</span></td>
                <td><span class="type-badge">{{ $log->import_type }}</span></td>
                <td><span class="status-badge status-{{ $log->status }}">{{ $log->status }}</span></td>
                <td>
                    <span class="count-text" style="color:#49cc90">{{ $log->total_created }}</span> /
                    <span class="count-text" style="color:#2EC4B6">{{ $log->total_updated }}</span> /
                    <span class="count-text" style="color:#ffc107">{{ $log->total_skipped }}</span>
                </td>
                <td>
                    <div style="font-weight: 900;">{{ $log->started_at->format('d.m.Y H:i') }}</div>
                    <div class="text-dim">
                        @if($log->finished_at)
                            {{ $log->started_at->diff($log->finished_at)->format('%iм %sс') }}
                        @else
                            Running...
                        @endif
                    </div>
                </td>
            </tr>
            @if($log->errors)
            <tr class="error-row">
                <td colspan="5" style="padding: 10px 1.5rem 1.5rem;">
                    <div style="font-weight: 900; color: #ff4d4d; font-size: 0.65rem; text-transform: uppercase; margin-bottom: 5px;">Traceback Error:</div>
                    <pre class="error-pre">{{ $log->errors }}</pre>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">{{ $logs->links() }}</div>
<script>lucide.createIcons();</script>
@endsection