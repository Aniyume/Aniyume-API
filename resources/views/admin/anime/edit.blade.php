@extends('layouts.admin')
@section('title', 'Правка: ' . $anime->title . ' - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; line-height: 1; }
    .page-title span { color: #2EC4B6; font-style: italic; }
    .subtitle { color: rgba(255,255,255,0.3); font-weight: 800; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.2em; margin-top: 10px; display: block; }

    .form-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 3rem; }
    
    .info-box { 
        background: rgba(46, 196, 182, 0.05); border: 1px solid rgba(46, 196, 182, 0.1); 
        border-radius: 14px; padding: 1.25rem; color: #2EC4B6; 
        font-size: 0.75rem; font-weight: 900; text-transform: uppercase; 
        letter-spacing: 0.1em; margin-bottom: 2.5rem; display: flex; align-items: center; gap: 10px;
    }

    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
    .form-group.full { grid-column: span 2; }
    
    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
    .form-label i { color: #2EC4B6; width: 16px; }
    
    .form-input, .form-select, .form-textarea { 
        background: #161616; border: 1px solid rgba(255,255,255,0.1); 
        color: #FFF; border-radius: 14px; padding: 1.25rem; transition: 0.3s; 
        font-size: 1rem; font-weight: 600; width: 100%; 
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus { border-color: #2EC4B6; outline: none; box-shadow: 0 0 20px rgba(46, 196, 182, 0.1); }
    .form-textarea { min-height: 200px; resize: vertical; }

    .checkbox-group { 
        display: flex; align-items: center; gap: 1rem; padding: 1.25rem; 
        background: #161616; border-radius: 14px; border: 1px solid rgba(255,255,255,0.05); 
        cursor: pointer; transition: 0.3s; 
    }
    .checkbox-group:hover { border-color: #ff4d4d; }
    .checkbox-group input { accent-color: #ff4d4d; width: 22px; height: 22px; }
    .checkbox-group label { font-weight: 900; text-transform: uppercase; font-size: 0.8rem; color: #ff4d4d; cursor: pointer; }

    .tags-container { background: #161616; border-radius: 14px; padding: 2rem; max-height: 400px; overflow-y: auto; border: 1px solid rgba(255,255,255,0.05); }
    .tags-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; }
    .tag-checkbox { 
        display: flex; align-items: center; gap: 1rem; padding: 1rem; 
        background: #111111; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); 
        cursor: pointer; transition: 0.3s; 
    }
    .tag-checkbox:hover { border-color: #2EC4B6; background: rgba(46, 196, 182, 0.05); }
    .tag-checkbox input { accent-color: #2EC4B6; width: 18px; height: 18px; }
    .tag-checkbox label { font-weight: 800; text-transform: uppercase; font-size: 0.75rem; cursor: pointer; color: rgba(255,255,255,0.6); }
    .tag-checkbox input:checked + label { color: #FFF; }

    .form-actions { display: flex; justify-content: flex-end; gap: 1.5rem; margin-top: 4rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
    
    .btn { padding: 1.25rem 2.5rem; border-radius: 14px; font-weight: 900; text-transform: uppercase; display: inline-flex; align-items: center; gap: 0.75rem; transition: 0.3s; text-decoration: none; cursor: pointer; border: none; font-size: 0.85rem; }
    .btn-primary { background: #2EC4B6; color: #000; box-shadow: 0 0 20px rgba(46, 196, 182, 0.2); }
    .btn-primary:hover { transform: scale(1.05); background: #26a69a; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.4); }
    .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #FFF; }

    .section-title { font-weight: 900; text-transform: uppercase; font-style: italic; font-size: 1.25rem; margin: 3.5rem 0 1.5rem; color: #2EC4B6; display: flex; align-items: center; gap: 0.75rem; border-left: 4px solid #2EC4B6; padding-left: 15px; }
</style>

<div class="page-header">
    <h1 class="page-title">Правка <span>Релиза</span></h1>
    <span class="subtitle">{{ $anime->title }}</span>
</div>

<div class="form-container">
    <form action="{{ route('admin.anime.update', $anime->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="info-box">
            <i data-lucide="clock"></i> 
            Последние изменения: {{ $anime->updated_at->format('d.m.Y / H:i') }}
        </div>

        <div class="form-grid">
            <div class="form-group full">
                <label class="form-label"><i data-lucide="type"></i> Название релиза</label>
                <input type="text" name="title" value="{{ old('title', $anime->title) }}" required class="form-input">
            </div>

            <div class="form-group full">
                <label class="form-label"><i data-lucide="align-left"></i> Описание сюжета</label>
                <textarea name="description" class="form-textarea">{{ old('description', $anime->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="image"></i> Ссылка на постер</label>
                <input type="url" name="poster_url" value="{{ old('poster_url', $anime->poster_url) }}" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="star"></i> Рейтинг</label>
                <input type="number" name="rating" step="0.1" value="{{ old('rating', $anime->rating) }}" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="activity"></i> Статус</label>
                <select name="status" class="form-select">
                    <option value="planned" {{ $anime->status == 'planned' ? 'selected' : '' }}>Планируется</option>
                    <option value="ongoing" {{ $anime->status == 'ongoing' ? 'selected' : '' }}>Выходит</option>
                    <option value="finished" {{ $anime->status == 'finished' ? 'selected' : '' }}>Завершено</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label"><i data-lucide="monitor"></i> Тип</label>
                <select name="type" class="form-select">
                    <option value="tv" {{ $anime->type == 'tv' ? 'selected' : '' }}>TV Сериал</option>
                    <option value="movie" {{ $anime->type == 'movie' ? 'selected' : '' }}>Фильм</option>
                    <option value="ova" {{ $anime->type == 'ova' ? 'selected' : '' }}>OVA</option>
                </select>
            </div>
        </div>

        <div class="section-title">Ограничения</div>
        <div class="form-grid">
            <div class="form-group full">
                <div class="checkbox-group">
                    <input type="checkbox" name="nsfw_flag" value="1" id="nsfw" {{ $anime->nsfw_flag ? 'checked' : '' }}>
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
                        {{ in_array($tag->id, old('tags', $anime->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary">Отменить</a>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>

<script>lucide.createIcons();</script>
@endsection