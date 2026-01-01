@extends('layouts.admin')
@section('title', 'Модерация комментариев - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .filter-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; }
    .filter-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.625rem; }
    .filter-input, .filter-select { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .filter-input:focus, .filter-select:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .filter-button { background: #00f2ea; color: #ffffff; border: none; border-radius: 0.75rem; padding: 0.75rem 1.25rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; justify-content: center; }
    .filter-button:hover { background: #00d1ca; }
    .filter-buttons { display: flex; gap: 0.75rem; }
    .btn-secondary { background: #ffffff; color: #6f767e; border: 2px solid #f0f2f5; border-radius: 0.75rem; padding: 0.75rem 1.25rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; text-decoration: none; }
    .btn-secondary:hover { background: #f4f4f4; border-color: #e0e2e5; }
    .success-alert { background: #f0fdf4; border: 1px solid #d1fae5; border-radius: 0.75rem; padding: 1rem 1.25rem; margin-bottom: 2rem; color: #16a34a; font-weight: 600; }
    .table-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #fcfdfe; }
    th { color: #6f767e; padding: 1.25rem 1.5rem; text-align: left; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f0f2f5; }
    tbody tr { border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease; }
    tbody tr:hover { background: #fcfdfe; }
    td { padding: 1.25rem 1.5rem; color: #1a1d1f; font-size: 0.9rem; font-weight: 500; }
    .comment-id { color: #6f767e; font-weight: 700; font-size: 0.85rem; }
    .user-name { color: #1a1d1f; font-weight: 700; }
    .anime-link { color: #00f2ea; text-decoration: none; font-weight: 600; transition: color 0.2s ease; }
    .anime-link:hover { color: #00d1ca; }
    .comment-text { color: #6f767e; font-size: 0.85rem; }
    .badge { display: inline-block; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .badge-approved { background: #f0fdf4; color: #16a34a; }
    .badge-pending { background: #fffbeb; color: #d97706; }
    .date-text { color: #6f767e; font-size: 0.85rem; }
    .actions-cell { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; justify-content: flex-end; }
    .btn-sm { padding: 0.5rem 0.875rem; border-radius: 0.5rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.375rem; }
    .btn-approve { background: #f0fdf4; color: #16a34a; border: 1px solid #d1fae5; }
    .btn-approve:hover { background: #dcfce7; }
    .btn-reject { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .btn-reject:hover { background: #fef3c7; }
    .btn-delete { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .btn-delete:hover { background: #fee2e2; }
    .no-comments { text-align: center; padding: 4rem 1.25rem; color: #6f767e; }
    .no-comments-emoji { font-size: 3rem; margin-bottom: 0.75rem; display: block; }
    .pagination-container { margin-top: 2.5rem; display: flex; justify-content: center; }
</style>

<div class="page-header">
    <h1 class="page-title">Модерация комментариев</h1>
</div>

@if(session('success'))
<div class="success-alert">
    {{ session('success') }}
</div>
@endif

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label">Поиск</label>
            <input type="text" name="search" class="filter-input" placeholder="Введите текст..." value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <label class="filter-label">Статус</label>
            <select name="status" class="filter-select">
                <option value="">Все статусы</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Одобренные</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>На рассмотрении</option>
            </select>
        </div>

        <div class="filter-buttons">
            <button type="submit" class="filter-button">Фильтровать</button>
            <a href="{{ route('admin.comments.index') }}" class="btn-secondary">Очистить</a>
        </div>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th style="width: 12%;">Пользователь</th>
                <th style="width: 15%;">Аниме</th>
                <th style="width: 30%;">Комментарий</th>
                <th style="width: 12%;">Статус</th>
                <th style="width: 12%;">Дата</th>
                <th style="width: 15%;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td><span class="comment-id">#{{ $comment->id }}</span></td>
                    <td><span class="user-name">{{ $comment->user->name }}</span></td>
                    <td>
                        <a href="{{ route('admin.anime.show', $comment->anime_id) }}" class="anime-link">
                            {{ Str::limit($comment->anime->title, 25) }}
                        </a>
                    </td>
                    <td>
                        <span class="comment-text" title="{{ $comment->comment }}">
                            {{ Str::limit($comment->comment, 50) }}
                        </span>
                    </td>
                    <td>
                        @if($comment->is_approved)
                            <span class="badge badge-approved">Одобрено</span>
                        @else
                            <span class="badge badge-pending">На рассмотрении</span>
                        @endif
                    </td>
                    <td><span class="date-text">{{ $comment->created_at->format('d.m.Y H:i') }}</span></td>
                    <td>
                        <div class="actions-cell">
                            @if(!$comment->is_approved)
                                <form method="POST" action="{{ route('admin.comments.approve', $comment->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-sm btn-approve">Одобрить</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.comments.reject', $comment->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-sm btn-reject">Отклонить</button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}" style="display: inline;"
                                  onsubmit="return confirm('Вы уверены? Это действие нельзя отменить.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="no-comments">
                            <span class="no-comments-emoji">💬</span>
                            <p>Комментарии не найдены</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($comments->count() > 0)
<div class="pagination-container">
    {{ $comments->links() }}
</div>
@endif
@endsection
