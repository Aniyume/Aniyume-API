@extends('layouts.admin')

@section('title', 'Панель управления - АниЮм Админ')

@section('content')

<style>
.stat-card {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.1), rgba(0, 200, 255, 0.08));
border: 1.5px solid rgba(0, 255, 200, 0.25);
border-radius: 16px;
padding: 24px;
backdrop-filter: blur(10px);
transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
position: relative;
overflow: hidden;
}

.stat-card::before {
content: '';
position: absolute;
top: 0;
left: -100%;
width: 100%;
height: 100%;
background: linear-gradient(90deg, transparent, rgba(0, 255, 200, 0.1), transparent);
transition: left 0.6s ease;
}

.stat-card:hover::before {
left: 100%;
}

.stat-card:hover {
border-color: rgba(0, 255, 200, 0.45);
box-shadow: 0 20px 50px rgba(0, 255, 200, 0.15);
transform: translateY(-6px);
}

.stat-number {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
font-weight: 800;
font-size: 3rem;
line-height: 1;
}

.stat-label {
color: #b0e0ff;
font-weight: 600;
font-size: 13px;
text-transform: uppercase;
letter-spacing: 1px;
margin-bottom: 8px;
}

.stat-desc {
color: rgba(0, 255, 200, 0.7);
font-size: 12px;
margin-top: 8px;
}

.section-title {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
font-weight: 700;
font-size: 24px;
margin-bottom: 20px;
display: flex;
align-items: center;
gap: 10px;
}

.section-card {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
border: 1.5px solid rgba(0, 255, 200, 0.2);
border-radius: 16px;
padding: 24px;
backdrop-filter: blur(10px);
transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.section-card:hover {
border-color: rgba(0, 255, 200, 0.35);
box-shadow: 0 16px 40px rgba(0, 255, 200, 0.12);
transform: translateY(-4px);
}

.status-item {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
border: 1px solid rgba(0, 255, 200, 0.2);
border-radius: 12px;
padding: 16px;
text-align: center;
transition: all 0.3s ease;
}

.status-item:hover {
border-color: rgba(0, 255, 200, 0.35);
box-shadow: 0 8px 20px rgba(0, 255, 200, 0.1);
transform: translateY(-3px);
}

.status-emoji {
font-size: 32px;
margin-bottom: 8px;
}

.status-count {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
font-weight: 700;
font-size: 24px;
}

.status-name {
color: #b0e0ff;
font-size: 12px;
text-transform: uppercase;
letter-spacing: 0.5px;
margin-top: 6px;
font-weight: 600;
}

.type-item {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.1), rgba(0, 200, 255, 0.08));
border: 1px solid rgba(0, 255, 200, 0.2);
border-radius: 12px;
padding: 14px;
display: flex;
justify-content: space-between;
align-items: center;
transition: all 0.3s ease;
}

.type-item:hover {
border-color: rgba(0, 255, 200, 0.35);
background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
transform: translateX(4px);
}

.type-name {
display: flex;
align-items: center;
gap: 10px;
color: #d0e8ff;
font-weight: 600;
}

.type-emoji {
font-size: 20px;
}

.type-count {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
font-weight: 700;
font-size: 18px;
}

.import-item {
border-radius: 12px;
padding: 16px;
margin-bottom: 12px;
transition: all 0.3s ease;
border-left: 4px solid;
}

.import-item:hover {
transform: translateX(4px);
box-shadow: 0 8px 20px rgba(0, 255, 200, 0.1);
}

.import-completed {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
border-color: #00ffc8;
}

.import-failed {
background: linear-gradient(135deg, rgba(255, 100, 100, 0.12), rgba(255, 80, 80, 0.08));
border-color: #ff6464;
}

.import-running {
background: linear-gradient(135deg, rgba(255, 200, 100, 0.12), rgba(255, 180, 80, 0.08));
border-color: #ffc864;
animation: pulse-import 2s ease-in-out infinite;
}

@keyframes pulse-import {
0%, 100% { opacity: 1; }
50% { opacity: 0.8; }
}

.import-header {
display: flex;
justify-content: space-between;
align-items: flex-start;
margin-bottom: 12px;
}

.import-title {
display: flex;
align-items: center;
gap: 10px;
}

.import-emoji {
font-size: 24px;
}

.import-info {
color: #d0e8ff;
}

.import-name {
font-weight: 700;
font-size: 14px;
}

.import-date {
font-size: 12px;
color: rgba(208, 232, 255, 0.6);
margin-top: 2px;
}

.import-badge {
display: inline-block;
padding: 4px 12px;
border-radius: 20px;
font-size: 11px;
font-weight: 700;
text-transform: uppercase;
background: rgba(0, 255, 200, 0.15);
color: #00ffc8;
border: 1px solid rgba(0, 255, 200, 0.3);
}

.import-stats {
display: grid;
grid-template-columns: repeat(4, 1fr);
gap: 10px;
font-size: 12px;
}

.import-stat {
text-align: center;
padding: 8px;
background: rgba(0, 0, 0, 0.2);
border-radius: 8px;
}

.import-stat-value {
font-weight: 700;
font-size: 16px;
background: linear-gradient(135deg, #00ffc8, #00c8ff);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
}

.import-stat-label {
color: rgba(208, 232, 255, 0.6);
margin-top: 2px;
}

.anime-item {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.1), rgba(0, 200, 255, 0.08));
border: 1px solid rgba(0, 255, 200, 0.2);
border-radius: 12px;
padding: 16px;
display: flex;
justify-content: space-between;
align-items: flex-start;
transition: all 0.3s ease;
}

.anime-item:hover {
border-color: rgba(0, 255, 200, 0.35);
background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
box-shadow: 0 8px 20px rgba(0, 255, 200, 0.1);
transform: translateY(-3px);
}

.anime-content {
flex: 1;
}

.anime-title {
font-weight: 700;
color: #00ffc8;
font-size: 14px;
margin-bottom: 8px;
transition: color 0.3s ease;
}

.anime-item:hover .anime-title {
color: #00ffc8;
text-decoration: underline;
}

.anime-tags {
display: flex;
gap: 6px;
flex-wrap: wrap;
}

.anime-tag {
display: inline-block;
padding: 4px 10px;
border-radius: 6px;
font-size: 11px;
font-weight: 600;
background: rgba(0, 255, 200, 0.15);
color: #00ffc8;
border: 1px solid rgba(0, 255, 200, 0.2);
}

.anime-rating {
text-align: right;
}

.anime-rating-value {
background: linear-gradient(135deg, #ffc857, #ffaa00);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
font-weight: 800;
font-size: 20px;
line-height: 1;
}

.anime-rating-label {
color: rgba(208, 232, 255, 0.6);
font-size: 11px;
margin-top: 2px;
}

.empty-state {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
border: 2px dashed rgba(0, 255, 200, 0.25);
border-radius: 12px;
padding: 40px;
text-align: center;
color: #b0e0ff;
}

.empty-emoji {
font-size: 48px;
margin-bottom: 12px;
}

.empty-text {
font-size: 14px;
margin-bottom: 16px;
}

.empty-link {
color: #00ffc8;
font-weight: 700;
text-decoration: none;
transition: all 0.3s ease;
}

.empty-link:hover {
text-decoration: underline;
}

.action-bar {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
border-radius: 16px;
padding: 32px;
margin-top: 32px;
display: flex;
justify-content: space-between;
align-items: center;
gap: 20px;
box-shadow: 0 20px 50px rgba(0, 255, 200, 0.2);
}

.action-text h3 {
font-size: 22px;
font-weight: 700;
color: #0a0a1a;
margin: 0 0 6px 0;
}

.action-text p {
color: rgba(10, 10, 26, 0.7);
font-size: 14px;
margin: 0;
}

.action-buttons {
display: flex;
gap: 12px;
flex-wrap: wrap;
}

.action-btn {
background: white;
color: #00c8ff;
padding: 10px 18px;
border-radius: 10px;
border: none;
font-weight: 700;
cursor: pointer;
transition: all 0.3s ease;
text-decoration: none;
font-size: 13px;
display: inline-flex;
align-items: center;
gap: 6px;
white-space: nowrap;
}

.action-btn:hover {
background: rgba(255, 255, 255, 0.9);
transform: translateY(-2px);
box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.header-section {
margin-bottom: 32px;
}

.page-title {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
font-weight: 800;
font-size: 32px;
margin: 0 0 8px 0;
}

.page-subtitle {
color: rgba(176, 224, 255, 0.6);
font-size: 14px;
}

@media (max-width: 768px) {
.stat-card {
padding: 18px;
}

.stat-number {
font-size: 2rem;
}

.action-bar {
flex-direction: column;
text-align: center;
}

.action-buttons {
width: 100%;
justify-content: center;
}

.import-stats {
grid-template-columns: repeat(2, 1fr);
}

.section-card {
padding: 18px;
}
}
</style>

<div class="header-section">
<h1 class="page-title">✨ Панель управления</h1>
<p class="page-subtitle">Добро пожаловать в админ-панель АниЮм</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
<div class="stat-card">
<div class="stat-label">Всего аниме</div>
<div class="stat-number">{{ number_format($total_anime) }}</div>
<div class="stat-desc">Управление контентом</div>
</div>


<div class="stat-card">
    <div class="stat-label">Эпизодов</div>
    <div class="stat-number">{{ number_format($total_episodes ?? 0) }}</div>
    <div class="stat-desc">Всего эпизодов</div>
</div>

<div class="stat-card">
    <div class="stat-label">Пользователей</div>
    <div class="stat-number">{{ number_format($total_users) }}</div>
    <div class="stat-desc">Участники сообщества</div>
</div>

<div class="stat-card">
    <div class="stat-label">Теги</div>
    <div class="stat-number">{{ number_format($total_tags) }}</div>
    <div class="stat-desc">Метки контента</div>
</div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
<div class="lg:col-span-2 section-card">
<div class="section-title">
<span>📊</span>
Статистика аниме
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
@php
$statuses = [
'ongoing' => '🎯',
'planned' => '📅',
'finished' => '✅',
'paused' => '⏸️'
];
@endphp
@foreach($statuses as $status => $emoji)
@php $count = $anime_by_status[$status] ?? 0; @endphp
<div class="status-item">
<div class="status-emoji">{{ $emoji }}</div>
<div class="status-count">{{ number_format($count) }}</div>
<div class="status-name">{{ ucfirst($status) }}</div>
</div>
@endforeach
</div>
</div>


<div class="section-card">
    <div class="section-title">
        <span>📺</span>
        По типам
    </div>
    <div class="space-y-3">
        @php
            $types = ['tv' => '📺', 'movie' => '🎞️', 'ova' => '📻', 'ona' => '💻', 'special' => '⭐'];
        @endphp
        @foreach($anime_by_type as $type => $count)
            <div class="type-item">
                <div class="type-name">
                    <span class="type-emoji">{{ $types[$type] ?? '📽️' }}</span>
                    <span>{{ strtoupper($type) }}</span>
                </div>
                <div class="type-count">{{ number_format($count) }}</div>
            </div>
        @endforeach
    </div>
</div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
<div class="section-card">
<div class="section-title">
<span>⬆️</span>
Последние импорты
</div>
@forelse($recent_imports as $import)
@php
$statusClass = match($import->status) {
'completed' => 'import-completed',
'failed' => 'import-failed',
'running' => 'import-running',
default => 'import-completed'
};
$statusEmoji = match($import->status) {
'completed' => '✅',
'failed' => '❌',
'running' => '⏳',
default => 'ℹ️'
};
@endphp
<div class="import-item {{ $statusClass }}">
<div class="import-header">
<div class="import-title">
<span class="import-emoji">{{ $statusEmoji }}</span>
<div class="import-info">
<div class="import-name">{{ ucfirst($import->import_type) }} Импорт</div>
<div class="import-date">{{ $import->started_at->format('d M Y H:i') }}</div>
</div>
</div>
<span class="import-badge">{{ strtoupper($import->status) }}</span>
</div>
<div class="import-stats">
<div class="import-stat">
<div class="import-stat-value">{{ number_format($import->total_processed) }}</div>
<div class="import-stat-label">Обработано</div>
</div>
<div class="import-stat">
<div class="import-stat-value">{{ number_format($import->total_created) }}</div>
<div class="import-stat-label">Создано</div>
</div>
<div class="import-stat">
<div class="import-stat-value">{{ number_format($import->total_updated) }}</div>
<div class="import-stat-label">Обновлено</div>
</div>
<div class="import-stat">
<div class="import-stat-value">{{ number_format($import->total_skipped) }}</div>
<div class="import-stat-label">Пропущено</div>
</div>
</div>
</div>
@empty
<div class="empty-state">
<div class="empty-emoji">📥</div>
<div class="empty-text">Импортов еще нет</div>
<a href="{{ route('admin.import.index') }}" class="empty-link">Начать импорт →</a>
</div>
@endforelse
</div>


<div class="section-card">
    <div class="section-title">
        <span>🔥</span>
        Популярное аниме
    </div>
    @forelse($latest_anime as $anime)
        <div class="anime-item">
            <div class="anime-content">
                <a href="{{ route('admin.anime.show', $anime->id) }}" class="anime-title">
                    {{ Str::limit($anime->title, 28) }}
                </a>
                <div class="anime-tags">
                    <span class="anime-tag">{{ strtoupper($anime->type) }}</span>
                    <span class="anime-tag">{{ ucfirst($anime->status) }}</span>
                </div>
            </div>
            @if($anime->rating)
                <div class="anime-rating">
                    <div class="anime-rating-value">{{ $anime->rating }}</div>
                    <div class="anime-rating-label">Рейтинг</div>
                </div>
            @endif
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-emoji">🎬</div>
            <div class="empty-text">Аниме еще не добавлено</div>
            <a href="{{ route('admin.anime.create') }}" class="empty-link">Добавить аниме →</a>
        </div>
    @endforelse
</div>
</div>

<div class="action-bar">
<div class="action-text">
<h3>🚀 Быстрые действия</h3>
<p>Управляйте контентом эффективнее</p>
</div>
<div class="action-buttons">
<a href="{{ route('admin.anime.create') }}" class="action-btn">
<span>➕</span>
Новое аниме
</a>
<a href="{{ route('admin.import.index') }}" class="action-btn">
<span>📥</span>
Импорт
</a>
<a href="{{ route('admin.episodes.index') }}" class="action-btn">
<span>📺</span>
Эпизоды
</a>
</div>
</div>


@endsection
