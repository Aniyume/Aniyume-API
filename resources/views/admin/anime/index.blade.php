@extends('layouts.admin')
@section('title', 'Управление аниме - AniYume Админ')
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
        margin-bottom: 3rem;
        gap: 1.5rem;
        flex-wrap: wrap;
        animation: fadeInUp 0.5s ease forwards;
    }

    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 5vw, 2.5rem); margin: 0; text-transform: uppercase; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .btn-create {
        background: #2EC4B6;
        color: #000;
        padding: 1rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 900;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.9rem;
        text-decoration: none;
        text-transform: uppercase;
        box-shadow: 0 0 20px rgba(46, 196, 182, 0.3);
    }

    .btn-create:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 0 30px rgba(46, 196, 182, 0.5); }

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
    .filter-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.75rem; display: block; }

    .filter-input, .filter-select {
        background: #161616;
        border: 1px solid rgba(255,255,255,0.1);
        color: #FFF;
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        font-weight: 700;
        width: 100%;
    }

    .filter-input:focus { border-color: #2EC4B6; outline: none; background: #1a1a1a; }

    .bulk-actions {
        background: #1a1a1a;
        border: 1px solid #FF4D4D;
        padding: 1rem 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        display: none;
        align-items: center;
        justify-content: space-between;
        animation: slideIn 0.3s ease;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        overflow-x: auto;
        animation: fadeInUp 0.5s ease 0.2s forwards;
        opacity: 0;
    }

    table { width: 100%; border-collapse: collapse; min-width: 800px; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.25rem 1.5rem; color: #FFF; font-size: 0.95rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    tr { transition: background 0.3s ease; }
    tr:hover { background: rgba(255,255,255,0.02); }

    .anime-cell { display: flex; align-items: center; gap: 1.25rem; }
    .anime-poster { width: 45px; height: 65px; border-radius: 8px; object-fit: cover; border: 1px solid rgba(255,255,255,0.1); transition: transform 0.3s ease; }
    tr:hover .anime-poster { transform: scale(1.1); }

    .anime-title-link { color: #FFF; font-weight: 900; text-decoration: none; text-transform: uppercase; transition: 0.3s; font-size: 0.85rem; }
    .anime-title-link:hover { color: #2EC4B6; }

    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; }
    .status-ongoing { background: rgba(255, 193, 7, 0.1); color: #FFC107; }
    .status-finished { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }

    .action-btn {
        background: #161616;
        color: rgba(255,255,255,0.3);
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.05);
        text-decoration: none;
    }
    .action-btn:hover { background: #2EC4B6; color: #000; transform: rotate(15deg); }

    @media (max-width: 768px) {
        .filter-card { padding: 1.25rem; }
        .page-header { margin-bottom: 1.5rem; }
        .btn-create { width: 100%; justify-content: center; }
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
    <h1 class="page-title">Аниме <span>Каталог</span></h1>
    <a href="{{ route('admin.anime.create') }}" class="btn-create"><i data-lucide="plus"></i> Добавить релиз</a>
</div>

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label">Поиск релиза</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Название..." class="filter-input">
        </div>
        <div class="filter-group">
            <label class="filter-label">Статус</label>
            <select name="status" class="filter-select">
                <option value="">Все статусы</option>
                <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Выходит</option>
                <option value="finished" {{ request('status') === 'finished' ? 'selected' : '' }}>Завершено</option>
            </select>
        </div>
        <button type="submit" class="btn-create" style="background: #1a1a1a; color: #fff; box-shadow: none; border: 1px solid rgba(255,255,255,0.1);">Фильтр</button>
    </form>
</div>

<div id="bulkPanel" class="bulk-actions">
    <div style="color: #FFF; font-weight: 800; text-transform: uppercase; font-size: 0.8rem;">
        Выбрано: <span id="selectedCount">0</span>
    </div>
    <button type="button" onclick="confirmBulkDelete()" class="btn-create" style="background: #FF4D4D; color: #fff; padding: 0.75rem 1.5rem;">
        <i data-lucide="trash-2"></i> Удалить выбранные
    </button>
</div>

<form id="bulkDeleteForm" action="{{ route('admin.bulk-delete') }}" method="POST">
    @csrf
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;"><input type="checkbox" id="selectAll" style="accent-color: #2EC4B6; width: 18px; height: 18px;"></th>
                    <th>Релиз</th>
                    <th>Тип</th>
                    <th>Статус</th>
                    <th>Рейтинг</th>
                    <th style="text-align: right;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anime as $item)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $item->id }}" class="anime-checkbox" style="accent-color: #2EC4B6; width: 18px; height: 18px;"></td>
                    <td>
                        <div class="anime-cell">
                            <img src="{{ $item->poster_url }}" class="anime-poster">
                            <div>
                                <a href="{{ route('admin.anime.show', $item->id) }}" class="anime-title-link">{{ Str::limit($item->title, 40) }}</a>
                            </div>
                        </div>
                    </td>
                    <td><span style="color: #2EC4B6; font-weight: 900; font-size: 0.75rem;">{{ strtoupper($item->type) }}</span></td>
                    <td><span class="status-badge status-{{ $item->status }}">{{ $item->status }}</span></td>
                    <td><div style="color: #FFC107; font-weight: 900;">★ {{ number_format($item->rating, 1) }}</div></td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <a href="{{ route('admin.anime.edit', $item->id) }}" class="action-btn"><i data-lucide="edit-3" style="width:16px"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>

@if ($anime->hasPages())
<div class="pagination-wrapper">
    <nav class="custom-pagination">
        @if ($anime->onFirstPage())
            <span class="page-link disabled"><i data-lucide="chevron-left"></i></span>
        @else
            <a href="{{ $anime->appends(request()->query())->previousPageUrl() }}" class="page-link"><i data-lucide="chevron-left"></i></a>
        @endif

        @php
            $current = $anime->currentPage();
            $last = $anime->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $current + 2);
        @endphp

        @if ($start > 1)
            <a href="{{ $anime->appends(request()->query())->url(1) }}" class="page-link">1</a>
            @if ($start > 2)
                <span class="page-dots">...</span>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <span class="page-link active">{{ $i }}</span>
            @else
                <a href="{{ $anime->appends(request()->query())->url($i) }}" class="page-link">{{ $i }}</a>
            @endif
        @endfor

        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="page-dots">...</span>
            @endif
            <a href="{{ $anime->appends(request()->query())->url($last) }}" class="page-link">{{ $last }}</a>
        @endif

        @if ($anime->hasMorePages())
            <a href="{{ $anime->appends(request()->query())->nextPageUrl() }}" class="page-link"><i data-lucide="chevron-right"></i></a>
        @else
            <span class="page-link disabled"><i data-lucide="chevron-right"></i></span>
        @endif
    </nav>
</div>
@endif

<script>
    lucide.createIcons();
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.anime-checkbox');
    const bulkPanel = document.getElementById('bulkPanel');
    const selectedCount = document.getElementById('selectedCount');

    function updateBulkPanel() {
        const checkedCount = document.querySelectorAll('.anime-checkbox:checked').length;
        selectedCount.textContent = checkedCount;
        bulkPanel.style.display = checkedCount > 0 ? 'flex' : 'none';
    }

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkPanel();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateBulkPanel);
    });

    function confirmBulkDelete() {
        if (confirm('Удалить выбранные аниме и добавить в черный список?')) {
            document.getElementById('bulkDeleteForm').submit();
        }
    }
</script>
@endsection
