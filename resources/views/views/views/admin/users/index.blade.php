@extends('layouts.admin')
@section('title', 'Юзеры - AniYume Админ')
@section('content')
<style>
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; margin-bottom: 2.5rem; }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .search-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 2rem; margin-bottom: 2.5rem; }
    .search-form { display: flex; gap: 1rem; max-width: 500px; }
    .search-input { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 12px; padding: 1rem 1.5rem; font-size: 0.9rem; font-weight: 700; width: 100%; transition: 0.3s; }
    .search-input:focus { outline: none; border-color: #2EC4B6; box-shadow: 0 0 20px rgba(46, 196, 182, 0.1); }
    .btn-search { background: #2EC4B6; color: #000; border: none; border-radius: 12px; padding: 0 1.5rem; font-weight: 900; cursor: pointer; text-transform: uppercase; }

    .table-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    th { color: rgba(255,255,255,0.3); padding: 1.5rem; text-align: left; font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; border-bottom: 1px solid rgba(255,255,255,0.05); }
    td { padding: 1.5rem; color: #FFF; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.02); }

    .user-cell { display: flex; align-items: center; gap: 1.25rem; }
    .user-avatar { 
        width: 44px; height: 44px; border-radius: 12px; background: #161616; 
        display: flex; align-items: center; justify-content: center; 
        color: #2EC4B6; font-weight: 900; font-size: 1.1rem; border: 1px solid rgba(255,255,255,0.05);
    }
    .user-name { font-weight: 900; color: #FFF; text-transform: uppercase; italic: italic; font-size: 0.95rem; }
    .user-email { color: rgba(255,255,255,0.3); font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; }

    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; }
    .status-active { background: rgba(46, 196, 182, 0.1); color: #2EC4B6; }
    .status-banned { background: rgba(255, 77, 77, 0.1); color: #FF4D4D; border: 1px solid rgba(255, 77, 77, 0.2); }

    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .action-btn { 
        background: #161616; color: rgba(255,255,255,0.3); width: 40px; height: 40px; 
        border-radius: 10px; display: flex; align-items: center; justify-content: center; 
        transition: 0.3s; border: 1px solid rgba(255,255,255,0.05); 
    }
    .action-btn:hover { background: #2EC4B6; color: #000; border-color: #2EC4B6; }
    .action-delete:hover { background: #FF4D4D; color: #FFF; border-color: #FF4D4D; }
</style>

<h1 class="page-title">Управление <span>Юзерами</span></h1>

<div class="search-card">
    <form action="" method="GET" class="search-form">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="NAME OR EMAIL..." class="search-input">
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
                        <span class="status-badge status-banned">Terminated</span>
                    @else
                        <span class="status-badge status-active">Active</span>
                    @endif
                </td>
                <td style="color: rgba(255,255,255,0.3); font-size: 0.8rem; font-weight: 800;">
                    {{ $user->created_at->format('d.m.Y') }}
                </td>
                <td class="actions-cell">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="action-btn" title="Profile"><i data-lucide="eye" style="width: 18px;"></i></a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Уничтожить аккаунт?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-btn action-delete"><i data-lucide="trash-2" style="width: 18px;"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">
    {{ $users->links() }}
</div>

<script>lucide.createIcons();</script>
@endsection