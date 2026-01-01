@extends('layouts.admin')
@section('title', 'Редактирование ' . $tag->name . ' - AniYume Админ')
@section('content')
<style>
    .page-header { margin-bottom: 2rem; }
    .page-title { color: #1a1d1f; font-weight: 800; font-size: 1.75rem; margin: 0; }
    .subtitle { color: #6f767e; font-size: 0.9rem; margin-top: 0.5rem; }
    .form-container { background: #ffffff; border: 1px solid #f0f2f5; border-radius: 1.25rem; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.02); max-width: 600px; }
    .form-group { display: flex; flex-direction: column; margin-bottom: 1.5rem; }
    .form-label { color: #6f767e; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.625rem; display: block; }
    .required { color: #dc2626; margin-left: 0.25rem; }
    .form-input { background: #f4f4f4; border: 2px solid transparent; color: #1a1d1f; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 600; }
    .form-input:focus { outline: none; border-color: #00f2ea; background: #ffffff; }
    .form-hint { color: #6f767e; font-size: 0.8rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.375rem; }
    .stats-box { background: #fcfdfe; border: 1px solid #f0f2f5; border-radius: 0.75rem; padding: 1rem; color: #1a1d1f; font-size: 0.85rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; }
    .stats-box-label { color: #6f767e; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.25rem; }
    .stats-box-value { color: #00f2ea; font-weight: 700; font-size: 1rem; }
    .error-alert { background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem; color: #dc2626; }
    .error-alert h3 { color: #dc2626; font-weight: 700; font-size: 0.9rem; margin: 0 0 0.5rem 0; text-transform: uppercase; letter-spacing: 0.025em; }
    .error-alert ul { margin: 0; padding-left: 1.25rem; font-size: 0.85rem; }
    .error-alert li { margin-bottom: 0.25rem; }
    .form-actions { display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #f0f2f5; }
    .btn { padding: 0.75rem 1.5rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; text-decoration: none; }
    .btn-primary { background: #00f2ea; color: #ffffff; box-shadow: 0 4px 14px rgba(0, 242, 234, 0.3); }
    .btn-primary:hover { background: #00d1ca; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 242, 234, 0.4); }
    .btn-secondary { background: #ffffff; color: #6f767e; border: 2px solid #f0f2f5; }
    .btn-secondary:hover { background: #f4f4f4; border-color: #e0e2e5; }
    .info-banner { background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 0.75rem; padding: 0.75rem 1rem; color: #0d9488; font-size: 0.75rem; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.025em; font-weight: 600; }
    @media (max-width: 768px) {
        .form-container { padding: 1.25rem; max-width: 100%; }
        .form-actions { flex-direction: column; gap: 0.625rem; }
        .btn { width: 100%; justify-content: center; }
        .page-title { font-size: 1.5rem; }
        .stats-box { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Редактирование тега</h1>
    <p class="subtitle">{{ $tag->name }}</p>
</div>

@if($errors->any())
    <div class="error-alert">
        <h3>Ошибки валидации</h3>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-container">
    <div class="info-banner">
        ℹ️ Слаг будет обновлен автоматически при сохранении
    </div>

    <div class="stats-box">
        <div style="flex: 1;">
            <div class="stats-box-label">Используется в аниме</div>
            <div class="stats-box-value">{{ number_format($tag->anime_count) }}</div>
        </div>
    </div>

    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">
                Название тега <span class="required">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $tag->name) }}" required
                   class="form-input">
            <div class="form-hint">
                💡 Это название будет использоваться во всех {{ number_format($tag->anime_count) }} аниме с этим тегом
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Отменить</a>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>
@endsection
