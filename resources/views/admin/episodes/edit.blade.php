@extends('layouts.admin')
@section('title', 'Эпизоды - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; }

    .btn-group { display: flex; gap: 1rem; }
    .btn-main { background: #2EC4B6; color: #000; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 900; text-transform: uppercase; font-size: 0.8rem; border: none; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; text-decoration: none; }
    .btn-main:hover { transform: translateY(-3px); box-shadow: 0 0 20px rgba(46, 196, 182, 0.3); }

    .anime-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: center; }
    .anime-card h2 { font-weight: 900; text-transform: uppercase; font-size: 1.5rem; italic: italic; color: #FFF; }
    .anime-card .badge { background: #2EC4B6; color: #000; padding: 5px 10px; border-radius: 6px; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; margin-top: 5px; display: inline-block; }

    .filter-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; align-items: flex-end; }
    .filter-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.5rem; display: block; }
    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem; font-size: 0.9rem; font-weight: 700; width: 100%; }

    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .ep-number { color: #2EC4B6; font-weight: 900; font-size: 1.1rem; italic: italic; }
    .status-badge { padding: 5px 10px; border-radius: 6px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; }
    .status-published { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }
    .status-draft { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.4); }

    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .action-link { background: #161616; color: #FFF; padding: 8px 15px; border-radius: 10px; font-size: 0.7rem; font-weight: 900; text-decoration: none; text-transform: uppercase; transition: 0.3s; border: 1px solid rgba(255,255,255,0.05); }
    .action-link:hover { background: #2EC4B6; color: #000; }
</style>

<div class="page-header">
    <h1 class="page-title">Эпизоды <span>Менеджер</span></h1>
    <div class="btn-group">
        <button onclick="openModal()" class="btn-main"><i data-lucide="upload"></i> Массовый импорт</button>
        <form action="{{ route('admin.episodes.import-all') }}" method="POST">
            @csrf
            <button type="submit" class="btn-main"><i data-lucide="refresh-cw"></i> Обновить всё</button>
        </form>
    </div>
</div>

@if($anime)
<div class="anime-card">
    <div>
        <h2>{{ $anime->title }}</h2>
        <span class="badge">{{ $anime->type }} / {{ $anime->status }}</span>
    </div>
    <form action="{{ route('admin.episodes.import', $anime->id) }}" method="POST" style="display:flex; gap:10px;">
        @csrf
        <select name="import_type" class="filter-select" style="width: auto;">
            <option value="initial">Новые</option>
            <option value="update">Все</option>
        </select>
        <button type="submit" class="btn-main">Импорт</button>
    </form>
</div>
@endif

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">Серия</th>
                <th style="width: 30%;">Релиз</th>
                <th style="width: 25%;">Название</th>
                <th style="width: 15%;">Статус</th>
                <th style="text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($episodes as $episode)
                <tr>
                    <td class="ep-number">#{{ $episode->episode_number }}</td>
                    <td style="font-weight: 800; text-transform: uppercase; font-size: 0.8rem;">
                        {{ optional($episode->anime)->title ?? 'N/A' }}
                    </td>
                    <td style="color: rgba(255,255,255,0.6);">{{ $episode->title ?? 'Без названия' }}</td>
                    <td><span class="status-badge status-{{ $episode->status }}">{{ $episode->status }}</span></td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="action-link">Правка</a>
                        <form action="{{ route('admin.episodes.destroy', $episode->id) }}" method="POST" onsubmit="return confirm('Удалить?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-link" style="color: #FF4D4D; cursor: pointer; background: transparent; border: none;">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">{{ $episodes->links() }}</div>

<script>lucide.createIcons();</script>
@endsection