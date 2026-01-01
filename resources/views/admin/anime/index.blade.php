@extends('layouts.admin')
@section('title', 'Управление аниме - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .btn-create { background: #00f2ea; color: #ffffff; padding: 0.875rem 1.5rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.625rem; font-size: 0.95rem; text-decoration: none; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-create:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .filter-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; }
    .filter-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.625rem; }
    .filter-input, .filter-select { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .filter-input:focus, .filter-select:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .filter-button { background: #00f2ea; color: #ffffff; border: none; border-radius: 0.75rem; padding: 0.75rem 1.25rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; justify-content: center; }
    .filter-button:hover { background: #00d1ca; }
    .table-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #fcfdfe; }
    th { color: #6f767e; padding: 1.25rem 1.5rem; text-align: left; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f0f2f5; }
    tbody tr { border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease; }
    tbody tr:hover { background: #fcfdfe; }
    td { padding: 1.25rem 1.5rem; color: #1a1d1f; font-size: 0.9rem; font-weight: 500; }
    .anime-cell { display: flex; align-items: center; gap: 1rem; }
    .anime-poster { width: 48px; height: 68px; border-radius: 0.5rem; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .anime-title-link { color: #1a1d1f; font-weight: 700; text-decoration: none; transition: color 0.2s ease; }
    .anime-title-link:hover { color: #00f2ea; }
    .nsfw-badge { background: #fff5f5; color: #ff6b6b; padding: 0.25rem 0.5rem; border-radius: 0.375rem; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; margin-top: 0.375rem; display: inline-block; }
    .type-badge { background: #f0fdfa; color: #0d9488; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .status-badge { padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; gap: 0.375rem; }
    .status-planned { background: #f1f5f9; color: #64748b; }
    .status-ongoing { background: #fffbeb; color: #d97706; }
    .status-finished { background: #f0fdf4; color: #16a34a; }
    .status-paused { background: #fef2f2; color: #dc2626; }
    .rating-cell { font-weight: 800; color: #1a1d1f; display: flex; align-items: center; gap: 0.25rem; }
    .rating-cell i { color: #ffc107; width: 14px; height: 14px; }
    .actions-cell { display: flex; gap: 0.75rem; justify-content: flex-end; }
    .action-btn { color: #6f767e; transition: all 0.2s ease; padding: 0.5rem; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; }
    .action-btn:hover { background: #f4f4f4; color: #00f2ea; }
    .action-delete:hover { color: #ff6b6b; background: #fff5f5; }
    .pagination-container { margin-top: 2.5rem; display: flex; justify-content: center; }
</style>

<div class="page-header">
    <h1 class="page-title">Управление аниме</h1>
    <a href="{{ route('admin.anime.create') }}" class="btn-create"><i data-lucide="plus"></i> Добавить аниме</a>
</div>

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label">Поиск</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Название..." class="filter-input">
        </div>
        <div class="filter-group">
            <label class="filter-label">Статус</label>
            <select name="status" class="filter-select">
                <option value="">Все</option>
                <option value="planned" {{ request('status') === 'planned' ? 'selected' : '' }}>Планируется</option>
                <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Выходит</option>
                <option value="finished" {{ request('status') === 'finished' ? 'selected' : '' }}>Завершено</option>
                <option value="paused" {{ request('status') === 'paused' ? 'selected' : '' }}>На паузе</option>
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label">Тип</label>
            <select name="type" class="filter-select">
                <option value="">Все</option>
                <option value="tv" {{ request('type') === 'tv' ? 'selected' : '' }}>ТВ</option>
                <option value="movie" {{ request('type') === 'movie' ? 'selected' : '' }}>Фильм</option>
                <option value="ova" {{ request('type') === 'ova' ? 'selected' : '' }}>OVA</option>
            </select>
        </div>
        <button type="submit" class="filter-button"><i data-lucide="search"></i> Найти</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Аниме</th>
                <th>Тип</th>
                <th>Статус</th>
                <th>Год</th>
                <th>Рейтинг</th>
                <th class="text-right">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anime as $item)
            <tr>
                <td>
                    <div class="anime-cell">
                        <img src="{{ $item->poster_url ?? 'https://via.placeholder.com/48x68' }}" class="anime-poster">
                        <div>
                            <a href="{{ route('admin.anime.show', $item->id) }}" class="anime-title-link">{{ Str::limit($item->title, 40) }}</a>
                            @if($item->nsfw_flag) <br><span class="nsfw-badge">18+ NSFW</span> @endif
                        </div>
                    </div>
                </td>
                <td><span class="type-badge">{{ strtoupper($item->type) }}</span></td>
                <td>
                    <span class="status-badge status-{{ $item->status }}">
                        @if($item->status == 'ongoing') <i data-lucide="play" style="width:12px;height:12px"></i> @endif
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>{{ $item->year ?? '—' }}</td>
                <td>
                    <div class="rating-cell">
                        <i data-lucide="star"></i> {{ number_format($item->rating, 1) }}
                    </div>
                </td>
                <td class="actions-cell">
                    <a href="{{ route('admin.anime.edit', $item->id) }}" class="action-btn" title="Редактировать"><i data-lucide="edit-2"></i></a>
                    <form action="{{ route('admin.anime.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Удалить аниме?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-btn action-delete" title="Удалить"><i data-lucide="trash-2"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center; padding:4rem; color:#6f767e">Ничего не найдено</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">{{ $anime->links() }}</div>
<script>lucide.createIcons();</script>
@endsection
