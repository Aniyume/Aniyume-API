@extends('layouts.admin')
@section('title', 'Создание аниме - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 2rem; }
    .page-title { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; display: flex; align-items: center; gap: 0.75rem; }
    .page-title i { color: #00f2ea; }
    .form-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); }
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .form-group { display: flex; flex-direction: column; }
    .form-group.full { grid-column: 1 / -1; }
    .form-label { color: #6f767e; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
    .form-label i { width: 16px; height: 16px; color: #00f2ea; }
    .required { color: #ff6b6b; margin-left: 2px; }
    .form-input, .form-select, .form-textarea { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.875rem 1rem; transition: all 0.2s ease; font-size: 0.95rem; font-weight: 500; }
    .form-textarea { resize: vertical; min-height: 150px; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #00f2ea; background: #ffffff; box-shadow: 0 0 0 4px rgba(0, 242, 234, 0.1); }
    .checkbox-group { display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #f4f4f4; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease; }
    .checkbox-group:hover { background: #efefef; }
    .checkbox-group input[type="checkbox"] { width: 20px; height: 20px; border-radius: 6px; accent-color: #00f2ea; cursor: pointer; }
    .checkbox-group label { color: #1a1d1f; font-weight: 600; font-size: 0.95rem; cursor: pointer; margin: 0; }
    .tags-container { background: #f4f4f4; border-radius: 0.75rem; padding: 1.25rem; max-height: 350px; overflow-y: auto; }
    .tags-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 0.75rem; }
    .tag-checkbox { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; background: #ffffff; border: 1px solid #efefef; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s ease; }
    .tag-checkbox:hover { border-color: #00f2ea; transform: translateY(-1px); }
    .tag-checkbox input[type="checkbox"] { width: 18px; height: 18px; accent-color: #00f2ea; }
    .tag-checkbox label { color: #1a1d1f; font-weight: 600; font-size: 0.875rem; cursor: pointer; margin: 0; }
    .error-alert { background: #fff5f5; border: 1px solid #ffe3e3; border-radius: 1rem; padding: 1.25rem; margin-bottom: 2rem; display: flex; gap: 1rem; }
    .error-alert i { color: #ff6b6b; flex-shrink: 0; }
    .error-alert h3 { color: #ff6b6b; font-weight: 700; font-size: 0.95rem; margin: 0 0 0.5rem 0; }
    .error-alert ul { margin: 0; padding-left: 1.25rem; color: #ff6b6b; font-size: 0.875rem; font-weight: 500; }
    .form-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2.5rem; padding-top: 2rem; border-top: 1px solid #f0f2f5; }
    .btn { padding: 0.875rem 1.75rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.625rem; font-size: 0.95rem; text-decoration: none; }
    .btn-primary { background: #00f2ea; color: #ffffff; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-primary:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .btn-secondary { background: #f4f4f4; color: #6f767e; }
    .btn-secondary:hover { background: #efefef; color: #1a1d1f; }
    .section-divider { margin: 2.5rem 0 2rem; height: 1px; background: #f0f2f5; }
    .section-title { color: #1a1d1f; font-weight: 800; font-size: 1.125rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; }
    .section-title i { color: #00f2ea; }
</style>

<div class="page-header">
    <h1 class="page-title"><i data-lucide="plus-circle"></i> Создание нового аниме</h1>
</div>

@if($errors->any())
    <div class="error-alert">
        <i data-lucide="alert-circle"></i>
        <div>
            <h3>Ошибки валидации</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="form-container">
    <form action="{{ route('admin.anime.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group full">
                <label class="form-label"><i data-lucide="type"></i> Название <span class="required">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Название аниме..." class="form-input">
            </div>
            <div class="form-group full">
                <label class="form-label"><i data-lucide="align-left"></i> Описание</label>
                <textarea name="description" placeholder="Описание сюжета..." class="form-textarea">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="image"></i> URL постера</label>
                <input type="url" name="poster_url" value="{{ old('poster_url') }}" placeholder="https://..." class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="star"></i> Рейтинг (0-10)</label>
                <input type="number" name="rating" value="{{ old('rating') }}" step="0.1" min="0" max="10" placeholder="8.5" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="activity"></i> Статус <span class="required">*</span></label>
                <select name="status" required class="form-select">
                    <option value="">Выберите статус...</option>
                    <option value="planned" {{ old('status') === 'planned' ? 'selected' : '' }}>Планируется</option>
                    <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>Выходит</option>
                    <option value="finished" {{ old('status') === 'finished' ? 'selected' : '' }}>Завершено</option>
                    <option value="paused" {{ old('status') === 'paused' ? 'selected' : '' }}>На паузе</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="monitor"></i> Тип <span class="required">*</span></label>
                <select name="type" required class="form-select">
                    <option value="">Выберите тип...</option>
                    <option value="tv" {{ old('type') === 'tv' ? 'selected' : '' }}>ТВ</option>
                    <option value="movie" {{ old('type') === 'movie' ? 'selected' : '' }}>Фильм</option>
                    <option value="ova" {{ old('type') === 'ova' ? 'selected' : '' }}>OVA</option>
                    <option value="ona" {{ old('type') === 'ona' ? 'selected' : '' }}>ONA</option>
                    <option value="special" {{ old('type') === 'special' ? 'selected' : '' }}>Спецвыпуск</option>
                    <option value="music" {{ old('type') === 'music' ? 'selected' : '' }}>Музыка</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="calendar"></i> Год выхода</label>
                <input type="number" name="year" value="{{ old('year') }}" min="1900" max="2100" placeholder="{{ date('Y') }}" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="layers"></i> Эпизодов</label>
                <input type="number" name="number_of_episodes" value="{{ old('number_of_episodes') }}" min="0" placeholder="12" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="calendar-days"></i> Выход с</label>
                <input type="date" name="aired_from" value="{{ old('aired_from') }}" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label"><i data-lucide="calendar-check"></i> Выход до</label>
                <input type="date" name="aired_to" value="{{ old('aired_to') }}" class="form-input">
            </div>
        </div>
        <div class="section-title"><i data-lucide="shield-alert"></i> Дополнительно</div>
        <div class="form-grid">
            <div class="form-group full">
                <div class="checkbox-group">
                    <input type="checkbox" id="nsfw_flag" name="nsfw_flag" value="1" {{ old('nsfw_flag') ? 'checked' : '' }}>
                    <label for="nsfw_flag">Содержит NSFW контент (18+)</label>
                </div>
            </div>
        </div>
        <div class="section-title"><i data-lucide="tags"></i> Теги</div>
        @if($tags->count() > 0)
            <div class="tags-container">
                <div class="tags-grid">
                    @foreach($tags as $tag)
                        <div class="tag-checkbox">
                            <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                            <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div style="text-align: center; padding: 3rem; color: #6f767e; background: #f4f4f4; border-radius: 1rem;">
                <i data-lucide="tag-off" style="width: 48px; height: 48px; margin-bottom: 1rem; opacity: 0.5;"></i>
                <p style="font-weight: 600;">Нет доступных тегов</p>
            </div>
        @endif
        <div class="form-actions">
            <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary"><i data-lucide="x"></i> Отменить</a>
            <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Создать аниме</button>
        </div>
    </form>
</div>
<script>lucide.createIcons();</script>
@endsection
