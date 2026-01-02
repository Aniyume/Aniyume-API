@extends('layouts.admin')
@section('title', 'Модерация комментариев - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; font-style: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; }

    .filter-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: flex-end; }
    .filter-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.75rem; display: block; }
    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem; transition: 0.3s; font-size: 0.9rem; font-weight: 700; width: 100%; }
    .filter-input:focus, .filter-select:focus { outline: none; border-color: #2EC4B6; }
    
    .btn-submit { background: #2EC4B6; color: #000; border: none; border-radius: 12px; padding: 1rem; font-weight: 900; cursor: pointer; text-transform: uppercase; transition: 0.3s; font-size: 0.8rem; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.5); border: none; border-radius: 12px; padding: 1rem; font-weight: 900; text-transform: uppercase; text-decoration: none; text-align: center; font-size: 0.8rem; transition: 0.3s; }
    .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #FFF; }

    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; font-size: 0.9rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .anime-link { color: #2EC4B6; text-decoration: none; font-weight: 800; italic: italic; text-transform: uppercase; font-size: 0.8rem; }
    .comment-text { color: rgba(255,255,255,0.7); font-style: italic; font-weight: 500; }
    
    .badge { padding: 6px 12px; border-radius: 8px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; }
    .badge-approved { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }
    .badge-pending { background: rgba(255, 193, 7, 0.1); color: #FFC107; }

    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .btn-action { padding: 8px 14px; border-radius: 10px; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; border: none; cursor: pointer; transition: 0.3s; }
    .btn-approve { background: #2EC4B6; color: #000; }
    .btn-reject { background: #FFC107; color: #000; }
    .btn-delete { background: rgba(255, 77, 77, 0.1); color: #FF4D4D; border: 1px solid rgba(255, 77, 77, 0.2); }
    .btn-delete:hover { background: #FF4D4D; color: #FFF; }
</style>

<div class="page-header">
    <h1 class="page-title">Модерация <span>Комментариев</span></h1>
</div>

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label">Поиск по тексту</label>
            <input type="text" name="search" class="filter-input" placeholder="..." value="{{ request('search') }}">
        </div>
        <div class="filter-group">
            <label class="filter-label">Статус</label>
            <select name="status" class="filter-select">
                <option value="">Все</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Одобрено</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Ожидает</option>
            </select>
        </div>
        <button type="submit" class="btn-submit">Применить</button>
        <a href="{{ route('admin.comments.index') }}" class="btn-secondary">Сброс</a>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Автор</th>
                <th>Релиз</th>
                <th>Сообщение</th>
                <th>Статус</th>
                <th>Дата</th>
                <th style="text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td style="font-weight: 900; text-transform: uppercase; italic: italic;">{{ $comment->user->name }}</td>
                    <td>
                        <a href="{{ route('admin.anime.show', $comment->anime_id) }}" class="anime-link">
                            {{ Str::limit($comment->anime->title, 20) }}
                        </a>
                    </td>
                    <td class="comment-text">"{{ Str::limit($comment->comment, 60) }}"</td>
                    <td>
                        <span class="badge {{ $comment->is_approved ? 'badge-approved' : 'badge-pending' }}">
                            {{ $comment->is_approved ? 'Approved' : 'Pending' }}
                        </span>
                    </td>
                    <td style="color: rgba(255,255,255,0.3); font-size: 0.75rem;">{{ $comment->created_at->format('d.m / H:i') }}</td>
                    <td class="actions-cell">
                        @if(!$comment->is_approved)
                            <form method="POST" action="{{ route('admin.comments.approve', $comment->id) }}">
                                @csrf
                                <button type="submit" class="btn-action btn-approve">Одобрить</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.comments.reject', $comment->id) }}">
                                @csrf
                                <button type="submit" class="btn-action btn-reject">Снять</button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}" onsubmit="return confirm('Удалить?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete"><i data-lucide="trash-2" style="width: 14px"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; padding:5rem; color:rgba(255,255,255,0.2); font-weight: 900; text-transform: uppercase;">Пусто</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">{{ $comments->links() }}</div>
<script>lucide.createIcons();</script>
@endsection