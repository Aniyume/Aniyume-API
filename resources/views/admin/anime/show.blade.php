@extends('layouts.admin')
@section('title', $anime->title . ' - AniYume Админ')
@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; gap: 1.5rem; flex-wrap: wrap; }
    .page-title { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .btn-group { display: flex; gap: 0.75rem; }
    .btn { padding: 0.75rem 1.25rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; text-decoration: none; }
    .btn-primary { background: #00f2ea; color: #ffffff; }
    .btn-secondary { background: #f4f4f4; color: #6f767e; }
    .main-grid { display: grid; grid-template-columns: 320px 1fr; gap: 2rem; margin-bottom: 3rem; }
    .card { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 1.5rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .card-title { color: #1a1d1f; font-weight: 800; font-size: 1.125rem; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.625rem; }
    .card-title i { color: #00f2ea; }
    .poster-image { width: 100%; border-radius: 1rem; margin-bottom: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    .info-list { display: flex; flex-direction: column; gap: 0.75rem; }
    .info-item { display: flex; justify-content: space-between; align-items: center; padding: 0.875rem 1rem; background: #fcfdfe; border-radius: 0.75rem; border: 1px solid #f0f2f5; }
    .info-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; }
    .info-value { color: #1a1d1f; font-weight: 700; font-size: 0.875rem; }
    .description { color: #1a1d1f; line-height: 1.7; font-size: 0.95rem; font-weight: 500; }
    .tags-container { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .tag { padding: 0.5rem 1rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700; background: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1; }
    .episodes-section { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.5rem; padding: 2rem; margin-bottom: 3rem; }
    .episodes-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
    .episodes-title { color: #1a1d1f; font-weight: 800; font-size: 1.25rem; margin: 0; }
    .translation-selector { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; font-weight: 700; width: 100%; max-width: 350px; margin-bottom: 1.5rem; }
    .player-container { background: #000; border-radius: 1rem; overflow: hidden; margin-bottom: 1.5rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
    .episodes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 0.75rem; }
    .episode-btn { padding: 1rem 0.5rem; border-radius: 0.75rem; border: 2px solid #f0f2f5; background: #ffffff; color: #1a1d1f; font-weight: 800; cursor: pointer; transition: all 0.2s ease; text-align: center; }
    .episode-btn:hover { border-color: #00f2ea; color: #00f2ea; transform: translateY(-2px); }
    .episode-number { font-size: 1.125rem; display: block; margin-bottom: 0.25rem; }
    .episode-quality { font-size: 0.65rem; color: #6f767e; text-transform: uppercase; }
</style>

<div class="page-header">
    <h1 class="page-title">{{ $anime->title }}</h1>
    <div class="btn-group">
        <a href="{{ route('admin.anime.edit', $anime->id) }}" class="btn btn-primary"><i data-lucide="edit-3"></i> Редактировать</a>
        <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary"><i data-lucide="arrow-left"></i> Назад</a>
    </div>
</div>

<div class="main-grid">
    <div class="card">
        <img src="{{ $anime->poster_url ?? 'https://via.placeholder.com/300x450' }}" class="poster-image">
        <div class="info-list">
            <div class="info-item"><span class="info-label">Тип</span><span class="info-value">{{ strtoupper($anime->type) }}</span></div>
            <div class="info-item"><span class="info-label">Статус</span><span class="info-value">{{ ucfirst($anime->status) }}</span></div>
            <div class="info-item"><span class="info-label">Год</span><span class="info-value">{{ $anime->year ?? '—' }}</span></div>
            <div class="info-item"><span class="info-label">Рейтинг</span><span class="info-value" style="color:#00f2ea">{{ number_format($anime->rating, 1) }}</span></div>
            <div class="info-item"><span class="info-label">Эпизодов</span><span class="info-value">{{ $anime->number_of_episodes ?? '—' }}</span></div>
        </div>
    </div>
    <div class="space-y-6">
        <div class="card">
            <h2 class="card-title"><i data-lucide="book-open"></i> Описание</h2>
            <div class="description">{!! $anime->description ?? 'Описание отсутствует' !!}</div>
        </div>
        <div class="card">
            <h2 class="card-title"><i data-lucide="tag"></i> Теги</h2>
            <div class="tags-container">
                @forelse($anime->tags as $tag) <span class="tag">{{ $tag->name }}</span> @empty <p>Теги не указаны</p> @endforelse
            </div>
        </div>
    </div>
</div>

@if($episodes->count() > 0)
<div class="episodes-section">
    <div class="episodes-header">
        <h2 class="episodes-title"><i data-lucide="play-circle"></i> Эпизоды ({{ $episodes->count() }})</h2>
        <form action="{{ route('admin.episodes.import-for-anime', $anime->id) }}" method="POST">
            @csrf <button type="submit" class="btn btn-secondary"><i data-lucide="refresh-cw"></i> Обновить</button>
        </form>
    </div>
    <select id="translation-selector" class="translation-selector">
        @foreach($episodes->groupBy('translator') as $translator => $items)
            <option value="{{ $translator }}">{{ $translator }} ({{ $items->count() }} эп.)</option>
        @endforeach
    </select>
    <div id="player-container" style="display: none;" class="player-container">
        <div class="aspect-video"><iframe id="player-iframe" width="100%" height="500" frameborder="0" allowfullscreen></iframe></div>
    </div>
    <div class="episodes-grid">
        @foreach($episodes->sortBy('episode_number') as $episode)
            <button class="episode-btn" data-url="{{ $episode->player_iframe }}" onclick="playEpisode('{{ $episode->player_iframe }}')">
                <span class="episode-number">#{{ $episode->episode_number }}</span>
                <span class="episode-quality">{{ $episode->quality }}</span>
            </button>
        @endforeach
    </div>
</div>
@endif

<script>
    lucide.createIcons();
    function playEpisode(url) {
        const container = document.getElementById('player-container');
        const iframe = document.getElementById('player-iframe');
        iframe.src = url;
        container.style.display = 'block';
        container.scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection
