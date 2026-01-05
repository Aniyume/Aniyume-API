@extends('layouts.admin')
@section('title', 'Эпизоды - AniYume Админ')
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

    .btn-main {
        background: #2EC4B6;
        color: #000;
        padding: 0.9rem 1.5rem;
        border-radius: 12px;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.75rem;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        transition: 0.3s;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(46, 196, 182, 0.2);
    }
    .btn-main:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(46, 196, 182, 0.4); }

    .filter-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }

    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: flex-end; }
    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 0.9rem; font-size: 0.85rem; font-weight: 700; width: 100%; transition: 0.3s; }
    .filter-input:focus { border-color: #2EC4B6; outline: none; }

    .table-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        overflow-x: auto;
        animation: fadeInUp 0.5s ease 0.2s forwards;
        opacity: 0;
    }

    table { width: 100%; border-collapse: collapse; min-width: 900px; }
    th { color: rgba(255,255,255,0.3); padding: 1.25rem 1.5rem; text-align: left; font-weight: 900; font-size: 0.65rem; text-transform: uppercase; border-bottom: 1px solid rgba(255,255,255,0.05); letter-spacing: 0.1em; }
    td { padding: 1.25rem 1.5rem; color: #FFF; border-bottom: 1px solid rgba(255,255,255,0.02); font-size: 0.9rem; font-weight: 600; }

    .ep-number { color: #2EC4B6; font-weight: 900; font-size: 1.1rem; }
    .anime-title { font-weight: 800; text-transform: uppercase; font-size: 0.75rem; color: rgba(255,255,255,0.8); }

    .actions-cell { display: flex; gap: 0.6rem; justify-content: flex-end; }
    .action-link {
        background: #161616;
        color: #FFF;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 0.65rem;
        font-weight: 900;
        text-decoration: none;
        text-transform: uppercase;
        border: 1px solid rgba(255,255,255,0.05);
        transition: 0.3s;
    }
    .action-link:hover { background: #2EC4B6; color: #000; border-color: #2EC4B6; }
    .action-link.delete:hover { background: #FF4D4D; color: #fff; border-color: #FF4D4D; }

    .pagination-wrapper { margin-top: 2.5rem; display: flex; justify-content: center; }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: stretch; }
        .btn-main { width: 100%; justify-content: center; }
    }

    .pagination-wrapper {
        margin-top: 2.5rem;
        display: flex;
        justify-content: center;
        animation: fadeInUp 0.5s ease 0.3s forwards;
        opacity: 0;
    }

    .custom-pagination {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .page-link {
        background: #111111;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.6);
        min-width: 45px;
        height: 45px;
        padding: 0 1rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 900;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .page-link:hover:not(.disabled):not(.active) {
        background: rgba(46, 196, 182, 0.1);
        border-color: #2EC4B6;
        color: #2EC4B6;
        transform: translateY(-2px);
    }

    .page-link.active {
        background: linear-gradient(135deg, #2EC4B6 0%, #20a89a 100%);
        border-color: #2EC4B6;
        color: #000;
        box-shadow: 0 0 20px rgba(46, 196, 182, 0.4);
        transform: scale(1.05);
    }

    .page-link.disabled {
        background: #0a0a0a;
        border-color: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.15);
        cursor: not-allowed;
    }

    .page-link i {
        width: 18px;
        height: 18px;
    }

    .page-dots {
        color: rgba(255, 255, 255, 0.3);
        font-weight: 900;
        padding: 0 0.5rem;
        user-select: none;
    }

    @media (max-width: 768px) {
        .page-link {
            min-width: 40px;
            height: 40px;
            font-size: 0.85rem;
            padding: 0 0.75rem;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Эпизоды <span>Менеджер</span></h1>
    <div class="btn-group">

    </div>
</div>

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по аниме..." class="filter-input">
        <select name="anime_id" class="filter-select">
            <option value="">Все релизы</option>
            @foreach($allAnimes as $a)
                <option value="{{ $a->id }}" {{ request('anime_id') == $a->id ? 'selected' : '' }}>{{ $a->title }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-main" style="background: #1a1a1a; color: #fff; border: 1px solid rgba(255,255,255,0.1); box-shadow: none;">Применить</button>
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
                    <td class="anime-title">{{ Str::limit($episode->anime->title ?? 'N/A', 40) }}</td>
                    <td style="color: rgba(255,255,255,0.6); font-style: italic;">{{ $episode->title ?: '---' }}</td>
                    <td><span style="background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 6px; font-size: 0.7rem;">{{ $episode->translator ?: 'Original' }}</span></td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="action-link">Правка</a>
                        <form action="{{ route('admin.episodes.destroy', $episode->id) }}" method="POST" onsubmit="return confirm('Удалить этот эпизод?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-link delete" style="cursor: pointer; background: transparent;">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@php
    $paginator = $episodes;
@endphp

@if ($paginator && $paginator->hasPages())
<div class="pagination-wrapper">
    <nav class="custom-pagination">
        @if ($paginator->onFirstPage())
            <span class="page-link disabled"><i data-lucide="chevron-left"></i></span>
        @else
            <a href="{{ $paginator->appends(request()->query())->previousPageUrl() }}" class="page-link"><i data-lucide="chevron-left"></i></a>
        @endif

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $current + 2);
        @endphp

        @if ($start > 1)
            <a href="{{ $paginator->appends(request()->query())->url(1) }}" class="page-link">1</a>
            @if ($start > 2)
                <span class="page-dots">...</span>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <span class="page-link active">{{ $i }}</span>
            @else
                <a href="{{ $paginator->appends(request()->query())->url($i) }}" class="page-link">{{ $i }}</a>
            @endif
        @endfor

        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="page-dots">...</span>
            @endif
            <a href="{{ $paginator->appends(request()->query())->url($last) }}" class="page-link">{{ $last }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->appends(request()->query())->nextPageUrl() }}" class="page-link"><i data-lucide="chevron-right"></i></a>
        @else
            <span class="page-link disabled"><i data-lucide="chevron-right"></i></span>
        @endif
    </nav>
</div>
@endif

<script>lucide.createIcons();</script>
@endsection
