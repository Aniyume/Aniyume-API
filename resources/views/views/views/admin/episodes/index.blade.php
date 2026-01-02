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
    .form-input, .form-select, .form-textarea { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 14px; padding: 1.25rem; transition: 0.3s; font-size: 1rem; font-weight: 600; width: 100%; }
    .form-input:focus, .form-textarea:focus { border-color: #2EC4B6; outline: none; box-shadow: 0 0 20px rgba(46, 196, 182, 0.1); }
    .form-textarea { min-height: 150px; }

    .info-strip { background: rgba(46, 196, 182, 0.05); border: 1px solid rgba(46, 196, 182, 0.1); border-radius: 12px; padding: 1rem; color: #2EC4B6; font-weight: 800; text-transform: uppercase; font-size: 0.75rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; }

    .form-actions { display: flex; justify-content: flex-end; gap: 1.5rem; margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
    .btn { padding: 1.25rem 2.5rem; border-radius: 14px; font-weight: 900; text-transform: uppercase; font-size: 0.85rem; transition: 0.3s; text-decoration: none; cursor: pointer; border: none; }
    .btn-primary { background: #2EC4B6; color: #000; box-shadow: 0 0 20px rgba(46, 196, 182, 0.2); }
    .btn-primary:hover { transform: scale(1.05); }
    .btn-secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.4); }
</style>

<div class="page-header">
    <h1 class="page-title">Правка <span>Эпизода</span></h1>
</div>

<div class="form-container">
    <div class="info-strip">
        <i data-lucide="film"></i> Аниме: {{ optional($episode->anime)->title }} / Эпизод #{{ $episode->episode_number }}
    </div>

    <form action="{{ route('admin.episodes.update', $episode->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Порядковый номер</label>
                <input type="number" name="episode_number" value="{{ old('episode_number', $episode->episode_number) }}" required class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Длительность (мин)</label>
                <input type="number" name="duration" value="{{ old('duration', $episode->duration) }}" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Статус публикации</label>
                <select name="status" class="form-select">
                    <option value="published" {{ $episode->status == 'published' ? 'selected' : '' }}>Опубликовано</option>
                    <option value="draft" {{ $episode->status == 'draft' ? 'selected' : '' }}>Черновик</option>
                </select>
            </div>

            <div class="form-group full">
                <label class="form-label">Название эпизода</label>
                <input type="text" name="title" value="{{ old('title', $episode->title) }}" class="form-input">
            </div>

            <div class="form-group full">
                <label class="form-label">Прямой URL плеера / IFRAME</label>
                <input type="url" name="player_url" value="{{ old('player_url', $episode->player_url) }}" class="form-input">
            </div>

            <div class="form-group full"