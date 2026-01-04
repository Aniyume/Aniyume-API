@extends('layouts.admin')
@section('title', 'Модерация комментариев - AniYume Админ')
@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header { margin-bottom: 2.5rem; animation: fadeInUp 0.5s ease; }
    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 5vw, 2.5rem); text-transform: uppercase; font-style: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; }

    .filter-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }

    .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; align-items: flex-end; }
    .filter-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.6rem; display: block; }
    .filter-input, .filter-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 0.85rem; transition: 0.3s; font-size: 0.85rem; font-weight: 700; width: 100%; }

    .btn-submit { background: #2EC4B6; color: #000; border: none; border-radius: 12px; padding: 0.85rem; font-weight: 900; cursor: pointer; text-transform: uppercase; transition: 0.3s; font-size: 0.75rem; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.5); border: none; border-radius: 12px; padding: 0.85rem; font-weight: 900; text-transform: uppercase; text-decoration: none; text-align: center; font-size: 0.75rem; transition: 0.3s; }

    .table-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        overflow-x: auto;
        animation: fadeInUp 0.5s ease 0.2s forwards;
        opacity: 0;
    }

    table { width: 100%; border-collapse: collapse; min-width: 1000px; }
    th { color: rgba(255,255,255,0.3); padding: 1.25rem 1.5rem; text-align: left; font-weight: 900; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.15em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.25rem 1.5rem; color: #FFF; font-size: 0.85rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .anime-link { color: #2EC4B6; text-decoration: none; font-weight: 800; font-style: italic; text-transform: uppercase; font-size: 0.75rem; transition: 0.3s; }
    .anime-link:hover { opacity: 0.7; }
    .comment-text { color: rgba(255,255,255,0.7); font-style: italic; font-weight: 500; max-width: 300px; }

    .badge { padding: 6px 12px; border-radius: 8px; font-size: 0.6rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; }
    .badge-approved { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }
    .badge-pending { background: rgba(255, 193, 7, 0.1); color: #FFC107; }

    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .btn-action { padding: 8px 14px; border-radius: 10px; font-weight: 900; font-size: 0.65rem; text-transform: uppercase; border: none; cursor: pointer; transition: 0.3s; }
    .btn-approve { background: #2EC4B6; color: #000; }
    .btn-reject { background: #FFC107; color: #000; }
    .btn-delete { background: rgba(255, 77, 77, 0.1); color: #FF4D4D; border: 1px solid rgba(255, 77, 77, 0.2); }

    @media (max-width: 768px) {
        .filter-grid { grid-template-columns: 1fr; }
        .actions-cell { flex-direction: column; }
        .btn-action { width: 100%; text-align: center; }
    }

    .pagination-wrapper { margin-top: 2.5rem; display: flex; justify-content: center; }
    nav[role="navigation"] { display: flex; gap: 0.5rem; }
    nav[role="navigation"] a, nav[role="navigation"] span { background: #111 !important; border: 1px solid rgba(255,255,255,0.1) !important; color: #fff !important; padding: 0.75rem 1rem !important; border-radius: 10px !important; text-decoration: none !important; font-weight: 800 !important; font-size: 0.8rem !important; }
    nav[role="navigation"] .active span { background: #2EC4B6 !important; color: #000 !important; }
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
                    <td style="font-weight: 900; text-transform: uppercase; font-style: italic;">{{ $comment->user->name }}</td>
                    <td>
                        <a href="{{ route('admin.anime.show', $comment->anime_id) }}" class="anime-link">
                            {{ Str::limit($comment->anime->title, 25) }}
                        </a>
                    </td>
                    <td class="comment-text"><div class="truncate">"{{ $comment->comment }}"</div></td>
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

<div class="pagination-wrapper">
    {{ $comments->links() }}
</div>
<script>lucide.createIcons();</script>
@endsection
