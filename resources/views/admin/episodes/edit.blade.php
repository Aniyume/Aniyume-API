@extends('layouts.admin')
@section('title', 'Правка эпизода - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; }
    .form-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 3rem; max-width: 900px; }
    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
    .form-group.full { grid-column: span 2; }
    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 1rem; display: block; }
    .form-input, .form-select { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 14px; padding: 1.25rem; width: 100%; }
    .info-strip { background: rgba(46, 196, 182, 0.05); border: 1px solid rgba(46, 196, 182, 0.1); border-radius: 12px; padding: 1rem; color: #2EC4B6; font-weight: 800; text-transform: uppercase; font-size: 0.75rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; }
    .form-actions { display: flex; justify-content: flex-end; gap: 1.5rem; margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
    .btn { padding: 1.25rem 2.5rem; border-radius: 14px; font-weight: 900; text-transform: uppercase; font-size: 0.85rem; cursor: pointer; border: none; text-decoration: none; }
    .btn-primary { background: #2EC4B6; color: #000; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: #FFF; }
</style>

<div class="page-header">
    <h1 class="page-title">Правка <span>Эпизода</span></h1>
</div>

<div class="form-container">
    <div class="info-strip">
        <i data-lucide="film"></i> Аниме: {{ $episode->anime->title }} / Эпизод #{{ $episode->episode_number }}
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
                <input type="text" name="title" value="{{ old('title', $episode->title) }}" class="form-input">
            </div>

            <div class="form-group full">
                <label class="form-label">URL плеера</label>
                <input type="url" name="player_url" value="{{ old('player_url', $episode->player_url) }}" class="form-input">
            </div>

            <div class="form-group full">
                <label class="form-label">Iframe код (если есть)</label>
                <textarea name="player_iframe" class="form-input" style="min-height: 100px;">{{ old('player_iframe', $episode->player_iframe) }}</textarea>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">Отмена</a>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>
<script>lucide.createIcons();</script>
@endsection
