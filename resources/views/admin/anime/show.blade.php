@extends('layouts.admin')

@section('title', $anime->title . ' - АниЮм Админ')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        gap: 20px;
        flex-wrap: wrap;
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

    .btn-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
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

    .btn-success {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.2), rgba(0, 200, 255, 0.15));
        color: #00ffc8;
        border: 1.5px solid rgba(0, 255, 200, 0.3);
    }

    .btn-success:hover {
        box-shadow: 0 8px 20px rgba(0, 255, 200, 0.2);
        border-color: rgba(0, 255, 200, 0.5);
    }

    .btn:active {
        transform: translateY(0);
    }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 24px;
        margin-bottom: 32px;
    }

    .card {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(10px);
    }

    .card-title {
        color: #00ffc8;
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .poster-image {
        width: 100%;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 12px 32px rgba(0, 255, 200, 0.2);
        border: 1px solid rgba(0, 255, 200, 0.2);
        object-fit: cover;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px;
        background: rgba(0, 255, 200, 0.08);
        border-radius: 10px;
        border: 1px solid rgba(0, 255, 200, 0.15);
    }

    .info-label {
        color: #b0e0ff;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-value {
        color: #00ffc8;
        font-weight: 700;
        font-size: 14px;
    }

    .description {
        color: #d0e8ff;
        line-height: 1.8;
        font-size: 14px;
    }

    .description h2,
    .description h3 {
        color: #00ffc8;
        margin-top: 16px;
        margin-bottom: 8px;
    }

    .description p {
        margin-bottom: 12px;
    }

    .description ul,
    .description ol {
        margin-left: 20px;
        margin-bottom: 12px;
    }

    .description li {
        margin-bottom: 6px;
    }

    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tag {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.2), rgba(0, 200, 255, 0.15));
        color: #00ffc8;
        border: 1px solid rgba(0, 255, 200, 0.3);
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .episodes-section {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(10px);
        margin-bottom: 32px;
    }

    .episodes-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .episodes-title {
        color: #00ffc8;
        font-weight: 700;
        font-size: 20px;
        margin: 0;
    }

    .episodes-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .translation-selector {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        color: #e0e0e0;
        border-radius: 10px;
        padding: 12px 14px;
        transition: all 0.3s ease;
        font-family: 'Onest', sans-serif;
        font-size: 14px;
        font-weight: 600;
        max-width: 400px;
        width: 100%;
    }

    .translation-selector:focus {
        outline: none;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
        border-color: #00ffc8;
        box-shadow: 0 0 20px rgba(0, 255, 200, 0.3);
    }

    .translation-selector option {
        background: #0a0a1a;
        color: #e0e0e0;
    }

    .player-container {
        background: #000;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 16px;
        box-shadow: 0 16px 40px rgba(0, 255, 200, 0.15);
        border: 1px solid rgba(0, 255, 200, 0.2);
    }

    .aspect-video {
        aspect-ratio: 16 / 9;
        width: 100%;
    }

    .player-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .player-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border-top: 1px solid rgba(0, 255, 200, 0.2);
        font-size: 13px;
    }

    .player-info-text {
        color: #b0e0ff;
        font-weight: 600;
    }

    .close-player-btn {
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.2), rgba(255, 80, 80, 0.15));
        color: #ff9fa0;
        border: 1px solid rgba(255, 100, 100, 0.3);
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .close-player-btn:hover {
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.3), rgba(255, 80, 80, 0.2));
        border-color: rgba(255, 100, 100, 0.5);
    }

    .episodes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 12px;
    }

    .episode-btn {
        padding: 12px 8px;
        border-radius: 10px;
        border: 1.5px solid rgba(0, 255, 200, 0.25);
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.1), rgba(0, 200, 255, 0.08));
        color: #b0e0ff;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 4px;
    }

    .episode-number {
        font-size: 18px;
        color: #00ffc8;
    }

    .episode-quality {
        font-size: 10px;
        color: rgba(176, 224, 255, 0.6);
        text-transform: uppercase;
    }

    .episode-play {
        font-size: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
        color: #00ffc8;
    }

    .episode-btn:hover {
        border-color: rgba(0, 255, 200, 0.45);
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.2), rgba(0, 200, 255, 0.15));
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 255, 200, 0.15);
    }

    .episode-btn:hover .episode-play {
        opacity: 1;
    }

    .no-episodes {
        text-align: center;
        padding: 60px 20px;
        color: #b0e0ff;
    }

    .no-episodes-emoji {
        font-size: 48px;
        margin-bottom: 16px;
        display: block;
    }

    .no-episodes-text {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .empty-poster {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.1), rgba(0, 200, 255, 0.08));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 64px;
        margin-bottom: 20px;
        border: 1px solid rgba(0, 255, 200, 0.2);
    }

    .nsfw-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.2), rgba(255, 80, 80, 0.15));
        color: #ff9fa0;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        border: 1px solid rgba(255, 100, 100, 0.3);
    }

    @media (max-width: 1024px) {
        .main-grid {
            grid-template-columns: 1fr;
        }

        .episodes-grid {
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-group {
            width: 100%;
        }

        .btn {
            flex: 1;
            justify-content: center;
        }

        .episodes-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .episodes-actions {
            width: 100%;
        }

        .btn-success, .btn-secondary {
            flex: 1;
        }

        .episodes-grid {
            grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
        }

        .card, .episodes-section {
            padding: 18px;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">🎬 {{ $anime->title }}</h1>
    <div class="btn-group">
        <a href="{{ route('admin.anime.edit', $anime->id) }}" class="btn btn-primary">
            ✏️ Редактировать
        </a>
        <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary">
            ← Вернуться
        </a>
    </div>
</div>

<div class="main-grid">
    <div>
        <div class="card">
            @if($anime->poster_url)
                <img src="{{ $anime->poster_url }}" alt="{{ $anime->title }}" class="poster-image">
            @else
                <div class="empty-poster">🎬</div>
            @endif

            <div class="info-list">
                <div class="info-item">
                    <span class="info-label">Тип</span>
                    <span class="info-value">{{ strtoupper($anime->type) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Статус</span>
                    <span class="info-value">
                        @switch($anime->status)
                            @case('planned')
                                📅 Планируется
                                @break
                            @case('ongoing')
                                🎯 Выходит
                                @break
                            @case('finished')
                                ✅ Завершено
                                @break
                            @case('paused')
                                ⏸️ На паузе
                                @break
                            @default
                                {{ ucfirst($anime->status) }}
                        @endswitch
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Год</span>
                    <span class="info-value">{{ $anime->year ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Рейтинг</span>
                    <span class="info-value">{{ $anime->rating ? number_format($anime->rating, 1) : '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Эпизодов</span>
                    <span class="info-value">{{ $anime->number_of_episodes ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">NSFW</span>
                    <span class="info-value">
                        @if($anime->nsfw_flag)
                            <span class="nsfw-badge">🔞 Да</span>
                        @else
                            <span style="color: #00ffc8;">✓ Нет</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Популярность</span>
                    <span class="info-value">{{ $anime->popularity ? number_format($anime->popularity) : '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Избранное</span>
                    <span class="info-value">{{ $anime->favorites ? number_format($anime->favorites) : '—' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="card">
            <h2 class="card-title">📖 Описание</h2>
            <div class="description">
                {!! $anime->description ?? '<span style="color: rgba(176, 224, 255, 0.6);">Описание недоступно</span>' !!}
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">ℹ️ Дополнительная информация</h2>
            <div class="info-list">
                <div class="info-item">
                    <span class="info-label">Выход с</span>
                    <span class="info-value">{{ $anime->aired_from ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Выход до</span>
                    <span class="info-value">{{ $anime->aired_to ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">ID источника</span>
                    <span class="info-value" style="font-family: monospace; font-size: 12px;">{{ $anime->external_id ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Источник</span>
                    <span class="info-value">{{ $anime->external_source ?? '—' }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">🏷️ Теги ({{ $anime->tags->count() }})</h2>
            @if($anime->tags->count() > 0)
                <div class="tags-container">
                    @foreach($anime->tags as $tag)
                        <span class="tag">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @else
                <p style="color: rgba(176, 224, 255, 0.6); font-size: 14px;">Теги не назначены</p>
            @endif
        </div>
    </div>
</div>

@if($episodes->count() > 0)
    <div class="episodes-section">
        <div class="episodes-header">
            <h2 class="episodes-title">📺 Эпизоды ({{ $episodes->count() }} в наличии)</h2>
            <div class="episodes-actions">
                <form action="{{ route('admin.episodes.import-for-anime', $anime->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-success"
                            onclick="return confirm('Переимпортировать и обновить все эпизоды и переводы этого аниме?')">
                        🔄 Переимпортировать
                    </button>
                </form>
                <a href="{{ route('admin.episodes.index', ['anime_id' => $anime->id]) }}" class="btn btn-secondary">
                    📝 Управлять
                </a>
            </div>
        </div>

        @php
            $groupedByTranslator = $episodes->groupBy('translator')->sortBy(function($group) {
                return $group->first()->priority;
            });
        @endphp

        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #b0e0ff; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Выберите перевод:</label>
            <select id="translation-selector" class="translation-selector">
                @foreach($groupedByTranslator as $translator => $translatorEpisodes)
                    @php
                        $firstEp = $translatorEpisodes->first();
                        $translationType = $firstEp->translation_type === 'subtitles' ? '📝 SUB' : '🎤 DUB';
                        $episodeCount = $translatorEpisodes->count();
                    @endphp
                    <option value="{{ $translator }}" data-priority="{{ $firstEp->priority }}">
                        {{ $translationType }} - {{ $translator }} ({{ $episodeCount }} эп) - {{ $firstEp->quality }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="player-container" style="display: none; margin-bottom: 24px;">
            <div class="player-container">
                <div class="aspect-video">
                    <iframe id="player-iframe" class="player-iframe" frameborder="0" allowfullscreen allow="autoplay *; fullscreen *"></iframe>
                </div>
            </div>
            <div class="player-info">
                <div class="player-info-text">
                    Эпизод <span id="episode-number">—</span> •
                    <span id="episode-translator">—</span> •
                    <span id="episode-quality">—</span>
                </div>
                <button onclick="closePlayer()" class="close-player-btn">✕ Закрыть плеер</button>
            </div>
        </div>

        <div id="episodes-container">
            @foreach($groupedByTranslator as $translator => $translatorEpisodes)
                <div class="translator-group" data-translator="{{ $translator }}" style="display: none;">
                    <div class="episodes-grid">
                        @foreach($translatorEpisodes->sortBy('episode_number') as $episode)
                            <button class="episode-btn"
                                    data-episode-number="{{ $episode->episode_number }}"
                                    data-episode-quality="{{ $episode->quality }}"
                                    data-episode-translator="{{ $episode->translator }}"
                                    data-player-url="{{ $episode->player_iframe }}">
                                <span class="episode-number">#{{ $episode->episode_number }}</span>
                                <span class="episode-quality">{{ $episode->quality }}</span>
                                <span class="episode-play">▶️ Смотреть</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="episodes-section">
        <div class="no-episodes">
            <span class="no-episodes-emoji">📺</span>
            <div class="no-episodes-text">Эпизоды не добавлены</div>
            <form action="{{ route('admin.episodes.import-for-anime', $anime->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn btn-success">
                    📥 Импортировать эпизоды
                </button>
            </form>
        </div>
    </div>
@endif

<script>
    const translationSelector = document.getElementById('translation-selector');
    const episodesContainer = document.getElementById('episodes-container');

    if (translationSelector) {
        translationSelector.addEventListener('change', function() {
            const selectedTranslator = this.value;

            document.querySelectorAll('.translator-group').forEach(group => {
                group.style.display = 'none';
            });

            const selectedGroup = document.querySelector(`.translator-group[data-translator="${selectedTranslator}"]`);
            if (selectedGroup) {
                selectedGroup.style.display = 'block';
            }
        });

        translationSelector.dispatchEvent(new Event('change'));
    }

    document.querySelectorAll('.episode-btn').forEach(button => {
        button.addEventListener('click', function() {
            const playerUrl = this.getAttribute('data-player-url');
            const episodeNumber = this.getAttribute('data-episode-number');
            const translator = this.getAttribute('data-episode-translator');
            const quality = this.getAttribute('data-episode-quality');

            playEpisode(playerUrl, episodeNumber, translator, quality);
        });
    });

    function playEpisode(playerUrl, episodeNumber, translator, quality) {
        const container = document.getElementById('player-container');
        const iframe = document.getElementById('player-iframe');
        const infoNumber = document.getElementById('episode-number');
        const infoTranslator = document.getElementById('episode-translator');
        const infoQuality = document.getElementById('episode-quality');

        iframe.src = playerUrl;
        infoNumber.textContent = episodeNumber;
        infoTranslator.textContent = translator;
        infoQuality.textContent = quality;
        container.style.display = 'block';

        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function closePlayer() {
        const container = document.getElementById('player-container');
        const iframe = document.getElementById('player-iframe');

        iframe.src = '';
        container.style.display = 'none';
    }
</script>

@endsection
