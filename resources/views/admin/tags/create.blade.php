@extends('layouts.admin')

@section('title', 'Создание тега - АниЮм Админ')

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

    .form-container {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1.5px solid rgba(0, 255, 200, 0.2);
        border-radius: 16px;
        padding: 32px;
        backdrop-filter: blur(10px);
        max-width: 600px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 24px;
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

    .form-input {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
        border: 1px solid rgba(0, 255, 200, 0.2);
        color: #e0e0e0;
        border-radius: 10px;
        padding: 12px 14px;
        transition: all 0.3s ease;
        font-family: 'Onest', sans-serif;
        font-size: 14px;
    }

    .form-input::placeholder {
        color: rgba(224, 224, 224, 0.4);
    }

    .form-input:focus {
        outline: none;
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
        border-color: #00ffc8;
        box-shadow: 0 0 20px rgba(0, 255, 200, 0.3), inset 0 0 10px rgba(0, 255, 200, 0.08);
    }

    .form-hint {
        color: rgba(176, 224, 255, 0.6);
        font-size: 13px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-hint-icon {
        color: #00ffc8;
        font-size: 14px;
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

    .info-box {
        background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
        border: 1px solid rgba(0, 255, 200, 0.25);
        border-radius: 10px;
        padding: 16px;
        color: #b0e0ff;
        font-size: 13px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .info-box-icon {
        color: #00ffc8;
        font-size: 16px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-box-content {
        flex: 1;
    }

    .info-box-title {
        color: #00ffc8;
        font-weight: 700;
        margin-bottom: 6px;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
            max-width: 100%;
        }

        .form-actions {
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .page-title {
            font-size: 24px;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">➕ Создание нового тега</h1>
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
    <div class="info-box">
        <div class="info-box-icon">ℹ️</div>
        <div class="info-box-content">
            <div class="info-box-title">Информация</div>
            Слаг будет сгенерирован автоматически на основе названия тега
        </div>
    </div>

    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">
                Название тега <span class="required">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   placeholder="Например: Экшен, Комедия, Научная фантастика"
                   class="form-input">
            <div class="form-hint">
                <span class="form-hint-icon">💡</span>
                Придумайте понятное и краткое название для тега
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">
                ← Отменить
            </a>
            <button type="submit" class="btn btn-primary">
                ✓ Создать тег
            </button>
        </div>
    </form>
</div>

@endsection
