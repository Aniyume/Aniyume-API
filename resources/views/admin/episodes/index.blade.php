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
    .filter-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: flex-end; }
    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem; font-size: 0.9rem; font-weight: 700; width: 100%; }
    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; border-bottom: 1px solid rgba(255,255,255,0.02); }
    .ep-number { color: #2EC4B6; font-weight: 900; font-size: 1.1rem; }
    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .action-link { background: #161616; color: #FFF; padding: 8px 15px; border-radius: 10px; font-size: 0.7rem; font-weight: 900; text-decoration: none; text-transform: uppercase; border: 1px solid rgba(255,255,255,0.05); }
</style>

<div class="page-header">
    <h1 class="page-title">Эпизоды <span>Менеджер</span></h1>
    <div class="btn-group">
        <form action="{{ route('admin.episodes.import-all') }}" method="POST">
            @csrf
            <button type="submit" class="btn-main"><i data-lucide="refresh-cw"></i> Обновить всё</button>
        </form>
    </div>
</div>

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск аниме..." class="filter-input">
        <select name="anime_id" class="filter-select">
            <option value="">Все релизы</option>
            @foreach($allAnimes as $a)
                <option value="{{ $a->id }}" {{ request('anime_id') == $a->id ? 'selected' : '' }}>{{ $a->title }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-main">Фильтр</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Серия</th>
                <th>Аниме</th>
                <th>Название</th>
                <th>Перевод</th>
                <th style="text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($episodes as $episode)
                <tr>
                    <td class="ep-number">#{{ $episode->episode_number }}</td>
                    <td style="font-weight: 800; text-transform: uppercase; font-size: 0.8rem;">
                        {{ $episode->anime->title ?? 'N/A' }}
                    </td>
                    <td>{{ $episode->title ?? '---' }}</td>
                    <td>{{ $episode->translator ?? '---' }}</td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="action-link">Правка</a>
                        <form action="{{ route('admin.episodes.destroy', $episode->id) }}" method="POST" onsubmit="return confirm('Удалить?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-link" style="color: #FF4D4D; cursor: pointer; background: transparent;">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    nav[role="navigation"],
    .pagination {
        display: flex !important;
        gap: 0.5rem !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        list-style: none !important;
        padding: 0 !important;
    }
    nav[role="navigation"] svg {
        width: 16px !important;
        height: 16px !important;
    }
    nav[role="navigation"] *,
    .pagination * {
        background: #161616 !important;
        color: #FFF !important;
        padding: 10px 15px !important;
        border-radius: 10px !important;
        text-decoration: none !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        min-width: 40px !important;
        text-align: center !important;
        font-weight: 700 !important;
        font-size: 0.9rem !important;
        transition: all 0.3s !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
    }
    nav[role="navigation"] a:hover,
    .pagination a:hover {
        background: #2EC4B6 !important;
        color: #000 !important;
        transform: translateY(-2px) !important;
    }
    nav[role="navigation"] span[aria-current="page"],
    .pagination .active span {
        background: #2EC4B6 !important;
        color: #000 !important;
        border-color: #2EC4B6 !important;
    }
    nav[role="navigation"] span[aria-disabled="true"],
    .pagination .disabled span {
        color: rgba(255, 255, 255, 0.3) !important;
        cursor: not-allowed !important;
    }
    nav[role="navigation"] p {
        display: none !important;
    }
</style>

<div style="margin-top: 2rem;">{{ $episodes->links() }}</div>
<script>lucide.createIcons();</script>
@endsection
