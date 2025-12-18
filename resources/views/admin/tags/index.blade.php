@extends('layouts.admin')

@section('title', 'Управление тегами - АниЮм Админ')

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

    .page-title {
        background: linear-gradient(135deg, #00ffc8, #00c8ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 28px;
        margin: 0;
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

    .search-card {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(10px);
        margin-bottom: 24px;
    }

    .search-form {
        display: flex;
        gap: 12px;
        align-items: flex-end;
    }

    .search-input-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .search-label {
        color: #b0e0ff;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .search-input {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        color: #e0e0e0;
        border-radius: 10px;
        padding: 12px 14px;
        transition: all 0.3s ease;
        font-family: 'Onest', sans-serif;
        font-size: 14px;
    }

    .search-input::placeholder {
        color: rgba(224, 224, 224, 0.4);
    }

    .search-input:focus {
        outline: none;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
        border-color: #00ffc8;
        box-shadow: 0 0 20px rgba(0, 255, 200, 0.3);
    }

    .btn-search {
        background: linear-gradient(135deg, #00ffc8, #00c8ff);
        color: #0a0a1a;
        padding: 12px 24px;
    }

    .btn-search:hover {
        box-shadow: 0 12px 30px rgba(0, 255, 200, 0.3);
        transform: translateY(-2px);
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

    th:last-child {
        text-align: right;
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

    .tag-name {
        color: #00ffc8;
        font-weight: 700;
        font-size: 15px;
    }

    .tag-slug {
        color: #b0e0ff;
        font-family: 'Space Mono', monospace;
        font-size: 12px;
    }

    .count-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
        color: #00ffc8;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        border: 1px solid rgba(0, 255, 200, 0.25);
    }

    .actions-cell {
        text-align: right;
    }

    .action-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: #00ffc8;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-left: 16px;
        font-size: 13px;
    }

    .action-link:first-child {
        margin-left: 0;
    }

    .action-link:hover {
        color: #00ffc8;
        text-decoration: underline;
    }

    .action-delete {
        color: #ff9fa0;
    }

    .action-delete:hover {
        color: #ff6464;
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

    .pagination .disabled span {
        opacity: 0.5;
        cursor: not-allowed;
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

        .search-form {
            flex-direction: column;
        }

        .search-input-group {
            width: 100%;
        }

        .btn-search {
            width: 100%;
            justify-content: center;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            min-width: 600px;
        }

        th, td {
            padding: 12px;
            font-size: 12px;
        }

        .actions-cell {
            white-space: nowrap;
        }

        .action-link {
            margin-left: 8px;
            font-size: 12px;
        }

        .page-title {
            font-size: 24px;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">🏷️ Управление тегами</h1>
    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
        ➕ Добавить тег
    </a>
</div>

<div class="search-card">
    <form method="GET" class="search-form">
        <div class="search-input-group">
            <label class="search-label">Поиск по названию</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Введите название тега..."
                   class="search-input">
        </div>
        <button type="submit" class="btn btn-search">
            🔍 Поиск
        </button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="width: 40%;">Название</th>
                <th style="width: 35%;">Слаг</th>
                <th style="width: 15%;">Аниме</th>
                <th style="width: 10%;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
                <tr>
                    <td>
                        <span class="tag-name">{{ $tag->name }}</span>
                    </td>
                    <td>
                        <span class="tag-slug">{{ $tag->slug }}</span>
                    </td>
                    <td>
                        <span class="count-badge">{{ number_format($tag->anime_count) }}</span>
                    </td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="action-link">
                            ✏️ Редактировать
                        </a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Вы уверены? Тег будет удален из всех аниме.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-link action-delete" style="background: none; border: none; cursor: pointer; padding: 0;">
                                🗑️ Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-emoji">🏷️</span>
                            <div class="empty-text">Теги не найдены</div>
                            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
                                ➕ Добавить первый тег
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($tags->count() > 0)
    <div class="pagination-container">
        {{ $tags->links() }}
    </div>
@endif

@endsection
