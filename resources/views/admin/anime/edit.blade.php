@extends('layouts.admin')
@section('title', (isset($anime) ? 'Правка: ' . $anime->title : 'Новый релиз') . ' - AniYume Админ')
@section('content')
<style>
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .page-header { margin-bottom: 2.5rem; animation: slideInRight 0.5s ease; }
    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 5vw, 2.5rem); text-transform: uppercase; letter-spacing: -0.05em; line-height: 1.1; }
    .page-title span { color: #2EC4B6; font-style: italic; }
    .subtitle { color: rgba(255,255,255,0.3); font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.2em; margin-top: 8px; display: block; }

    .form-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 24px;
        padding: clamp(1.5rem, 5vw, 3rem);
        animation: fadeInUp 0.6s ease 0.1s forwards;
        opacity: 0;
    }

    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .form-group.full { grid-column: span 2; }

    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
    .form-label i { color: #2EC4B6; width: 14px; }

    .form-input, .form-select, .form-textarea {
        background: #161616;
        border: 1px solid rgba(255,255,255,0.1);
        color: #FFF;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1rem;
        font-weight: 600;
        width: 100%;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus { border-color: #2EC4B6; outline: none; background: #1a1a1a; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
    .form-textarea { min-height: 180px; resize: vertical; }

    .checkbox-group {
        display: flex; align-items: center; gap: 1rem; padding: 1.25rem;
        background: rgba(255, 77, 77, 0.05); border-radius: 14px; border: 1px solid rgba(255, 77, 77, 0.1);
        cursor: pointer; transition: 0.3s;
    }
    .checkbox-group:hover { border-color: #ff4d4d; background: rgba(255, 77, 77, 0.1); }
    .checkbox-group input { accent-color: #ff4d4d; width: 20px; height: 20px; }
    .checkbox-group label { font-weight: 900; text-transform: uppercase; font-size: 0.75rem; color: #ff4d4d; cursor: pointer; }

    .tags-container {
        background: #161616;
        border-radius: 14px;
        padding: 1.5rem;
        max-height: 350px;
        overflow-y: auto;
        border: 1px solid rgba(255,255,255,0.05);
    }
    .tags-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 0.75rem; }
    .tag-checkbox {
        display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem;
        background: #111111; border-radius: 10px; border: 1px solid rgba(255,255,255,0.05);
        cursor: pointer; transition: 0.3s;
    }
    .tag-checkbox:hover { border-color: #2EC4B6; background: rgba(46, 196, 182, 0.05); }
    .tag-checkbox input { accent-color: #2EC4B6; width: 16px; height: 16px; }
    .tag-checkbox label { font-weight: 800; text-transform: uppercase; font-size: 0.7rem; cursor: pointer; color: rgba(255,255,255,0.5); }
    .tag-checkbox input:checked + label { color: #FFF; }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.05);
        flex-wrap: wrap;
    }

    .btn { padding: 1rem 2rem; border-radius: 12px; font-weight: 900; text-transform: uppercase; display: inline-flex; align-items: center; gap: 0.75rem; transition: 0.3s; text-decoration: none; cursor: pointer; border: none; font-size: 0.8rem; }
    .btn-primary { background: #2EC4B6; color: #000; box-shadow: 0 10px 20px rgba(46, 196, 182, 0.2); }
    .btn-primary:hover { transform: translateY(-3px); background: #26a69a; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.4); }
    .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #FFF; }

    .section-title { font-weight: 900; text-transform: uppercase; font-style: italic; font-size: 1.1rem; margin: 2.5rem 0 1.25rem; color: #2EC4B6; display: flex; align-items: center; gap: 0.75rem; }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-group.full { grid-column: span 1; }
        .btn { width: 100%; justify-content: center; }
        .form-actions { flex-direction: column-reverse; }
    }
      .error-msg { color: #ff4d4d; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; margin-top: 5px; display: block; }
</style>

<div class="page-header">
    <h1 class="page-title">{{ isset($anime) ? 'Правка' : 'Новый' }} <span>Релиз</span></h1>
    @if(isset($anime)) <span class="subtitle">{{ $anime->title }}</span> @endif
</div>
@if ($errors->any())
    <div style="background: rgba(255,77,77,0.1); border: 1px solid #ff4d4d; padding: 1rem; border-radius: 14px; margin-bottom: 2rem; color: #ff4d4d; font-weight: bold;">
        Исправьте ошибки в форме перед сохранением.
    </div>
@endif

<div class="form-container">
    <form action="{{ isset($anime) ? route('admin.anime.update', $anime->id) : route('admin.anime.store') }}" method="POST">
        @csrf
        @if(isset($anime)) @method('PUT') @endif

        <div class="form-grid">
            <div class="form-group full">
                <label class="form-label"><i data-lucide="type"></i> Название релиза</label>
                <input type="text" name="title" value="{{ old('title', $anime->title ?? '') }}" required class="form-input" placeholder="Введите название...">
                @error('title') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full">
                <label class="form-label"><i data-lucide="align-left"></i> Описание сюжета</label>
                <textarea name="description" class="form-textarea" placeholder="О чем это аниме...">{{ old('description', $anime->description ?? '') }}</textarea>
                @error('description') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="image"></i> Ссылка на постер</label>
                <input type="url" name="poster_url" value="{{ old('poster_url', $anime->poster_url ?? '') }}" class="form-input" placeholder="https://...">
                @error('poster_url') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="star"></i> Рейтинг</label>
                <input type="number" name="rating" step="0.1" value="{{ old('rating', $anime->rating ?? '') }}" class="form-input" placeholder="8.5">
                @error('rating') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="activity"></i> Статус</label>
                <select name="status" class="form-select">
                    <option value="planned" {{ old('status', $anime->status ?? '') == 'planned' ? 'selected' : '' }}>Планируется</option>
                    <option value="ongoing" {{ old('status', $anime->status ?? '') == 'ongoing' ? 'selected' : '' }}>Выходит</option>
                    <option value="finished" {{ old('status', $anime->status ?? '') == 'finished' ? 'selected' : '' }}>Завершено</option>
                    <option value="paused" {{ old('status', $anime->status ?? '') == 'paused' ? 'selected' : '' }}>На паузе</option>
                </select>
                @error('status') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="monitor"></i> Тип</label>
                <select name="type" class="form-select">
                    <option value="tv" {{ old('type', $anime->type ?? '') == 'tv' ? 'selected' : '' }}>TV Сериал</option>
                    <option value="movie" {{ old('type', $anime->type ?? '') == 'movie' ? 'selected' : '' }}>Фильм</option>
                    <option value="ova" {{ old('type', $anime->type ?? '') == 'ova' ? 'selected' : '' }}>OVA</option>
                    <option value="ona" {{ old('type', $anime->type ?? '') == 'ona' ? 'selected' : '' }}>ONA</option>
                    <option value="special" {{ old('type', $anime->type ?? '') == 'special' ? 'selected' : '' }}>Спешл</option>
                    <option value="music" {{ old('type', $anime->type ?? '') == 'music' ? 'selected' : '' }}>Клип</option>
                </select>
                @error('type') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="section-title">Ограничения</div>
        <div class="form-grid">
            <div class="form-group full">
                <div class="checkbox-group">
                    <input type="checkbox" name="nsfw_flag" value="1" id="nsfw" {{ old('nsfw_flag', $anime->nsfw_flag ?? false) ? 'checked' : '' }}>
                    <label for="nsfw">NSFW / Контент для взрослых (18+)</label>
                </div>
            </div>
        </div>

        <div class="section-title">Жанры</div>
        <div class="tags-container">
            <div class="tags-grid">
                @foreach($tags as $tag)
                <div class="tag-checkbox">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', isset($anime) ? $anime->tags->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                    <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary">Отменить</a>
            <button type="submit" class="btn btn-primary">{{ isset($anime) ? 'Сохранить изменения' : 'Опубликовать' }}</button>
        </div>
    </form>
</div>
<script>lucide.createIcons();</script>
@endsection
