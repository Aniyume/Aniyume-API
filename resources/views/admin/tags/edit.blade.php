@extends('layouts.admin')
@section('title', 'Правка тега - AniYume Админ')
@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header { margin-bottom: 2.5rem; animation: fadeInUp 0.5s ease; }
    .page-title { color: #FFF; font-weight: 900; font-size: clamp(1.5rem, 5vw, 2.5rem); text-transform: uppercase; letter-spacing: -0.05em; }
    .page-title span { color: #2EC4B6; font-style: italic; }
    .subtitle { color: rgba(255,255,255,0.3); font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.2em; margin-top: 8px; display: block; }

    .form-container {
        background: #111111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 24px;
        padding: clamp(1.5rem, 5vw, 3rem);
        max-width: 700px;
        animation: fadeInUp 0.5s ease 0.1s forwards;
        opacity: 0;
    }

    .stats-box {
        background: rgba(46, 196, 182, 0.05);
        border: 1px solid rgba(46, 196, 182, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        display: flex;
        flex-direction: column;
    }
    .stats-label { color: rgba(255,255,255,0.3); font-size: 0.65rem; font-weight: 900; text-transform: uppercase; margin-bottom: 5px; }
    .stats-value { font-size: 1.5rem; font-weight: 900; color: #2EC4B6; font-style: italic; }

    .form-group { display: flex; flex-direction: column; margin-bottom: 2rem; }
    .form-label { color: rgba(255,255,255,0.4); font-weight: 900; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 1rem; display: block; }

    .form-input {
        background: #161616;
        border: 1px solid rgba(255,255,255,0.1);
        color: #FFF;
        border-radius: 14px;
        padding: 1.25rem;
        transition: 0.3s;
        font-size: 1rem;
        font-weight: 600;
        width: 100%;
    }
    .form-input:focus { border-color: #2EC4B6; outline: none; background: #1a1a1a; transform: translateY(-2px); }

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

    @media (max-width: 640px) {
        .btn { width: 100%; }
        .form-actions { flex-direction: column-reverse; }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Правка <span>Тега</span></h1>
    <span class="subtitle">{{ $tag->name }}</span>
</div>

<div class="form-container">
    <div class="stats-box">
        <span class="stats-label">Использование в системе</span>
        <span class="stats-value">{{ number_format($tag->anime_count) }} релизов</span>
    </div>

    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Наименование</label>
            <input type="text" name="name" value="{{ old('name', $tag->name) }}" required class="form-input">
            <div class="form-hint">Внимание: изменение названия обновит его во всех связанных аниме</div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Назад</a>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>

<script>lucide.createIcons();</script>
@endsection
