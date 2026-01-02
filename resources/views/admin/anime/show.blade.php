@extends('layouts.admin')
@section('title', $anime->title . ' - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; letter-spacing: -0.05em; font-style: italic; }
    
    .btn-group { display: flex; gap: 1rem; }
    .btn { padding: 1rem 2rem; border-radius: 12px; font-weight: 900; text-transform: uppercase; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; }
    .btn-primary { background: #2EC4B6; color: #000; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: #FFF; border: 1px solid rgba(255,255,255,0.1); }

    .main-grid { display: grid; grid-template-columns: 350px 1fr; gap: 3rem; }
    
    .info-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 2rem; position: sticky; top: 120px; }
    .poster-img { width: 100%; border-radius: 16px; margin-bottom: 2rem; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
    
    .stat-row { display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.03); }
    .stat-label { color: rgba(255,255,255,0.4); font-weight: 900; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.1em; }
    .stat-value { font-weight: 900; font-size: 0.9rem; color: #FFF; text-transform: uppercase; }
    .stat-value.accent { color: #2EC4B6; }

    .content-area { display: flex; flex-direction: column; gap: 2rem; }
    .detail-card { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 2.5rem; }
    .card-title { font-weight: 900; text-transform: uppercase; italic: italic; color: #2EC4B6; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-size: 1.2rem; }
    
    .desc-text { color: rgba(255,255,255,0.7); line-height: 1.8; font-size: 1.05rem; font-weight: 500; }
    
    .episodes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 1rem; margin-top: 2rem; }
    .episode-cell { background: #161616; border: 1px solid rgba(255,255,255,0.05); border-radius: 14px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: 0.3s; }
    .episode-cell:hover { border-color: #2EC4B6; background: rgba(46, 196, 182, 0.05); transform: translateY(-3px); }
    .ep-num { display: block; font-weight: 900; font-size: 1.25rem; margin-bottom: 0.25rem; }
    .ep-label { font-size: 0.6rem; font-weight: 900; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 0.1em; }

    .player-box { background: #000; border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); margin-bottom: 2rem; display: none; }
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
        <div class="stat-row"><span class="stat-label">Тип</span><span class="stat-value">{{ $anime->type }}</span></div>
        <div class="stat-row"><span class="stat-label">Статус</span><span class="stat-value accent">{{ $anime->status }}</span></div>
        <div class="stat-row"><span class="stat-label">Год</span><span class="stat-value">{{ $anime->year }}</span></div>
        <div class="stat-row"><span class="stat-label">Эпизоды</span><span class="stat-value">{{ $anime->number_of_episodes }}</span></div>
        <div class="stat-row"><span class="stat-label">Рейтинг</span><span class="stat-value" style="color:#FFC107">{{ $anime->rating }}</span></div>
    </aside>

    <div class="content-area">
        <div class="detail-card">
            <h2 class="card-title"><i data-lucide="info"></i> Описание</h2>
            <p class="desc-text">{{ $anime->description }}</p>
        </div>

        <div class="detail-card">
            <h2 class="card-title"><i data-lucide="play-circle"></i> Эпизоды и плеер</h2>
            
            <div id="player-wrap" class="player-box">
                <iframe id="api-player" width="100%" height="500" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="episodes-grid">
                @foreach($episodes->sortBy('episode_number') as $ep)
                <div class="episode-cell" onclick="openPlayer('{{ $ep->player_iframe }}')">
                    <span class="ep-num">#{{ $ep->episode_number }}</span>
                    <span class="ep-label">Серия</span>
                </div>
                @endforeach
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