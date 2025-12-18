@extends('layouts.admin')

@section('title', 'Edit Episode - AniYume Admin')

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
        max-width: 800px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
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
        font-size: 18px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-box-title {
        color: #00ffc8;
        font-weight: 700;
        margin-bottom: 4px;
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
    <h1 class="page-title">✏️ Edit Episode</h1>
    <p class="subtitle">
        {{ optional($episode->anime)->title ? 'Anime: ' . $episode->anime->title : 'Anime is missing' }}
    </p>
</div>

@if($errors->any())
    <div class="error-alert">
        <h3>⚠️ Validation Errors</h3>
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
        <div>
            <div class="info-box-title">Episode #{{ $episode->episode_number }}</div>
            You can update title, duration, status and player URL for this episode.
        </div>
    </div>

    <form action="{{ route('admin.episodes.update', $episode->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Episode Number <span class="required">*</span>
                </label>
                <input type="number"
                       name="episode_number"
                       value="{{ old('episode_number', $episode->episode_number) }}"
                       min="1"
                       required
                       class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Duration (minutes)</label>
                <input type="number"
                       name="duration"
                       value="{{ old('duration', $episode->duration) }}"
                       min="0"
                       class="form-input"
                       placeholder="e.g., 24">
            </div>

            <div class="form-group">
                <label class="form-label">
                    Status <span class="required">*</span>
                </label>
                <select name="status" required class="form-select">
                    @php
                        $status = old('status', $episode->status);
                    @endphp
                    <option value="published" {{ $status === 'published' ? 'selected' : '' }}>✅ Published</option>
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                    <option value="archived" {{ $status === 'archived' ? 'selected' : '' }}>📦 Archived</option>
                </select>
            </div>

            <div class="form-group full">
                <label class="form-label">Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $episode->title) }}"
                       class="form-input"
                       placeholder="Episode title (optional)">
            </div>

            <div class="form-group full">
                <label class="form-label">Player URL</label>
                <input type="url"
                       name="player_url"
                       value="{{ old('player_url', $episode->player_url) }}"
                       class="form-input"
                       placeholder="https://...">
            </div>

            <div class="form-group full">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-textarea"
                          placeholder="Short description (optional)">{{ old('description', $episode->description ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">
                ← Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                ✓ Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
