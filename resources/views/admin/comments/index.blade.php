@extends('layouts.admin')

@section('title', 'Модерация комментариев - АниЮм Админ')

@section('content')

<style>
    .page-header {
        margin-bottom: 32px;
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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

    .filter-buttons {
        display: flex;
        gap: 12px;
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

    .btn-secondary {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
        color: #00ffc8;
        border: 1px solid rgba(0, 255, 200, 0.25);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.25), rgba(0, 200, 255, 0.15));
        box-shadow: 0 8px 20px rgba(0, 255, 200, 0.15);
    }

    .btn-sm {
        padding: 8px 12px;
        font-size: 12px;
        border-radius: 6px;
    }

    .btn-approve {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.2), rgba(0, 200, 255, 0.15));
        color: #00ffc8;
        border: 1px solid rgba(0, 255, 200, 0.3);
    }

    .btn-approve:hover {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.3), rgba(0, 200, 255, 0.2));
        box-shadow: 0 6px 16px rgba(0, 255, 200, 0.2);
    }

    .btn-reject {
        background: linear-gradient(135deg, rgba(255, 200, 100, 0.2), rgba(255, 180, 80, 0.15));
        color: #ffc878;
        border: 1px solid rgba(255, 200, 100, 0.3);
    }

    .btn-reject:hover {
        background: linear-gradient(135deg, rgba(255, 200, 100, 0.3), rgba(255, 180, 80, 0.2));
        box-shadow: 0 6px 16px rgba(255, 200, 100, 0.2);
    }

    .btn-delete {
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.2), rgba(255, 80, 80, 0.15));
        color: #ff9fa0;
        border: 1px solid rgba(255, 100, 100, 0.3);
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.3), rgba(255, 80, 80, 0.2));
        box-shadow: 0 6px 16px rgba(255, 100, 100, 0.2);
    }

    .btn:active {
        transform: translateY(0);
    }

    .success-alert {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 255, 200, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.3);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        color: #00ffc8;
        animation: slideDownNotif 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        padding-left: 24px;
    }

    @keyframes slideDownNotif {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-alert::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #00ffc8, #00c8ff);
        border-radius: 12px 0 0 12px;
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

    .comment-id {
        color: #b0e0ff;
        font-weight: 600;
        font-size: 12px;
    }

    .user-name {
        color: #00ffc8;
        font-weight: 700;
    }

    .anime-link {
        color: #00ffc8;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .anime-link:hover {
        text-decoration: underline;
    }

    .comment-text {
        color: #b0e8ff;
        font-size: 13px;
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
    }

    .badge-approved {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
        color: #00ffc8;
        border-color: rgba(0, 255, 200, 0.3);
    }

    .badge-pending {
        background: linear-gradient(135deg, rgba(255, 200, 100, 0.15), rgba(255, 180, 80, 0.1));
        color: #ffc878;
        border-color: rgba(255, 200, 100, 0.3);
    }

    .date-text {
        color: rgba(176, 224, 255, 0.6);
        font-size: 12px;
    }

    .actions-cell {
        display: flex;
        gap: 6px;
        align-items: center;
        flex-wrap: wrap;
    }

    .no-comments {
        text-align: center;
        padding: 60px 20px;
        color: #b0e0ff;
    }

    .no-comments-emoji {
        font-size: 48px;
        margin-bottom: 12px;
        display: block;
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

    @media (max-width: 1024px) {
        .filter-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .filter-buttons {
            flex-direction: column;
            width: 100%;
        }

        .filter-buttons .btn {
            width: 100%;
            justify-content: center;
        }

        th, td {
            padding: 10px;
            font-size: 12px;
        }

        .actions-cell {
            flex-direction: column;
        }

        .actions-cell .btn {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .filter-grid {
            grid-template-columns: 1fr;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            min-width: 900px;
        }

        .page-title {
            font-size: 24px;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">💬 Модерация комментариев</h1>
</div>

@if(session('success'))
    <div class="success-alert">
        ✓ {{ session('success') }}
    </div>
@endif

<div class="filter-card">
    <form method="GET" class="filter-grid">
        <div class="filter-group">
            <label class="filter-label">Поиск по комментариям</label>
            <input type="text" name="search" class="filter-input" placeholder="Введите текст..."
                   value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <label class="filter-label">Статус</label>
            <select name="status" class="filter-select">
                <option value="">Все статусы</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>✓ Одобренные</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ На рассмотрении</option>
            </select>
        </div>

        <div class="filter-buttons">
            <button type="submit" class="btn btn-primary">
                🔍 Фильтровать
            </button>
            <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                ↻ Очистить
            </a>
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
                    <td>
                        <span class="comment-id">#{{ $comment->id }}</span>
                    </td>
                    <td>
                        <span class="user-name">{{ $comment->user->name }}</span>
                    </td>
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
                            <span class="badge badge-approved">✓ Одобрено</span>
                        @else
                            <span class="badge badge-pending">⏳ На рассмотрении</span>
                        @endif
                    </td>
                    <td>
                        <span class="date-text">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </td>
                    <td>
                        <div class="actions-cell">
                            @if(!$comment->is_approved)
                                <form method="POST" action="{{ route('admin.comments.approve', $comment->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-approve">
                                        ✓ Одобрить
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.comments.reject', $comment->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-reject">
                                        ✕ Отклонить
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}" style="display: inline;"
                                  onsubmit="return confirm('Вы уверены? Это действие нельзя отменить.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete">
                                    🗑️ Удалить
                                </button>
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
