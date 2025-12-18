@extends('layouts.admin')

@section('title', 'Редактирование ' . $anime->title . ' - АниЮм Админ')

@section('content')

<style>
    .page-header {
        margin-bottom: 32px;
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

    .subtitle {
        color: rgba(176, 224, 255, 0.6);
        font-size: 14px;
        margin-top: 4px;
    }

    .form-container {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 32px;
        backdrop-filter: blur(10px);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        color: #b0e0ff;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
    }

    .required {
        color: #ff9fa0;
        margin-left: 4px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        color: #e0e0e0;
        border-radius: 10px;
        padding: 12px 14px;
        transition: all 0.3s ease;
        font-family: 'Onest', sans-serif;
        font-size: 14px;
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: rgba(224, 224, 224, 0.4);
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
        border-color: #00ffc8;
        box-shadow: 0 0 20px rgba(0, 255, 200, 0.3), inset 0 0 10px rgba(0, 255, 200, 0.08);
    }

    .form-select option {
        background: #0a0a1a;
        color: #e0e0e0;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background: rgba(0, 255, 200, 0.08);
        border: 1px solid rgba(0, 255, 200, 0.15);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .checkbox-group:hover {
        background: rgba(0, 255, 200, 0.12);
        border-color: rgba(0, 255, 200, 0.25);
    }

    .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #00ffc8;
    }

    .checkbox-group label {
        color: #d0e8ff;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        margin: 0;
    }

    .tags-container {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        border-radius: 10px;
        padding: 16px;
        max-height: 300px;
        overflow-y: auto;
    }

    .tags-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 12px;
    }

    .tag-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        background: rgba(0, 255, 200, 0.08);
        border: 1px solid rgba(0, 255, 200, 0.15);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .tag-checkbox:hover {
        background: rgba(0, 255, 200, 0.12);
        border-color: rgba(0, 255, 200, 0.25);
    }

    .tag-checkbox input[type="checkbox"] {
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: #00ffc8;
    }

    .tag-checkbox label {
        color: #b0e0ff;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        margin: 0;
    }

    .tag-checkbox input[type="checkbox"]:checked + label {
        color: #00ffc8;
        font-weight: 700;
    }

    .error-alert {
        background: linear-gradient(135deg, rgba(255, 100, 100, 0.12), rgba(255, 100, 100, 0.05));
        border: 1.5px solid rgba(255, 100, 100, 0.3);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        color: #ff9fa0;
        animation: slideDownNotif 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        padding-left: 24px;
    }

    @keyframes slideDownNotif {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .error-alert::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #ff6b6b, #ee5a6f);
        border-radius: 12px 0 0 12px;
    }

    .error-alert h3 {
        color: #ff9fa0;
        font-weight: 700;
        font-size: 14px;
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .error-alert ul {
        margin: 0;
        padding-left: 20px;
        font-size: 13px;
    }

    .error-alert li {
        margin-bottom: 4px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid rgba(0, 255, 200, 0.15);
    }

    .btn {
        padding: 12px 24px;
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

    .btn:active {
        transform: translateY(0);
    }

    .section-divider {
        margin-top: 32px;
        margin-bottom: 24px;
        padding-top: 24px;
        border-top: 1px solid rgba(0, 255, 200, 0.15);
    }

    .section-title {
        color: #00ffc8;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-box {
        background: rgba(0, 255, 200, 0.08);
        border: 1px solid rgba(0, 255, 200, 0.15);
        border-radius: 10px;
        padding: 12px 14px;
        color: #b0e0ff;
        font-size: 13px;
        margin-bottom: 16px;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .form-actions {
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .tags-grid {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 24px;
        }
    }

    .tags-container::-webkit-scrollbar {
        width: 6px;
    }

    .tags-container::-webkit-scrollbar-track {
        background: rgba(0, 255, 200, 0.05);
        border-radius: 3px;
    }

    .tags-container::-webkit-scrollbar-thumb {
        background: rgba(0, 255, 200, 0.2);
        border-radius: 3px;
    }

    .tags-container::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 255, 200, 0.3);
    }
</style>

<div class="page-header">
    <h1 class="page-title">✏️ Редактирование аниме</h1>
    <p class="subtitle">{{ $anime->title }}</p>
</div>

@if($errors->any())
    <div class="error-alert">
        <h3>⚠️ Ошибки валидации</h3>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-container">
    <form action="{{ route('admin.anime.update', $anime->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="info-box">
            ℹ️ Последнее обновление: {{ $anime->updated_at->format('d.m.Y H:i') }}
        </div>

        <div class="form-grid">
            <div class="form-group full">
                <label class="form-label">
                    Название <span class="required">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $anime->title) }}" required
                       class="form-input">
            </div>

            <div class="form-group full">
                <label class="form-label">Описание</label>
                <textarea name="description" placeholder="Введите описание аниме..."
                          class="form-textarea">{{ old('description', $anime->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">URL постера</label>
                <input type="url" name="poster_url" value="{{ old('poster_url', $anime->poster_url) }}"
                       class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Рейтинг (0-10)</label>
                <input type="number" name="rating" value="{{ old('rating', $anime->rating) }}" step="0.1" min="0" max="10"
                       class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Статус <span class="required">*</span></label>
                <select name="status" required class="form-select">
                    <option value="planned" {{ old('status', $anime->status) === 'planned' ? 'selected' : '' }}>📅 Планируется</option>
                    <option value="ongoing" {{ old('status', $anime->status) === 'ongoing' ? 'selected' : '' }}>🎯 Выходит</option>
                    <option value="finished" {{ old('status', $anime->status) === 'finished' ? 'selected' : '' }}>✅ Завершено</option>
                    <option value="paused" {{ old('status', $anime->status) === 'paused' ? 'selected' : '' }}>⏸️ На паузе</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Тип <span class="required">*</span></label>
                <select name="type" required class="form-select">
                    <option value="tv" {{ old('type', $anime->type) === 'tv' ? 'selected' : '' }}>📺 ТВ</option>
                    <option value="movie" {{ old('type', $anime->type) === 'movie' ? 'selected' : '' }}>🎞️ Фильм</option>
                    <option value="ova" {{ old('type', $anime->type) === 'ova' ? 'selected' : '' }}>📻 OVA</option>
                    <option value="ona" {{ old('type', $anime->type) === 'ona' ? 'selected' : '' }}>💻 ONA</option>
                    <option value="special" {{ old('type', $anime->type) === 'special' ? 'selected' : '' }}>⭐ Спецвыпуск</option>
                    <option value="music" {{ old('type', $anime->type) === 'music' ? 'selected' : '' }}>🎵 Музыка</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Год выхода</label>
                <input type="number" name="year" value="{{ old('year', $anime->year) }}" min="1900" max="2100"
                       class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Количество эпизодов</label>
                <input type="number" name="number_of_episodes" value="{{ old('number_of_episodes', $anime->number_of_episodes) }}" min="0"
                       class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Выход с</label>
                <input type="date" name="aired_from" value="{{ old('aired_from', $anime->aired_from?->format('Y-m-d')) }}"
                       class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Выход до</label>
                <input type="date" name="aired_to" value="{{ old('aired_to', $anime->aired_to?->format('Y-m-d')) }}"
                       class="form-input">
            </div>
        </div>

        <div class="section-divider"></div>

        <div class="section-title">🔞 Дополнительные параметры</div>

        <div class="form-grid">
            <div class="form-group full">
                <div class="checkbox-group">
                    <input type="checkbox" id="nsfw_flag" name="nsfw_flag" value="1"
                           {{ old('nsfw_flag', $anime->nsfw_flag) ? 'checked' : '' }}>
                    <label for="nsfw_flag">Содержит NSFW контент</label>
                </div>
            </div>
        </div>

        <div class="section-divider"></div>

        <div class="section-title">🏷️ Теги</div>

        @if($tags->count() > 0)
            <div class="tags-container">
                <div class="tags-grid">
                    @foreach($tags as $tag)
                        <div class="tag-checkbox">
                            <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                                   {{ in_array($tag->id, old('tags', $anime->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div style="text-align: center; padding: 40px 20px; color: rgba(176, 224, 255, 0.6);">
                <span style="font-size: 32px; display: block; margin-bottom: 12px;">🏷️</span>
                Нет доступных тегов
            </div>
        @endif

        <div class="form-actions">
            <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary">
                ← Отменить
            </a>
            <button type="submit" class="btn btn-primary">
                ✓ Сохранить изменения
            </button>
        </div>
    </form>
</div>

@endsection
