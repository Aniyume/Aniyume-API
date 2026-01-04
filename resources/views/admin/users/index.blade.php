@extends('layouts.admin')
@section('title', 'Юзеры - AniYume Админ')
@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-title {
        color: #FFF;
        font-weight: 900;
        font-size: clamp(1.5rem, 5vw, 2.5rem);
        text-transform: uppercase;
        letter-spacing: -0.05em;
        margin-bottom: 2.5rem;
        animation: fadeInUp 0.5s ease;
    }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .search-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }
    .search-form { display: flex; gap: 1rem; max-width: 600px; flex-wrap: wrap; }
    .search-input { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 0.9rem 1.5rem; font-size: 0.9rem; font-weight: 700; flex: 1; min-width: 200px; transition: 0.3s; }
    .search-input:focus { outline: none; border-color: #2EC4B6; box-shadow: 0 0 20px rgba(46, 196, 182, 0.1); }
    .btn-search { background: #2EC4B6; color: #000; border: none; border-radius: 12px; padding: 0.9rem 2rem; font-weight: 900; cursor: pointer; text-transform: uppercase; font-size: 0.8rem; transition: 0.3s; }
    .btn-search:hover { background: #26a69a; transform: translateY(-2px); }

    .table-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        overflow-x: auto;
        animation: fadeInUp 0.5s ease 0.2s forwards;
        opacity: 0;
    }
    table { width: 100%; border-collapse: collapse; min-width: 900px; }
    th { color: rgba(255,255,255,0.3); padding: 1.25rem 1.5rem; text-align: left; font-weight: 900; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.2em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.25rem 1.5rem; color: #FFF; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); font-size: 0.9rem; }

    .user-cell { display: flex; align-items: center; gap: 1.25rem; }
    .user-avatar {
        width: 44px; height: 44px; border-radius: 12px; background: #161616;
        display: flex; align-items: center; justify-content: center;
        color: #2EC4B6; font-weight: 900; font-size: 1.1rem; border: 1px solid rgba(255,255,255,0.05);
        flex-shrink: 0;
    }
    .user-name { font-weight: 900; color: #FFF; text-transform: uppercase; font-style: italic; font-size: 0.95rem; }
    .user-email { color: rgba(255,255,255,0.3); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; }

    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.6rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; }
    .status-active { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }
    .status-banned { background: rgba(255, 77, 77, 0.1); color: #FF4D4D; border: 1px solid rgba(255, 77, 77, 0.2); }

    .actions-cell { display: flex; gap: 0.6rem; justify-content: flex-end; }
    .action-btn {
        background: #161616; color: rgba(255,255,255,0.3); width: 38px; height: 38px;
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
        transition: 0.3s; border: 1px solid rgba(255,255,255,0.05);
    }
    .action-btn:hover { background: #2EC4B6; color: #000; border-color: #2EC4B6; transform: rotate(10deg); }
    .action-delete:hover { background: #FF4D4D; color: #FFF; border-color: #FF4D4D; }

    .pagination-wrapper { margin-top: 2.5rem; display: flex; justify-content: center; }

    @media (max-width: 640px) {
        .search-form { flex-direction: column; }
        .btn-search { width: 100%; }
    }
</style>

<h1 class="page-title">Управление <span>Юзерами</span></h1>

<div class="search-card">
    <form action="" method="GET" class="search-form">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Имя или Email..." class="search-input">
        <button type="submit" class="btn-search">Найти</button>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Идентификация</th>
                <th>Статус доступа</th>
                <th>Дата вступления</th>
                <th style="text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div class="user-cell">
                        <div class="user-avatar">{{ substr($user->name, 0, 1) }}</div>
                        <div>
                            <div class="user-name">{{ $user->name }}</div>
                            <div class="user-email">{{ $user->email }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($user->is_banned)
                        <span class="status-badge status-banned">Заблокирован</span>
                    @else
                        <span class="status-badge status-active">Активен</span>
                    @endif
                </td>
                <td style="color: rgba(255,255,255,0.3); font-size: 0.75rem; font-weight: 800;">
                    {{ $user->created_at->format('d.m.Y') }}
                </td>
                <td class="actions-cell">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="action-btn" title="Профиль"><i data-lucide="eye" style="width: 16px;"></i></a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Удалить аккаунт навсегда?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-btn action-delete" style="cursor: pointer; background: transparent;"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@php
    $paginator =  $users;
@endphp

@if ($paginator && $paginator->hasPages())
<div class="pagination-wrapper">
    <nav class="custom-pagination">
        @if ($paginator->onFirstPage())
            <span class="page-link disabled"><i data-lucide="chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link"><i data-lucide="chevron-left"></i></a>
        @endif

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $current + 2);
        @endphp

        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}" class="page-link">1</a>
            @if ($start > 2)
                <span class="page-dots">...</span>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <span class="page-link active">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
            @endif
        @endfor

        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="page-dots">...</span>
            @endif
            <a href="{{ $paginator->url($last) }}" class="page-link">{{ $last }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link"><i data-lucide="chevron-right"></i></a>
        @else
            <span class="page-link disabled"><i data-lucide="chevron-right"></i></span>
        @endif
    </nav>
</div>

<style>
    .pagination-wrapper {
        margin-top: 2.5rem;
        display: flex;
        justify-content: center;
        animation: fadeInUp 0.5s ease 0.3s forwards;
        opacity: 0;
    }

    .custom-pagination {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .page-link {
        background: #111111;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.6);
        min-width: 45px;
        height: 45px;
        padding: 0 1rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 900;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .page-link:hover:not(.disabled):not(.active) {
        background: rgba(46, 196, 182, 0.1);
        border-color: #2EC4B6;
        color: #2EC4B6;
        transform: translateY(-2px);
    }

    .page-link.active {
        background: linear-gradient(135deg, #2EC4B6 0%, #20a89a 100%);
        border-color: #2EC4B6;
        color: #000;
        box-shadow: 0 0 20px rgba(46, 196, 182, 0.4);
        transform: scale(1.05);
    }

    .page-link.disabled {
        background: #0a0a0a;
        border-color: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.15);
        cursor: not-allowed;
    }

    .page-link i {
        width: 18px;
        height: 18px;
    }

    .page-dots {
        color: rgba(255, 255, 255, 0.3);
        font-weight: 900;
        padding: 0 0.5rem;
        user-select: none;
    }

    @media (max-width: 768px) {
        .page-link {
            min-width: 40px;
            height: 40px;
            font-size: 0.85rem;
            padding: 0 0.75rem;
        }
    }
</style>
@endif

<script>lucide.createIcons();</script>
@endsection
