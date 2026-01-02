@extends('layouts.admin')
@section('title', 'Новый тег - AniYume Админ')
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
        max-width: 700px;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }

    .info-strip {
        background: rgba(46, 196, 182, 0.05);
        border: 1px solid rgba(46, 196, 182, 0.1);
        border-radius: 14px;
        padding: 1.25rem;
        color: #2EC4B6;
        font-size: 0.75rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-group { display: flex; flex-direction: column; margin-bottom: 2rem; }
    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 1rem; display: block; }
    .form-label span { color: #ff4d4d; }

    .form-input {
        background: #161616;
        border: 1px solid rgba(255,255,255,0.1);
        color: #FFF;
        border-radius: 14px;
        padding: 1.25rem;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-weight: 600;
        width: 100%;
    }
    .form-input:focus { border-color: #2EC4B6; outline: none; background: #1a1a1a; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

    .form-hint { color: rgba(255,255,255,0.2); font-size: 0.7rem; font-weight: 700; margin-top: 0.75rem; font-style: italic; }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.05);
        flex-wrap: wrap;
    }

    .btn { padding: 1.1rem 2.2rem; border-radius: 14px; font-weight: 900; text-transform: uppercase; font-size: 0.8rem; transition: 0.3s; text-decoration: none; cursor: pointer; border: none; display: inline-flex; align-items: center; justify-content: center; }
    .btn-primary { background: #2EC4B6; color: #000; box-shadow: 0 10px 20px rgba(46, 196, 182, 0.2); }
    .btn-primary:hover { transform: translateY(-3px); background: #26a69a; }
    .btn-secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.4); }
    .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #fff; }

    @media (max-width: 640px) {
        .btn { width: 100%; }
        .form-actions { flex-direction: column-reverse; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Новый <span>Тег</span></h1>
</div>

<div class="form-container">
    <div class="info-strip">
        <i data-lucide="info"></i> Slug (ЧПУ) будет сгенерирован автоматически из названия
    </div>

    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Наименование тега <span>*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Экшен, Сёнен, Драма..." class="form-input">
            <div class="form-hint">Используйте короткие и емкие названия для лучшей фильтрации</div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Отмена</a>
            <button type="submit" class="btn btn-primary">Создать тег</button>
        </div>
    </form>
</div>
<script>lucide.createIcons();</script>
@endsection
