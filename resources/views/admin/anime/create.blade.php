@extends('layouts.admin')
@section('title', 'Новый релиз - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 3rem; }
    .page-title { color: #FFF; font-weight: 900; font-size: 2.5rem; text-transform: uppercase; italic: italic; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }
    
    .form-container { background: #111111; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 3rem; }
    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
    .form-group.full { grid-column: span 2; }
    
    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
    .form-label i { color: #2EC4B6; width: 16px; }
    
    .form-input, .form-select, .form-textarea { background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #FFF; border-radius: 14px; padding: 1.25rem; transition: 0.3s; font-size: 1rem; font-weight: 600; width: 100%; }
    .form-input:focus, .form-textarea:focus { border-color: #2EC4B6; outline: none; box-shadow: 0 0 20px rgba(46, 196, 182, 0.1); }
    .form-textarea { min-height: 200px; }

    .tags-container { background: #161616; border-radius: 14px; padding: 2rem; max-height: 400px; overflow-y: auto; border: 1px solid rgba(255,255,255,0.05); }
    .tags-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; }
    .tag-checkbox { display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #111111; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: 0.3s; }
    .tag-checkbox:hover { border-color: #2EC4B6; }
    .tag-checkbox input { accent-color: #2EC4B6; width: 20px; height: 20px; }
    .tag-checkbox label { font-weight: 800; text-transform: uppercase; font-size: 0.8rem; cursor: pointer; }

    .form-actions { display: flex; justify-content: flex-end; gap: 1.5rem; margin-top: 4rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
    .btn { padding: 1.25rem 2.5rem; border-radius: 14px; font-weight: 900; text-transform: uppercase; display: inline-flex; align-items: center; gap: 0.75rem; transition: 0.3s; text-decoration: none; cursor: pointer; border: none; }
    .btn-primary { background: #2EC4B6; color: #000; box-shadow: 0 0 20px rgba(46, 196, 182, 0.2); }
    .btn-primary:hover { transform: scale(1.05); }
    .btn-secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.5); }

    .section-title { font-weight: 900; text-transform: uppercase; italic: italic; font-size: 1.25rem; margin: 3rem 0 1.5rem; color: #2EC4B6; display: flex; align-items: center; gap: 0.75rem; }
</style>

<div class="page-header">
    <h1 class="page-title">Новый <span>Релиз</span></h1>
</div>

<div class="form-container">
    <form action="{{ route('admin.anime.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group full">
                <label class="form-label"><i data-lucide="type"></i> Оригинальное название</label>
                <input type="text" name="title" required placeholder="..." class="form-input">
            </div>
            <div class="form-group full">
                <label class="form-label"><i data-lucide="align-left"></i> Описание сюжета</label>
                <textarea name="description" class="form-textarea"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="image"></i> Ссылка на постер</label>
                <input type="url" name="poster_url" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="star"></i> Рейтинг (0.0 - 10.0)</label>
                <input type="number" name="rating" step="0.1" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="activity"></i> Текущий статус</label>
                <select name="status" class="form-select">
                    <option value="planned">Планируется</option>
                    <option value="ongoing">Выходит</option>
                    <option value="finished">Завершено</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="monitor"></i> Тип медиа</label>
                <select name="type" class="form-select">
                    <option value="tv">TV Сериал</option>
                    <option value="movie">Фильм</option>
                    <option value="ova">OVA</option>
                </select>
            </div>
        </div>

        <div class="section-title"><i data-lucide="tags"></i> Жанры и теги</div>
        <div class="tags-container">
            <div class="tags-grid">
                @foreach($tags as $tag)
                <div class="tag-checkbox">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
                    <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary">Отмена</a>
            <button type="submit" class="btn btn-primary">Опубликовать</button>
        </div>
    </form>
</div>
<script>lucide.createIcons();</script>
@endsection