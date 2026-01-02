@extends('layouts.admin')
@section('title', 'Управление аниме - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; margin: 0; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }
    
    .btn-create { background: #2EC4B6; color: #000; padding: 1rem 2rem; border-radius: 12px; border: none; font-weight: 900; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; text-decoration: none; text-transform: uppercase; box-shadow: 0 0 20px rgba(46, 196, 182, 0.3); }
    .btn-create:hover { transform: translateY(-3px); box-shadow: 0 0 30px rgba(46, 196, 182, 0.5); }

    .filter-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: flex-end; }
    .filter-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.75rem; display: block; }
    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem; transition: all 0.3s ease; font-size: 0.9rem; font-weight: 700; width: 100%; }
    .filter-input:focus { outline: none; border-color: #2EC4B6; box-shadow: 0 0 15px rgba(46,196,182,0.1); }
    
    .filter-button { background: #2EC4B6; color: #000; border: none; border-radius: 12px; padding: 1rem; font-weight: 900; cursor: pointer; text-transform: uppercase; display: flex; align-items: center; gap: 0.5rem; justify-content: center; transition: 0.3s; }
    .filter-button:hover { background: #26a69a; }

    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; font-size: 0.95rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }
    
    .anime-cell { display: flex; align-items: center; gap: 1.25rem; }
    .anime-poster { width: 50px; height: 75px; border-radius: 10px; object-fit: cover; border: 1px solid rgba(255,255,255,0.1); }
    .anime-title-link { color: #FFF; font-weight: 900; text-decoration: none; text-transform: uppercase; italic: italic; transition: 0.3s; font-size: 0.9rem; }
    .anime-title-link:hover { color: #2EC4B6; }
    
    .nsfw-badge { background: rgba(255, 77, 77, 0.1); color: #FF4D4D; padding: 4px 8px; border-radius: 6px; font-size: 0.65rem; font-weight: 900; border: 1px solid rgba(255, 77, 77, 0.2); }
    .type-badge { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; padding: 6px 12px; border-radius: 8px; font-size: 0.7rem; font-weight: 900; }
    
    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; display: inline-flex; align-items: center; gap: 0.5rem; }
    .status-planned { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.5); }
    .status-ongoing { background: rgba(255, 193, 7, 0.1); color: #FFC107; }
    .status-finished { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }
    
    .rating-cell { font-weight: 900; display: flex; align-items: center; gap: 0.4rem; color: #FFC107; }
    
    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .action-btn { background: #161616; color: rgba(255,255,255,0.3); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; transition: 0.3s; border: 1px solid rgba(255,255,255,0.05); }
    .action-btn:hover { background: #2EC4B6; color: #000; border-color: #2EC4B6; }
    .action-delete:hover { background: #FF4D4D; color: #FFF; border-color: #FF4D4D; }
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
                <option value="planned" {{ request('status') === 'planned' ? 'selected' : '' }}>Планируется</option>
                <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Выходит</option>
                <option value="finished" {{ request('status') === 'finished' ? 'selected' : '' }}>Завершено</option>
            </select>
        </div>
        <button type="submit" class="filter-button"><i data-lucide="search"></i> Фильтр</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Релиз</th>
                <th>Тип</th>
                <th>Статус</th>
                <th>Год</th>
                <th>Рейтинг</th>
                <th style="text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anime as $item)
            <tr>
                <td>
                    <div class="anime-cell">
                        <img src="{{ $item->poster_url }}" class="anime-poster">
                        <div>
                            <a href="{{ route('admin.anime.show', $item->id) }}" class="anime-title-link">{{ $item->title }}</a>
                            @if($item->nsfw_flag) <br><span class="nsfw-badge">NSFW 18+</span> @endif
                        </div>
                    </div>
                </td>
                <td><span class="type-badge">{{ strtoupper($item->type) }}</span></td>
                <td><span class="status-badge status-{{ $item->status }}">{{ $item->status }}</span></td>
                <td>{{ $item->year }}</td>
                <td><div class="rating-cell"><i data-lucide="star" style="width:14px"></i> {{ number_format($item->rating, 1) }}</div></td>
                <td class="actions-cell">
                    <a href="{{ route('admin.anime.edit', $item->id) }}" class="action-btn"><i data-lucide="edit-3" style="width:18px"></i></a>
                    <form action="{{ route('admin.anime.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Удалить?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-btn action-delete"><i data-lucide="trash-2" style="width:18px"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">{{ $anime->links() }}</div>
<script>lucide.createIcons();</script>
@endsection