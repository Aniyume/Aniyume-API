@extends('layouts.admin')
@section('title', 'Теги - AniYume Админ')
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

    .btn-create {
        background: #2EC4B6;
        color: #000;
        padding: 0.9rem 1.5rem;
        border-radius: 12px;
        font-weight: 900;
        text-transform: uppercase;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.8rem;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(46, 196, 182, 0.2);
    }
    .btn-create:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(46, 196, 182, 0.4); }

    .search-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }
    .search-form { display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap; }
    .search-group { flex: 1; min-width: 250px; }
    .search-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.6rem; display: block; }
    .search-input { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 0.9rem; font-size: 0.9rem; font-weight: 700; width: 100%; transition: 0.3s; }
    .btn-search { background: #1a1a1a; color: #FFF; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 0.9rem 1.5rem; font-weight: 900; text-transform: uppercase; cursor: pointer; transition: 0.3s; font-size: 0.75rem; }
    .btn-search:hover { background: #2EC4B6; color: #000; border-color: #2EC4B6; }

    .table-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        overflow-x: auto;
        animation: fadeInUp 0.5s ease 0.2s forwards;
        opacity: 0;
    }
    table { width: 100%; border-collapse: collapse; min-width: 800px; }
    th { color: rgba(255,255,255,0.3); padding: 1.25rem 1.5rem; text-align: left; font-weight: 900; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.15em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.25rem 1.5rem; color: #FFF; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); font-size: 0.9rem; }

    .tag-name { font-weight: 900; text-transform: uppercase; font-style: italic; font-size: 1rem; color: #FFF; }
    .tag-slug { font-family: 'JetBrains Mono', monospace; color: rgba(255,255,255,0.3); font-size: 0.75rem; font-weight: 700; }
    .count-badge { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; padding: 6px 12px; border-radius: 8px; font-size: 0.65rem; font-weight: 900; border: 1px solid rgba(46, 196, 182, 0.2); }

    .actions-cell { display: flex; gap: 0.6rem; justify-content: flex-end; }
    .action-btn {
        background: #161616;
        color: #FFF;
        padding: 7px 14px;
        border-radius: 10px;
        font-size: 0.65rem;
        font-weight: 900;
        text-decoration: none;
        text-transform: uppercase;
        transition: 0.3s;
        border: 1px solid rgba(255,255,255,0.05);
    }
    .action-btn:hover { background: #2EC4B6; color: #000; border-color: #2EC4B6; transform: scale(1.05); }
    .btn-delete:hover { background: #ff4d4d; color: #FFF; border-color: #ff4d4d; }

    .pagination-wrapper { margin-top: 2.5rem; display: flex; justify-content: center; }
    nav[role="navigation"] { display: flex; gap: 0.5rem; }
    nav[role="navigation"] a, nav[role="navigation"] span { background: #111 !important; border: 1px solid rgba(255,255,255,0.1) !important; color: #fff !important; padding: 0.75rem 1rem !important; border-radius: 10px !important; text-decoration: none !important; font-weight: 800 !important; font-size: 0.8rem !important; }
    nav[role="navigation"] .active span { background: #2EC4B6 !important; color: #000 !important; }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: stretch; }
        .btn-create { width: 100%; justify-content: center; }
        .search-group { min-width: 100%; }
        .btn-search { width: 100%; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Теги <span>Системы</span></h1>
    <a href="{{ route('admin.tags.create') }}" class="btn-create"><i data-lucide="plus"></i> Создать тег</a>
</div>

<div class="search-card">
    <form method="GET" class="search-form">
        <div class="search-group">
            <label class="search-label">Поиск жанра / категории</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Название тега..." class="search-input">
        </div>
        <button type="submit" class="btn-search">Найти</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="width: 35%;">Название</th>
                <th style="width: 35%;">Slug (URL)</th>
                <th style="width: 15%;">Используется</th>
                <th style="text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
                <tr>
                    <td class="tag-name">{{ $tag->name }}</td>
                    <td class="tag-slug">/{{ $tag->slug }}</td>
                    <td><span class="count-badge">{{ number_format($tag->anime_count) }} рел.</span></td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="action-btn">Правка</a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Удалить тег?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn btn-delete" style="cursor: pointer; background: transparent;">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align:center; padding:5rem; color:rgba(255,255,255,0.1); font-weight: 900; text-transform: uppercase;">Теги отсутствуют</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@php
    $paginator = $tags ;
@endphp

@if ($paginator && $paginator->hasPages())
<div class="pagination-wrapper">
    <nav class="custom-pagination">
        @if ($paginator->onFirstPage())
            <span class="page-link disabled"><i data-lucide="chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link"><i data-lucide="chevron-left"></i></a>
        @endif

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $current + 2);
        @endphp

        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}" class="page-link">1</a>
            @if ($start > 2)
                <span class="page-dots">...</span>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <span class="page-link active">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
            @endif
        @endfor

        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="page-dots">...</span>
            @endif
            <a href="{{ $paginator->url($last) }}" class="page-link">{{ $last }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link"><i data-lucide="chevron-right"></i></a>
        @else
            <span class="page-link disabled"><i data-lucide="chevron-right"></i></span>
        @endif
    </nav>
</div>

<style>
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
@endif

<script>lucide.createIcons();</script>
@endsection
