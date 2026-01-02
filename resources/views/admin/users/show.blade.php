@extends('layouts.admin')
@section('title', 'Профиль: ' . $user->name . ' - AniYume Админ')
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
        margin-bottom: 2rem;
        animation: fadeInUp 0.5s ease;
    }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .profile-grid {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 2.5rem;
        align-items: start;
    }

    .profile-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 24px;
        padding: 2.5rem;
        text-align: center;
        position: sticky;
        top: 120px;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }
    .profile-avatar {
        width: 90px; height: 90px; background: #161616; border-radius: 24px;
        margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;
        color: #2EC4B6; font-size: 2.2rem; font-weight: 900;
        border: 2px solid rgba(46, 196, 182, 0.2); box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .profile-name { color: #FFF; font-size: 1.5rem; font-weight: 900; text-transform: uppercase; letter-spacing: -0.05em; margin-bottom: 0.5rem; font-style: italic; }
    .profile-email { color: rgba(255,255,255,0.3); font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; }

    .profile-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
    .stat-value { color: #2EC4B6; font-size: 1.25rem; font-weight: 900; font-style: italic; }
    .stat-label { color: rgba(255,255,255,0.3); font-size: 0.6rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 4px; }

    .ban-card {
        background: #111111;
        border: 1px solid rgba(255, 77, 77, 0.1);
        border-radius: 24px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        animation: fadeInUp 0.5s ease 0.2s forwards;
        opacity: 0;
    }
    .ban-title { color: #FF4D4D; font-size: 0.85rem; font-weight: 900; text-transform: uppercase; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 10px; }

    .ban-reason-box { background: rgba(255, 77, 77, 0.05); border: 1px solid rgba(255, 77, 77, 0.1); border-radius: 14px; padding: 1.25rem; margin-bottom: 1.25rem; }
    .ban-reason-label { color: rgba(255, 77, 77, 0.5); font-size: 0.6rem; font-weight: 900; text-transform: uppercase; margin-bottom: 5px; }
    .ban-reason-text { color: #FF4D4D; font-size: 0.85rem; font-weight: 800; font-style: italic; }

    .ban-textarea { background: #161616; border: 1px solid rgba(255,255,255,0.05); color: #FFF; border-radius: 14px; padding: 1rem; font-size: 0.9rem; font-weight: 600; width: 100%; min-height: 100px; transition: 0.3s; resize: none; }
    .ban-textarea:focus { outline: none; border-color: #FF4D4D; }

    .btn-action { padding: 1rem; border-radius: 12px; border: none; font-weight: 900; cursor: pointer; transition: 0.3s; width: 100%; text-transform: uppercase; font-size: 0.75rem; }
    .btn-ban { background: #FF4D4D; color: #FFF; box-shadow: 0 5px 15px rgba(255, 77, 77, 0.2); }
    .btn-ban:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255, 77, 77, 0.4); }
    .btn-unban { background: #2EC4B6; color: #000; }

    .activity-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 24px;
        padding: clamp(1.5rem, 5vw, 3rem);
        animation: fadeInUp 0.5s ease 0.3s forwards;
        opacity: 0;
    }
    .activity-title { color: #FFF; font-size: 1.25rem; font-weight: 900; text-transform: uppercase; font-style: italic; margin-bottom: 2rem; display: flex; align-items: center; gap: 12px; }
    .activity-title i { color: #2EC4B6; }

    .activity-item {
        background: #161616;
        border: 1px solid rgba(255,255,255,0.02);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    .activity-item:hover { border-color: rgba(46, 196, 182, 0.3); transform: translateX(8px); }
    .activity-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; flex-wrap: wrap; gap: 0.5rem; }
    .activity-anime { color: #2EC4B6; font-size: 0.75rem; font-weight: 900; text-transform: uppercase; font-style: italic; }
    .activity-date { color: rgba(255,255,255,0.2); font-size: 0.65rem; font-weight: 800; }
    .activity-text { color: rgba(255,255,255,0.8); font-size: 0.95rem; font-weight: 500; line-height: 1.5; }

    @media (max-width: 1024px) {
        .profile-grid { grid-template-columns: 1fr; }
        .profile-card { position: static; }
    }
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
            <h3 class="ban-title"><i data-lucide="shield-alert"></i> Модерация доступа</h3>
            @if($user->is_banned)
                <div class="ban-reason-box">
                    <div class="ban-reason-label">Статус: ЗАБЛОКИРОВАН</div>
                    <div class="ban-reason-text">"{{ $user->ban_reason }}"</div>
                </div>
                <form action="{{ route('admin.users.unban', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-unban">Разблокировать</button>
                </form>
            @else
                <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                    @csrf
                    <textarea name="reason" placeholder="Укажите причину бана..." class="ban-textarea" required></textarea>
                    <button type="submit" class="btn-action btn-ban" style="margin-top: 1rem;">Забанить юзера</button>
                </form>
            @endif
        </div>
    </div>

    <div class="activity-card">
        <h3 class="activity-title"><i data-lucide="message-square"></i> Последние комментарии</h3>
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
            <div style="text-align: center; padding: 4rem 0; color: rgba(255,255,255,0.1); font-weight: 900; text-transform: uppercase;">
                <i data-lucide="ghost" style="width: 48px; height: 48px; margin: 0 auto 1rem; opacity: 0.5;"></i>
                <p>Активности нет</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>lucide.createIcons();</script>
@endsection
