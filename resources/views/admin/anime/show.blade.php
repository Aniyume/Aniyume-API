@extends('layouts.admin')
@section('title', $anime->title . ' - AniYume Админ')
@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        gap: 1.5rem;
        flex-wrap: wrap;
        animation: fadeInUp 0.5s ease;
    }
    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 4vw, 2.2rem); text-transform: uppercase; letter-spacing: -0.05em; font-style: italic; line-height: 1.2; flex: 1; }

    .btn-group { display: flex; gap: 0.75rem; }
    .btn { padding: 0.8rem 1.5rem; border-radius: 12px; font-weight: 900; text-transform: uppercase; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; font-size: 0.8rem; }
    .btn-primary { background: #2EC4B6; color: #000; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: #FFF; border: 1px solid rgba(255,255,255,0.1); }
    .btn:hover { transform: translateY(-2px); opacity: 0.9; }

    .main-grid { display: grid; grid-template-columns: 320px 1fr; gap: 2.5rem; align-items: start; }

    .info-card {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 24px;
        padding: 1.5rem;
        position: sticky;
        top: 120px;
        animation: fadeInUp 0.6s ease 0.1s forwards;
        opacity: 0;
    }
    .poster-img { width: 100%; border-radius: 16px; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.5); }

    .stat-row { display: flex; justify-content: space-between; padding: 0.85rem 0; border-bottom: 1px solid rgba(255,255,255,0.03); }
    .stat-label { color: rgba(255,255,255,0.4); font-weight: 900; text-transform: uppercase; font-size: 0.65rem; letter-spacing: 0.1em; }
    .stat-value { font-weight: 900; font-size: 0.85rem; color: #FFF; text-transform: uppercase; }
    .stat-value.accent { color: #2EC4B6; }

    .content-area { display: flex; flex-direction: column; gap: 2rem; animation: fadeInUp 0.6s ease 0.2s forwards; opacity: 0; }
    .detail-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 2rem; }
    .card-title { font-weight: 900; text-transform: uppercase; font-style: italic; color: #2EC4B6; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.75rem; font-size: 1.1rem; }

    .desc-text { color: rgba(255,255,255,0.7); line-height: 1.7; font-size: 1rem; font-weight: 500; }

    .episodes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)); gap: 0.75rem; margin-top: 1.5rem; }
    .episode-cell {
        background: #161616;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 1.25rem 0.75rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .episode-cell:hover { border-color: #2EC4B6; background: rgba(46, 196, 182, 0.1); transform: scale(1.05); }
    .ep-num { display: block; font-weight: 900; font-size: 1.1rem; margin-bottom: 0.2rem; color: #fff; }
    .ep-label { font-size: 0.55rem; font-weight: 900; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 0.1em; }

    .player-box {
        background: #000;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
        margin-bottom: 2rem;
        display: none;
        aspect-ratio: 16/9;
        animation: fadeInUp 0.4s ease;
    }

    @media (max-width: 1024px) {
        .main-grid { grid-template-columns: 1fr; }
        .info-card { position: static; display: grid; grid-template-columns: 200px 1fr; gap: 2rem; }
        .poster-img { margin-bottom: 0; }
    }

    @media (max-width: 640px) {
        .info-card { grid-template-columns: 1fr; }
        .poster-img { max-width: 240px; margin: 0 auto 1.5rem; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-group { width: 100%; }
        .btn { flex: 1; justify-content: center; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">{{ $anime->title }}</h1>
    <div class="btn-group">
        <a href="{{ route('admin.anime.edit', $anime->id) }}" class="btn btn-primary"><i data-lucide="edit-3"></i> Править</a>
        <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary"><i data-lucide="arrow-left"></i> Назад</a>
    </div>
</div>

<div class="main-grid">
    <aside class="info-card">
        <img src="{{ $anime->poster_url }}" class="poster-img">
        <div class="stats-wrap">
            <div class="stat-row"><span class="stat-label">Тип</span><span class="stat-value">{{ $anime->type }}</span></div>
            <div class="stat-row"><span class="stat-label">Статус</span><span class="stat-value accent">{{ $anime->status }}</span></div>
            <div class="stat-row"><span class="stat-label">Год</span><span class="stat-value">{{ $anime->year }}</span></div>
            <div class="stat-row"><span class="stat-label">Эпизоды</span><span class="stat-value">{{ $anime->number_of_episodes }}</span></div>
            <div class="stat-row"><span class="stat-label">Рейтинг</span><span class="stat-value" style="color:#FFC107">★ {{ $anime->rating }}</span></div>
        </div>
    </aside>

    <div class="content-area">
        <div class="detail-card">
            <h2 class="card-title"><i data-lucide="info"></i> Описание</h2>
            <p class="desc-text">{{ $anime->description ?: 'Описание отсутствует.' }}</p>
        </div>

        <div class="detail-card">
            <h2 class="card-title"><i data-lucide="play-circle"></i> Эпизоды и плеер</h2>

            <div id="player-wrap" class="player-box">
                <iframe id="api-player" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="episodes-grid">
                @forelse($episodes->sortBy('episode_number') as $ep)
                <div class="episode-cell" onclick="openPlayer('{{ $ep->player_iframe }}')">
                    <span class="ep-num">#{{ $ep->episode_number }}</span>
                    <span class="ep-label">Серия</span>
                </div>
                @empty
                <div style="grid-column: 1/-1; color: rgba(255,255,255,0.3); text-align: center; padding: 2rem;">Эпизоды еще не добавлены</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
    function openPlayer(url) {
        const wrap = document.getElementById('player-wrap');
        const frame = document.getElementById('api-player');
        frame.src = url;
        wrap.style.display = 'block';
        wrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
</script>
@endsection
