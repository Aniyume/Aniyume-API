@extends('layouts.admin')
@section('page_title', 'Пользователи')
@section('content')
<style>
    .search-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .search-form { display: flex; align-items: center; position: relative; max-width: 400px; }
    .search-input { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; width: 100%; }
    .search-input:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .table-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #fcfdfe; }
    th { color: #6f767e; padding: 1.25rem 1.5rem; text-align: left; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f0f2f5; }
    th:last-child { text-align: right; }
    tbody tr { border-bottom: 1px solid #f0f2f5; transition: all 0.2s ease; }
    tbody tr:hover { background: #fcfdfe; }
    td { padding: 1.25rem 1.5rem; color: #1a1d1f; font-size: 0.9rem; font-weight: 500; }
    .user-cell { display: flex; align-items: center; gap: 1rem; }
    .user-avatar { width: 40px; height: 40px; border-radius: 0.75rem; background: #f4f4f4; display: flex; align-items: center; justify-content: center; color: #6f767e; font-weight: 700; font-size: 0.95rem; }
    .user-name { font-weight: 700; color: #1a1d1f; font-size: 0.9rem; }
    .user-email { color: #6f767e; font-size: 0.8rem; margin-top: 0.125rem; }
    .status-badge { padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
    .status-active { background: #f0fdf4; color: #16a34a; }
    .status-banned { background: #fef2f2; color: #dc2626; }
    .date-cell { color: #6f767e; font-size: 0.85rem; }
    .actions-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .action-btn { color: #6f767e; transition: all 0.2s ease; padding: 0.5rem; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; background: none; border: none; cursor: pointer; text-decoration: none; }
    .action-btn:hover { background: #f4f4f4; color: #00f2ea; }
    .action-delete:hover { color: #dc2626; background: #fef2f2; }
    .pagination-container { margin-top: 2rem; display: flex; justify-content: center; }
</style>

<div class="search-card">
    <form action="" method="GET" class="search-form">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по имени или email..." class="search-input">
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Пользователь</th>
                <th>Статус</th>
                <th>Регистрация</th>
                <th>Действия</th>
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
                        <span class="status-badge status-banned">Забанен</span>
                    @else
                        <span class="status-badge status-active">Активен</span>
                    @endif
                </td>
                <td class="date-cell">{{ $user->created_at->format('d.m.Y') }}</td>
                <td>
                    <div class="actions-cell">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="action-btn" title="Просмотр">👁</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Удалить пользователя навсегда?')" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn action-delete" title="Удалить">🗑</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $users->links() }}
</div>
@endsection
