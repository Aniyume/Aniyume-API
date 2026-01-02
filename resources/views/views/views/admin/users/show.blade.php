@extends('layouts.admin')
@section('title', 'Профиль: ' . $user->name . ' - AniYume Админ')
@section('content')
<style>
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; margin-bottom: 2rem; }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .profile-grid { display: grid; grid-template-columns: 350px 1fr; gap: 2.5rem; }
    
    /* SIDEBAR CARD */
    .profile-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 3rem; text-align: center; position: sticky; top: 120px; }
    .profile-avatar { 
        width: 100px; height: 100px; background: #161616; border-radius: 24px; 
        margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; 
        color: #2EC4B6; font-size: 2.5rem; font-weight: 900; 
        border: 2px solid rgba(46, 196, 182, 0.2); box-shadow: 0 0 30px rgba(46, 196, 182, 0.1);
    }
    .profile-name { color: #FFF; font-size: 1.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: -0.05em; margin-bottom: 0.5rem; italic: italic; }
    .profile-email { color: rgba(255,255,255,0.3); font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; }
    
    .profile-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 2.5rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
    .stat-value { color: #2EC4B6; font-size: 1.5rem; font-weight: 900; font-style: italic; }
    .stat-label { color: rgba(255,255,255,0.3); font-size: 0.65rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 5px; }

    /* BAN SECTION */
    .ban-card { background: #111111; border: 1px solid rgba(255, 77, 77, 0.1); border-radius: 24px; padding: 2rem; margin-top: 2rem; }
    .ban-title { color: #FF4D4D; font-size: 1rem; font-weight: 900; text-transform: uppercase; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; }
    
    .ban-reason-box { background: rgba(255, 77, 77, 0.05); border: 1px solid rgba(255, 77, 77, 0.1); border-radius: 14px; padding: 1.5rem; margin-bottom: 1.5rem; }
    .ban-reason-label { color: rgba(255, 77, 77, 0.5); font-size: 0.65rem; font-weight: 900; text-transform: uppercase; margin-bottom: 5px; }
    .ban-reason-text { color: #FF4D4D; font-size: 0.9rem; font-weight: 800; font-style: italic; }

    .ban-textarea { background: #161616; border: 1px solid rgba(255,255,255,0.05); color: #FFF; border-radius: 14px; padding: 1.25rem; font-size: 0.9rem; font-weight: 600; width: 100%; min-height: 120px; transition: 0.3s; }
    .ban-textarea:focus { outline: none; border-color: #FF4D4D; box-shadow: 0 0 20px rgba(255, 77, 77, 0.1); }

    .btn-action { padding: 1.25rem; border-radius: 14px; border: none; font-weight: 900; cursor: pointer; transition: 0.3s; width: 100%; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.85rem; }
    .btn-ban { background: #FF4D4D; color: #FFF; box-shadow: 0 0 20px rgba(255, 77, 77, 0.2); }
    .btn-ban:hover { transform: scale(1.02); box-shadow: 0 0 30px rgba(255, 77, 77, 0.4); }
    .btn-unban { background: #2EC4B6; color: #000; box-shadow: 0 0 20px rgba(46, 196, 182, 0.2); }
    .btn-unban:hover { transform: scale(1.02); }

    /* ACTIVITY */
    .activity-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 3rem; }
    .activity-title { color: #FFF; font-size: 1.5rem; font-weight: 900; text-transform: uppercase; italic: italic; margin-bottom: 2.5rem; display: flex; align-items: center; gap: 15px; }
    .activity-title i { color: #2EC4B6; }
    
    .activity-item { background: #161616; border: 1px solid rgba(255,255,255,0.02); border-radius: 16px; padding: 2rem; margin-bottom: 1.5rem; transition: 0.3s; }
    .activity-item:hover { border-color: rgba(46, 196, 182, 0.2); transform: translateX(5px); }
    .activity-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .activity-anime { color: #2EC4B6; font-size: 0.8rem; font-weight: 900; text-transform: uppercase; italic: italic; letter-spacing: 0.05em; }
    .activity-date { color: rgba(255,255,255,0.2); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; }
    .activity-text { color: rgba(255,255,255,0.8); font-size: 1rem; font-weight: 500; line-height: 1.6; }

    .empty-state { text-align: center; padding: 6rem 0; color: rgba(255,255,255,0.1); font-weight: 900; text-transform: uppercase; italic: italic; }
</style>

<h1 class="page-title">Профиль <span>Юзера</span></h1>

<div class="profile-grid">
    <div class="profile-sidebar">
        <div class="profile-card">
            <div class="profile-avatar">{{ substr($user->name, 0, 1) }}</div>
            <h2 class="profile-name">{{ $user->name }}</h2>
            <p class="profile-email">{{ $user->email }}</p>
            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $user->comments->count() }}</div>
                    <div class="stat-label">Комменты</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $user->ratings_count ?? 0 }}</div>
                    <div class="stat-label">Оценки</div>
                </div>
            </div>
        </div>

        <div class="ban-card">
            <h3 class="ban-title"><i data-lucide="shield-alert"></i> Сектор контроля</h3>
            @if($user->is_banned)
                <div class="ban-reason-box">
                    <div class="ban-reason-label">Статус: ЗАБЛОКИРОВАН</div>
                    <div class="ban-reason-text">"{{ $user->ban_reason }}"</div>
                </div>
                <form action="{{ route('admin.users.unban', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-unban">Восстановить доступ</button>
                </form>
            @else
                <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                    @csrf
                    <textarea name="reason" placeholder="Причина терминации..." class="ban-textarea" required></textarea>
                    <button type="submit" class="btn-action btn-ban" style="margin-top: 1.5rem;">Заблокировать юзера</button>
                </form>
            @endif
        </div>
    </div>

    <div class="activity-card">
        <h3 class="activity-title"><i data-lucide="message-square"></i> Последняя активность</h3>
        <div class="activity-list">
            @forelse($user->comments as $comment)
            <div class="activity-item">
                <div class="activity-header">
                    <span class="activity-anime">{{ $comment->anime->title }}</span>
                    <span class="activity-date">{{ $comment->created_at->format('d.m.Y / H:i') }}</span>
                </div>
                <p class="activity-text">"{{ $comment->comment }}"</p>
            </div>
            @empty
            <div class="empty-state">
                <i data-lucide="ghost" style="width: 64px; height: 64px; margin: 0 auto 20px;"></i>
                <p>Активности не обнаружено</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>lucide.createIcons();</script>
@endsection