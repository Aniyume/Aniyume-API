@extends('layouts.admin')
@section('title', 'Управление аниме - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; margin: 0; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .btn-create { background: #2EC4B6; color: #000; padding: 1rem 2rem; border-radius: 12px; border: none; font-weight: 900; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; text-decoration: none; text-transform: uppercase; box-shadow: 0 0 20px rgba(46, 196, 182, 0.3); }
    .btn-create:hover { transform: translateY(-3px); box-shadow: 0 0 30px rgba(46, 196, 182, 0.5); }

    .bulk-actions {
        background: #1a1a1a; border: 1px solid #FF4D4D; padding: 1rem 2rem; border-radius: 15px;
        margin-bottom: 2rem; display: none; align-items: center; justify-content: space-between;
        animation: slideIn 0.3s ease;
    }
    @keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    .filter-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: flex-end; }
    .filter-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.75rem; display: block; }
    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem; transition: all 0.3s ease; font-size: 0.9rem; font-weight: 700; width: 100%; }

    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; font-size: 0.95rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .custom-checkbox { width: 20px; height: 20px; accent-color: #2EC4B6; cursor: pointer; }

    .anime-cell { display: flex; align-items: center; gap: 1.25rem; }
    .anime-poster { width: 50px; height: 75px; border-radius: 10px; object-fit: cover; border: 1px solid rgba(255,255,255,0.1); }
    .anime-title-link { color: #FFF; font-weight: 900; text-decoration: none; text-transform: uppercase; italic: italic; transition: 0.3s; font-size: 0.9rem; }

    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; }
    .status-ongoing { background: rgba(255, 193, 7, 0.1); color: #FFC107; }
    .status-finished { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }

    .action-btn { background: #161616; color: rgba(255,255,255,0.3); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; transition: 0.3s; border: 1px solid rgba(255,255,255,0.05); }
</style>

<div class="page-header">
    <h1 class="page-title">Аниме <span>Каталог</span></h1>
    {{-- Используем стандартный роут --}}
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
        <button type="submit" class="btn-create" style="background: #333; color: #fff; box-shadow: none;">Фильтр</button>
    </form>
</div>

<div id="bulkPanel" class="bulk-actions">
    <div style="color: #FFF; font-weight: 800; text-transform: uppercase; font-size: 0.9rem;">
        Выбрано элементов: <span id="selectedCount">0</span>
    </div>
    <button type="button" onclick="confirmBulkDelete()" class="btn-create" style="background: #FF4D4D; color: #fff;">
        <i data-lucide="trash-2"></i> Удалить выбранные и в ЧС
    </button>
</div>

{{-- Используем имя из web.php (admin. + bulk-delete) --}}
<form id="bulkDeleteForm" action="{{ route('admin.bulk-delete') }}" method="POST">
    @csrf
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;"><input type="checkbox" id="selectAll" class="custom-checkbox"></th>
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
                    <td><input type="checkbox" name="ids[]" value="{{ $item->id }}" class="custom-checkbox anime-checkbox"></td>
                    <td>
                        <div class="anime-cell">
                            <img src="{{ $item->poster_url }}" class="anime-poster">
                            <div>
                                <a href="{{ route('admin.anime.show', $item->id) }}" class="anime-title-link">{{ $item->title }}</a>
                            </div>
                        </div>
                    </td>
                    <td><span style="color: #2EC4B6; font-weight: 900;">{{ strtoupper($item->type) }}</span></td>
                    <td><span class="status-badge status-{{ $item->status }}">{{ $item->status }}</span></td>
                    <td><div style="color: #FFC107; font-weight: 900;">★ {{ number_format($item->rating, 1) }}</div></td>
                    <td style="display: flex; gap: 10px; justify-content: flex-end;">
                        <a href="{{ route('admin.anime.edit', $item->id) }}" class="action-btn"><i data-lucide="edit-3" style="width:18px"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>

<div style="margin-top: 2rem;">{{ $anime->links() }}</div>

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
        if (confirm('Вы уверены, что хотите удалить выбранные аниме? Они будут добавлены в черный список и больше не импортируются.')) {
            document.getElementById('bulkDeleteForm').submit();
        }
    }
</script>
@endsection
