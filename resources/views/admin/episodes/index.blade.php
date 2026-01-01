@extends('layouts.admin')
@section('title', 'Управление эпизодами - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title-block h1 { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .page-subtitle { color: #6f767e; font-size: 0.9rem; margin-top: 0.25rem; }
    .btn { padding: 0.75rem 1.25rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; text-decoration: none; white-space: nowrap; }
    .btn-primary { background: #00f2ea; color: #ffffff; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-primary:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .btn-secondary { background: #ffffff; color: #6f767e; border: 2px solid #f0f2f5; }
    .btn-secondary:hover { background: #f4f4f4; border-color: #e0e2e5; }
    .anime-info-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); display: flex; justify-content: space-between; align-items: center; gap: 1.25rem; flex-wrap: wrap; }
    .anime-info-left h2 { color: #1a1d1f; font-weight: 800; font-size: 1.5rem; margin: 0 0 0.75rem 0; }
    .anime-badges { display: flex; gap: 0.625rem; flex-wrap: wrap; }
    .badge { display: inline-block; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; background: #f0fdfa; color: #0d9488; }
    .anime-info-right { display: flex; gap: 0.625rem; }
    .anime-import-form { display: flex; gap: 0.625rem; align-items: flex-end; }
    .filter-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.25rem; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; }
    .filter-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.625rem; }
    .filter-input, .filter-select { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .filter-input:focus, .filter-select:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .table-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #fcfdfe; }
    th { color: #6f767e; padding: 1.25rem 1.5rem; text-align: left; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f0f2f5; }
    tbody tr { border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease; }
    tbody tr:hover { background: #fcfdfe; }
    td { padding: 1.25rem 1.5rem; color: #1a1d1f; font-size: 0.9rem; font-weight: 500; }
    .episode-number { color: #00f2ea; font-weight: 700; font-size: 1rem; }
    .anime-title-link { color: #00f2ea; text-decoration: none; font-weight: 600; transition: color 0.2s ease; }
    .anime-title-link:hover { color: #00d1ca; }
    .status-badge { display: inline-block; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .status-published { background: #f0fdf4; color: #16a34a; }
    .status-draft { background: #fffbeb; color: #d97706; }
    .status-archived { background: #f1f5f9; color: #64748b; }
    .actions-cell { display: flex; gap: 0.5rem; align-items: center; justify-content: flex-end; }
    .action-btn { padding: 0.5rem 0.875rem; border-radius: 0.5rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.8rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.375rem; }
    .action-edit { background: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1; }
    .action-edit:hover { background: #ccfbf1; }
    .action-delete { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .action-delete:hover { background: #fee2e2; }
    .empty-state { padding: 3.75rem 1.25rem; text-align: center; color: #6f767e; }
    .empty-emoji { font-size: 3rem; margin-bottom: 0.75rem; display: block; }
    .empty-text { font-size: 1rem; margin-bottom: 1.25rem; }
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); z-index: 50; align-items: center; justify-content: center; }
    .modal-overlay.active { display: flex; }
    .modal-content { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; box-shadow: 0 20px 60px rgba(0,0,0,0.15); width: 90%; max-width: 500px; }
    .modal-title { color: #1a1d1f; font-weight: 800; font-size: 1.25rem; margin: 0 0 1.25rem 0; }
    .modal-group { display: flex; flex-direction: column; margin-bottom: 1.25rem; }
    .modal-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.625rem; }
    .modal-input, .modal-select { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .modal-input:focus, .modal-select:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .modal-actions { display: flex; gap: 0.75rem; margin-top: 1.5rem; }
    .modal-actions .btn { flex: 1; justify-content: center; }
    .pagination-container { margin-top: 2.5rem; display: flex; justify-content: center; }
    @media (max-width: 1024px) {
        .anime-info-card { flex-direction: column; align-items: flex-start; }
        .anime-info-right { width: 100%; flex-direction: column; }
        .filter-grid { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); }
        th, td { padding: 0.625rem; font-size: 0.8rem; }
        .actions-cell { flex-wrap: wrap; }
    }
    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-primary { width: 100%; justify-content: center; }
        .filter-grid { grid-template-columns: 1fr; }
        .table-container { overflow-x: auto; }
        table { min-width: 900px; }
        .modal-content { width: 95%; }
        .page-title-block h1 { font-size: 1.5rem; }
    }
</style>

<div class="page-header">
    <div class="page-title-block">
        <h1>Управление эпизодами</h1>
        <p class="page-subtitle">Управление эпизодами аниме</p>
    </div>
    <div style="display: flex; gap: 0.625rem;">
        <button onclick="openBulkImportModal()" class="btn btn-primary">Массовый импорт</button>
        <form action="{{ route('admin.episodes.import-all') }}" method="POST"
              onsubmit="return confirm('Импортировать эпизоды для ВСЕХ аниме?\n\nБудут добавлены только новые эпизоды, существующие не изменятся.');">
            @csrf
            <button type="submit" class="btn btn-primary">Импорт для всех</button>
        </form>
    </div>
</div>

@if($anime)
<div class="anime-info-card">
    <div class="anime-info-left">
        <h2>{{ $anime->title }}</h2>
        <div class="anime-badges">
            <span class="badge">{{ strtoupper($anime->type) }}</span>
            <span class="badge" style="text-transform: capitalize;">{{ $anime->status }}</span>
        </div>
    </div>
    <div class="anime-info-right">
        <form action="{{ route('admin.episodes.import', $anime->id) }}" method="POST" class="anime-import-form"
              onsubmit="return confirm('Импортировать эпизоды для &quot;{{ $anime->title }}&quot;?\n\nЭто загрузит данные из AniList API.')">
            @csrf
            <select name="import_type" class="filter-select">
                <option value="initial">Только новые</option>
                <option value="update">Обновить все</option>
            </select>
            <button type="submit" class="btn btn-primary">Импортировать</button>
        </form>
    </div>
</div>
@endif

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label">Поиск</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Название аниме..."
                   class="filter-input">
        </div>

        <div class="filter-group">
            <label class="filter-label">Номер эпизода</label>
            <input type="number" name="episode" value="{{ request('episode') }}" placeholder="например: 1" min="1"
                   class="filter-input">
        </div>

        <div class="filter-group">
            <label class="filter-label">Статус</label>
            <select name="status" class="filter-select">
                <option value="">Все эпизоды</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Опубликовано</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Черновик</option>
                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Архив</option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Сортировка</label>
            <select name="sort" class="filter-select">
                <option value="episode_number" {{ request('sort') === 'episode_number' ? 'selected' : '' }}>По номеру</option>
                <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>По дате</option>
                <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>По названию</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Найти</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="width: 8%;">#</th>
                <th style="width: 20%;">Аниме</th>
                <th style="width: 10%;">Эпизод</th>
                <th style="width: 25%;">Название</th>
                <th style="width: 10%;">Длительность</th>
                <th style="width: 12%;">Статус</th>
                <th style="width: 15%;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($episodes as $index => $episode)
                <tr>
                    <td>{{ $episodes->firstItem() + $index }}</td>
                    <td>
                        @if($episode->anime)
                            <a href="{{ route('admin.anime.show', $episode->anime_id) }}" class="anime-title-link">
                                {{ Str::limit($episode->anime->title, 20) }}
                            </a>
                        @else
                            <span style="color: #dc2626;">Удалено</span>
                        @endif
                    </td>
                    <td><span class="episode-number">{{ $episode->episode_number }}</span></td>
                    <td>{{ Str::limit($episode->title ?? 'Без названия', 25) }}</td>
                    <td>{{ $episode->duration ?? '—' }} мин</td>
                    <td><span class="status-badge status-{{ $episode->status }}">{{ ucfirst($episode->status) }}</span></td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="action-btn action-edit">Изменить</a>
                            <form action="{{ route('admin.episodes.destroy', $episode->id) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Удалить эпизод {{ $episode->episode_number }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-delete">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <span class="empty-emoji">📺</span>
                            <div class="empty-text">Эпизоды не найдены</div>
                            @if($anime)
                                <form action="{{ route('admin.episodes.import', $anime->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Импортировать эпизоды</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($episodes->count() > 0)
<div class="pagination-container">
    {{ $episodes->links() }}
</div>
@endif

<div id="bulk-import-modal" class="modal-overlay">
    <div class="modal-content">
        <h3 class="modal-title">Массовый импорт эпизодов</h3>

        <form action="{{ route('admin.episodes.bulk-import') }}" method="POST">
            @csrf

            <div class="modal-group">
                <label class="modal-label">Выберите аниме</label>
                <select name="anime_id" required class="modal-select">
                    <option value="">-- Выберите аниме --</option>
                    @forelse($allAnimes ?? [] as $a)
                        <option value="{{ $a->id }}">{{ $a->title }}</option>
                    @empty
                        <option disabled>Нет доступных аниме</option>
                    @endforelse
                </select>
            </div>

            <div class="modal-group">
                <label class="modal-label">Тип импорта</label>
                <select name="import_type" required class="modal-select">
                    <option value="initial">Только новые эпизоды</option>
                    <option value="update">Обновить все эпизоды</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" onclick="closeBulkImportModal()" class="btn btn-secondary">Отменить</button>
                <button type="submit" class="btn btn-primary">Начать импорт</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openBulkImportModal() {
        document.getElementById('bulk-import-modal').classList.add('active');
    }

    function closeBulkImportModal() {
        document.getElementById('bulk-import-modal').classList.remove('active');
    }

    document.getElementById('bulk-import-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeBulkImportModal();
        }
    });
</script>
@endsection
