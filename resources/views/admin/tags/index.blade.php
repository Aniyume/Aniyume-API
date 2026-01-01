@extends('layouts.admin')
@section('title', 'Управление тегами - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .btn { padding: 0.75rem 1.25rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; text-decoration: none; white-space: nowrap; }
    .btn-primary { background: #00f2ea; color: #ffffff; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-primary:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .search-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .search-form { display: flex; gap: 0.75rem; align-items: flex-end; }
    .search-input-group { flex: 1; display: flex; flex-direction: column; }
    .search-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .search-input { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .search-input::placeholder { color: #6f767e; opacity: 0.6; }
    .search-input:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .table-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #fcfdfe; }
    th { color: #6f767e; padding: 1.25rem 1.5rem; text-align: left; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f0f2f5; }
    th:last-child { text-align: right; }
    tbody tr { border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease; }
    tbody tr:hover { background: #fcfdfe; }
    td { padding: 1.25rem 1.5rem; color: #1a1d1f; font-size: 0.9rem; font-weight: 500; }
    .tag-name { color: #1a1d1f; font-weight: 700; font-size: 0.95rem; }
    .tag-slug { color: #6f767e; font-family: monospace; font-size: 0.8rem; }
    .count-badge { display: inline-block; background: #f0fdfa; color: #0d9488; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.8rem; font-weight: 700; }
    .actions-cell { text-align: right; display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center; }
    .action-link { color: #00f2ea; text-decoration: none; font-weight: 600; transition: all 0.2s ease; font-size: 0.85rem; padding: 0.5rem 0.875rem; border-radius: 0.5rem; display: inline-flex; align-items: center; gap: 0.375rem; }
    .action-link:hover { background: #f0fdfa; color: #00d1ca; }
    .action-delete { color: #dc2626; background: none; border: none; cursor: pointer; padding: 0.5rem 0.875rem; font-weight: 600; font-size: 0.85rem; border-radius: 0.5rem; display: inline-flex; align-items: center; gap: 0.375rem; transition: all 0.2s ease; }
    .action-delete:hover { background: #fef2f2; }
    .empty-state { padding: 4rem 1.25rem; text-align: center; color: #6f767e; }
    .empty-emoji { font-size: 3rem; margin-bottom: 0.75rem; display: block; }
    .empty-text { font-size: 1rem; margin-bottom: 1.25rem; }
    .pagination-container { margin-top: 2.5rem; display: flex; justify-content: center; }
    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-primary { width: 100%; justify-content: center; }
        .search-form { flex-direction: column; }
        .search-input-group { width: 100%; }
        .table-container { overflow-x: auto; }
        table { min-width: 600px; }
        th, td { padding: 0.875rem; font-size: 0.8rem; }
        .actions-cell { white-space: nowrap; }
        .page-title { font-size: 1.5rem; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Управление тегами</h1>
    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Добавить тег</a>
</div>

<div class="search-card">
    <form method="GET" class="search-form">
        <div class="search-input-group">
            <label class="search-label">Поиск по названию</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Введите название тега..."
                   class="search-input">
        </div>
        <button type="submit" class="btn btn-primary">Найти</button>
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
                    <td><span class="tag-name">{{ $tag->name }}</span></td>
                    <td><span class="tag-slug">{{ $tag->slug }}</span></td>
                    <td><span class="count-badge">{{ number_format($tag->anime_count) }}</span></td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('admin.tags.edit', $tag->id) }}" class="action-link">Изменить</a>
                            <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Вы уверены? Тег будет удален из всех аниме.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-delete">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-emoji">🏷️</span>
                            <div class="empty-text">Теги не найдены</div>
                            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Добавить первый тег</a>
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
