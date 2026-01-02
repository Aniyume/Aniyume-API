@extends('layouts.admin')
@section('title', 'Теги - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; font-style: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .btn-create { background: #2EC4B6; color: #000; padding: 1rem 2rem; border-radius: 12px; font-weight: 900; text-transform: uppercase; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; transition: 0.3s; box-shadow: 0 0 20px rgba(46, 196, 182, 0.3); }
    .btn-create:hover { transform: translateY(-3px); box-shadow: 0 0 30px rgba(46, 196, 182, 0.5); }

    .search-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; }
    .search-form { display: flex; gap: 1rem; align-items: flex-end; }
    .search-group { flex: 1; }
    .search-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.75rem; display: block; }
    .search-input { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem; font-size: 0.9rem; font-weight: 700; width: 100%; transition: 0.3s; }
    .search-input:focus { outline: none; border-color: #2EC4B6; box-shadow: 0 0 15px rgba(46,196,182,0.1); }
    .btn-search { background: rgba(255,255,255,0.05); color: #FFF; border: none; border-radius: 12px; padding: 1rem 1.5rem; font-weight: 900; text-transform: uppercase; cursor: pointer; transition: 0.3s; }
    .btn-search:hover { background: #2EC4B6; color: #000; }

    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .tag-name { font-weight: 900; text-transform: uppercase; italic: italic; font-size: 1rem; color: #FFF; }
    .tag-slug { font-family: 'JetBrains Mono', monospace; color: rgba(255,255,255,0.3); font-size: 0.75rem; font-weight: 700; }
    .count-badge { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; padding: 6px 12px; border-radius: 8px; font-size: 0.7rem; font-weight: 900; border: 1px solid rgba(46, 196, 182, 0.2); }

    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .action-btn { background: #161616; color: #FFF; padding: 8px 15px; border-radius: 10px; font-size: 0.7rem; font-weight: 900; text-decoration: none; text-transform: uppercase; transition: 0.3s; border: 1px solid rgba(255,255,255,0.05); }
    .action-btn:hover { background: #2EC4B6; color: #000; }
    .btn-delete { color: #ff4d4d; cursor: pointer; background: transparent; border: none; }
    .btn-delete:hover { color: #FFF; background: #ff4d4d; }
</style>

<div class="page-header">
    <h1 class="page-title">Теги <span>Системы</span></h1>
    <a href="{{ route('admin.tags.create') }}" class="btn-create"><i data-lucide="plus"></i> Создать тег</a>
</div>

<div class="search-card">
    <form method="GET" class="search-form">
        <div class="search-group">
            <label class="search-label">Поиск жанра / категории</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter tag name..." class="search-input">
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
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="action-btn">Edit</a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Удалить тег?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn btn-delete">Trash</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align:center; padding:5rem; color:rgba(255,255,255,0.1); font-weight: 900; text-transform: uppercase;">Теги отсутствуют</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">{{ $tags->links() }}</div>
<script>lucide.createIcons();</script>
@endsection