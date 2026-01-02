@extends('layouts.admin')
@section('title', 'Правка эпизода - AniYume Админ')
@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header { margin-bottom: 2.5rem; animation: fadeInUp 0.5s ease; }
    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 5vw, 2.5rem); text-transform: uppercase; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }

    .form-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 24px;
        padding: clamp(1.5rem, 5vw, 3rem);
        max-width: 900px;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }

    .info-strip {
        background: rgba(46, 196, 182, 0.05);
        border: 1px solid rgba(46, 196, 182, 0.1);
        border-radius: 16px;
        padding: 1.25rem;
        color: #2EC4B6;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.75rem;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
        line-height: 1.4;
    }

    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .form-group.full { grid-column: span 2; }

    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 0.8rem; display: block; }

    .form-input, .form-select {
        background: #161616;
        border: 1px solid rgba(255,255,255,0.1);
        color: #FFF;
        border-radius: 14px;
        padding: 1.1rem;
        width: 100%;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .form-input:focus { border-color: #2EC4B6; outline: none; background: #1a1a1a; transform: translateY(-2px); }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.05);
        flex-wrap: wrap;
    }

    .btn { padding: 1.1rem 2.2rem; border-radius: 14px; font-weight: 900; text-transform: uppercase; font-size: 0.8rem; cursor: pointer; border: none; text-decoration: none; transition: 0.3s; display: inline-flex; align-items: center; justify-content: center; }
    .btn-primary { background: #2EC4B6; color: #000; box-shadow: 0 10px 20px rgba(46, 196, 182, 0.2); }
    .btn-primary:hover { transform: translateY(-3px); background: #26a69a; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: #FFF; }
    .btn-secondary:hover { background: rgba(255,255,255,0.1); }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-group.full { grid-column: span 1; }
        .btn { width: 100%; }
        .form-actions { flex-direction: column-reverse; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Правка <span>Эпизода</span></h1>
</div>

<div class="form-container">
    <div class="info-strip">
        <i data-lucide="film"></i>
        <div>
            <span style="opacity: 0.6">Аниме:</span> {{ $episode->anime->title }} <br>
            <span style="opacity: 0.6">Текущий эпизод:</span> #{{ $episode->episode_number }}
        </div>
    </div>

    <form action="{{ route('admin.episodes.update', $episode->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Номер серии</label>
                <input type="number" name="episode_number" value="{{ old('episode_number', $episode->episode_number) }}" required class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Длительность (сек)</label>
                <input type="number" name="duration" value="{{ old('duration', $episode->duration) }}" class="form-input">
            </div>

            <div class="form-group full">
                <label class="form-label">Название серии</label>
                <input type="text" name="title" value="{{ old('title', $episode->title) }}" class="form-input" placeholder="Например: Начало пути">
            </div>

            <div class="form-group full">
                <label class="form-label">URL плеера</label>
                <input type="url" name="player_url" value="{{ old('player_url', $episode->player_url) }}" class="form-input" placeholder="https://...">
            </div>

            <div class="form-group full">
                <label class="form-label">Iframe код</label>
                <textarea name="player_iframe" class="form-input" style="min-height: 120px; font-family: monospace; font-size: 0.85rem;">{{ old('player_iframe', $episode->player_iframe) }}</textarea>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">Отмена</a>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>
<script>lucide.createIcons();</script>
@endsection
