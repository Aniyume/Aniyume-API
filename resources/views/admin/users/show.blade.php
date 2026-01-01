@extends('layouts.admin')
@section('page_title', 'Профиль пользователя')
@section('content')
<style>
    .profile-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; }
    .profile-sidebar { display: flex; flex-direction: column; gap: 2rem; }
    .profile-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2.5rem; text-align: center; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .profile-avatar { width: 96px; height: 96px; background: #00f2ea; border-radius: 1.5rem; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 2rem; font-weight: 800; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .profile-name { color: #1a1d1f; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.25rem; }
    .profile-email { color: #6f767e; font-size: 0.85rem; font-weight: 600; }
    .profile-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #f0f2f5; }
    .stat-item { display: flex; flex-direction: column; }
    .stat-value { color: #00f2ea; font-size: 1.25rem; font-weight: 800; }
    .stat-label { color: #6f767e; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.25rem; }
    .ban-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .ban-title { color: #1a1d1f; font-size: 1.125rem; font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .ban-reason-box { background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1.5rem; }
    .ban-reason-label { color: #dc2626; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .ban-reason-text { color: #dc2626; font-size: 0.9rem; font-weight: 600; }
    .ban-textarea { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 500; width: 100%; min-height: 120px; resize: vertical; }
    .ban-textarea:focus { outline: none; border-color: #dc2626; background: #ffffff; }
    .btn-ban { background: #dc2626; color: #ffffff; padding: 1rem 1.5rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; width: 100%; box-shadow: 0 4px 14px rgba(220, 38, 38, 0.2); }
    .btn-ban:hover { background: #b91c1c; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(220, 38, 38, 0.3); }
    .btn-unban { background: #16a34a; color: #ffffff; padding: 1rem 1.5rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; width: 100%; box-shadow: 0 4px 14px rgba(22, 163, 74, 0.2); }
    .btn-unban:hover { background: #15803d; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(22, 163, 74, 0.3); }
    .activity-card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .activity-title { color: #1a1d1f; font-size: 1.125rem; font-weight: 800; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem; }
    .activity-list { display: flex; flex-direction: column; gap: 1.5rem; }
    .activity-item { background: #fcfdfe; border: 1px solid #f0f2f5; border-radius: 0.75rem; padding: 1.5rem; }
    .activity-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem; }
    .activity-anime { color: #00f2ea; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
    .activity-date { color: #6f767e; font-size: 0.7rem; font-weight: 600; }
    .activity-text { color: #1a1d1f; font-size: 0.9rem; font-weight: 500; line-height: 1.6; }
    .empty-state { text-align: center; padding: 5rem 1.25rem; color: #6f767e; }
    .empty-emoji { font-size: 3rem; margin-bottom: 1rem; display: block; }
    .empty-text { font-weight: 600; }
    @media (max-width: 1024px) {
        .profile-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="profile-grid">
    <div class="profile-sidebar">
        <div class="profile-card">
            <div class="profile-avatar">{{ substr($user->name, 0, 1) }}</div>
            <h2 class="profile-name">{{ $user->name }}</h2>
            <p class="profile-email">{{ $user->email }}</p>
            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $user->comments->count() }}</div>
                    <div class="stat-label">Комментов</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">0</div>
                    <div class="stat-label">В списке</div>
                </div>
            </div>
        </div>

        <div class="ban-card">
            <h3 class="ban-title">🛡 Управление доступом</h3>
            @if($user->is_banned)
                <div class="ban-reason-box">
                    <div class="ban-reason-label">Причина бана</div>
                    <div class="ban-reason-text">{{ $user->ban_reason }}</div>
                </div>
                <form action="{{ route('admin.users.unban', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-unban">Разблокировать</button>
                </form>
            @else
                <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                    @csrf
                    <textarea name="reason" placeholder="Укажите причину блокировки..." class="ban-textarea" required></textarea>
                    <button type="submit" class="btn-ban" style="margin-top: 1rem;">Заблокировать</button>
                </form>
            @endif
        </div>
    </div>

    <div class="activity-card">
        <h3 class="activity-title">💬 Активность</h3>
        <div class="activity-list">
            @forelse($user->comments as $comment)
            <div class="activity-item">
                <div class="activity-header">
                    <span class="activity-anime">{{ $comment->anime->title }}</span>
                    <span class="activity-date">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="activity-text">{{ $comment->comment }}</p>
            </div>
            @empty
            <div class="empty-state">
                <span class="empty-emoji">📭</span>
                <p class="empty-text">Активности пока нет</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
