@extends('layouts.admin')

@section('title', 'Управление эпизодами - АниЮм Админ')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .page-title-block h1 {
        background: linear-gradient(135deg, #00ffc8, #00c8ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 28px;
        margin: 0;
    }

    .page-subtitle {
        color: rgba(176, 224, 255, 0.6);
        font-size: 14px;
        margin-top: 4px;
    }

    .btn {
        padding: 12px 20px;
        border-radius: 10px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, #00ffc8, #00c8ff);
        color: #0a0a1a;
    }

    .btn-primary:hover {
        box-shadow: 0 12px 30px rgba(0, 255, 200, 0.3);
        transform: translateY(-2px);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .anime-info-card {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(10px);
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .anime-info-left h2 {
        color: #00ffc8;
        font-weight: 800;
        font-size: 24px;
        margin: 0 0 12px 0;
    }

    .anime-badges {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        border: 1px solid;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
        color: #00ffc8;
        border-color: rgba(0, 255, 200, 0.3);
    }

    .anime-info-right {
        display: flex;
        gap: 10px;
    }

    .anime-import-form {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    .filter-card {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(10px);
        margin-bottom: 24px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        color: #b0e0ff;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .filter-input,
    .filter-select {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        color: #e0e0e0;
        border-radius: 10px;
        padding: 12px 14px;
        transition: all 0.3s ease;
        font-family: 'Onest', sans-serif;
        font-size: 14px;
    }

    .filter-input::placeholder {
        color: rgba(224, 224, 224, 0.4);
    }

    .filter-input:focus,
    .filter-select:focus {
        outline: none;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
        border-color: #00ffc8;
        box-shadow: 0 0 20px rgba(0, 255, 200, 0.3);
    }

    .filter-select option {
        background: #0a0a1a;
        color: #e0e0e0;
    }

    .table-container {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: linear-gradient(90deg, #0f1419, #1a2535);
    }

    th {
        color: #00ffc8;
        padding: 16px;
        text-align: left;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1.5px solid rgba(0, 255, 200, 0.25);
    }

    td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(0, 255, 200, 0.1);
        color: #d0e8ff;
        font-size: 14px;
    }

    tbody tr {
        transition: all 0.3s ease;
    }

    tbody tr:hover {
        background: rgba(0, 255, 200, 0.08);
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .episode-number {
        color: #00ffc8;
        font-weight: 700;
        font-size: 16px;
    }

    .anime-title-link {
        color: #00ffc8;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .anime-title-link:hover {
        text-decoration: underline;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        border: 1px solid;
        letter-spacing: 0.5px;
    }

    .status-published {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
        color: #00ffc8;
        border-color: rgba(0, 255, 200, 0.3);
    }

    .status-draft {
        background: linear-gradient(135deg, rgba(255, 200, 100, 0.15), rgba(255, 180, 80, 0.1));
        color: #ffc878;
        border-color: rgba(255, 200, 100, 0.3);
    }

    .status-archived {
        background: linear-gradient(135deg, rgba(176, 224, 255, 0.15), rgba(176, 224, 255, 0.1));
        color: #b0e0ff;
        border-color: rgba(176, 224, 255, 0.3);
    }

    .actions-cell {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .action-btn {
        padding: 6px 10px;
        border-radius: 6px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .action-edit {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.2), rgba(0, 200, 255, 0.15));
        color: #00ffc8;
        border: 1px solid rgba(0, 255, 200, 0.3);
    }

    .action-edit:hover {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.3), rgba(0, 200, 255, 0.2));
        box-shadow: 0 4px 12px rgba(0, 255, 200, 0.2);
    }

    .action-delete {
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.2), rgba(255, 80, 80, 0.15));
        color: #ff9fa0;
        border: 1px solid rgba(255, 100, 100, 0.3);
    }

    .action-delete:hover {
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.3), rgba(255, 80, 80, 0.2));
        box-shadow: 0 4px 12px rgba(255, 100, 100, 0.2);
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
        color: #b0e0ff;
    }

    .empty-emoji {
        font-size: 48px;
        margin-bottom: 12px;
        display: block;
    }

    .empty-text {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 50;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 32px;
        backdrop-filter: blur(10px);
        width: 90%;
        max-width: 500px;
    }

    .modal-title {
        color: #00ffc8;
        font-weight: 800;
        font-size: 20px;
        margin: 0 0 20px 0;
    }

    .modal-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .modal-label {
        color: #b0e0ff;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .modal-input,
    .modal-select {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        color: #e0e0e0;
        border-radius: 10px;
        padding: 12px 14px;
        transition: all 0.3s ease;
        font-family: 'Onest', sans-serif;
        font-size: 14px;
    }

    .modal-input:focus,
    .modal-select:focus {
        outline: none;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
        border-color: #00ffc8;
        box-shadow: 0 0 20px rgba(0, 255, 200, 0.3);
    }

    .modal-select option {
        background: #0a0a1a;
        color: #e0e0e0;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .modal-actions .btn {
        flex: 1;
        justify-content: center;
    }

    .btn-secondary {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
        color: #00ffc8;
        border: 1px solid rgba(0, 255, 200, 0.25);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.25), rgba(0, 200, 255, 0.15));
        box-shadow: 0 8px 20px rgba(0, 255, 200, 0.15);
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 32px;
        padding: 24px;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        border-top: none;
        border-radius: 0 0 16px 16px;
    }

    .pagination {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination a,
    .pagination span {
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid rgba(0, 255, 200, 0.2);
        color: #b0e0ff;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 13px;
        font-weight: 600;
    }

    .pagination a:hover {
        border-color: rgba(0, 255, 200, 0.4);
        background: rgba(0, 255, 200, 0.1);
        color: #00ffc8;
    }

    .pagination .active span {
        background: linear-gradient(135deg, #00ffc8, #00c8ff);
        color: #0a0a1a;
        border-color: rgba(0, 255, 200, 0.4);
        font-weight: 700;
    }

    @media (max-width: 1024px) {
        .anime-info-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .anime-info-right {
            width: 100%;
            flex-direction: column;
        }

        .filter-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        th, td {
            padding: 10px;
            font-size: 12px;
        }

        .actions-cell {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-primary {
            width: 100%;
            justify-content: center;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            min-width: 900px;
        }

        .modal-content {
            width: 95%;
        }

        .page-title-block h1 {
            font-size: 24px;
        }
    }
</style>

<div class="page-header">
    <div class="page-title-block">
        <h1>📺 Управление эпизодами</h1>
        <p class="page-subtitle">Управление эпизодами аниме</p>
    </div>
    <button onclick="openBulkImportModal()" class="btn btn-primary">
        📥 Массовый импорт
    </button>
</div>

@if($anime)
    <div class="anime-info-card">
        <div class="anime-info-left">
            <h2>{{ $anime->title }}</h2>
            <div class="anime-badges">
                <span class="badge">📺 {{ $episodes->total() }} эпизодов</span>
                <span class="badge">{{ strtoupper($anime->type) }}</span>
                <span class="badge" style="text-transform: capitalize;">{{ $anime->status }}</span>
            </div>
        </div>
        <div class="anime-info-right">
            <form action="{{ route('admin.episodes.import', $anime->id) }}" method="POST" class="anime-import-form" onsubmit="return confirm('Импортировать эпизоды для &quot;{{ $anime->title }}&quot;?\n\nЭто загрузит данные из AniList API.')">
                @csrf
                <select name="import_type" class="filter-select">
                    <option value="initial">Только новые</option>
                    <option value="update">Обновить все</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    ✨ Импортировать
                </button>
            </form>
        </div>
    </div>
@endif

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label">Поиск по названию аниме</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Введите название..."
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
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>✅ Опубликовано</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>📝 Черновик</option>
                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>📦 Архив</option>
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

        <button type="submit" class="btn btn-primary">
            🔍 Поиск
        </button>
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
                            <span style="color: #ff9fa0;">Удалено</span>
                        @endif
                    </td>
                    <td>
                        <span class="episode-number">{{ $episode->episode_number }}</span>
                    </td>
                    <td>{{ Str::limit($episode->title ?? 'Без названия', 25) }}</td>
                    <td>{{ $episode->duration ?? '-' }} мин</td>
                    <td>
                        <span class="status-badge status-{{ $episode->status }}">
                            {{ $episode->status }}
                        </span>
                    </td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="action-btn action-edit">
                                ✏️ Редактировать
                            </a>
                            <form action="{{ route('admin.episodes.destroy', $episode->id) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Удалить эпизод {{ $episode->episode_number }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-delete">
                                    🗑️ Удалить
                                </button>
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
                                    <button type="submit" class="btn btn-primary">
                                        📥 Импортировать эпизоды
                                    </button>
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
        <h3 class="modal-title">📥 Массовый импорт эпизодов</h3>

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
                    <option value="initial">🆕 Только новые эпизоды</option>
                    <option value="update">🔄 Обновить все эпизоды</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" onclick="closeBulkImportModal()" class="btn btn-secondary">
                    ❌ Отменить
                </button>
                <button type="submit" class="btn btn-primary">
                    ✅ Начать импорт
                </button>
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
