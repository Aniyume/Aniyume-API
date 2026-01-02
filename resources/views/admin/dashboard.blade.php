@extends('layouts.admin')
@section('page_title', 'Обзор системы')
@section('content')
<style>
@keyframes fadeInUp {
from { opacity: 0; transform: translateY(20px); }
to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
from { opacity: 0; transform: scale(0.9); }
to { opacity: 1; transform: scale(1); }
}

.stats-grid {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
gap: 1.5rem;
margin-bottom: 2.5rem;
}

.stat-card {
background: #ffffff;
border: 1px solid #f0f2f5;
border-radius: 1.25rem;
padding: 1.5rem;
box-shadow: 0 2px 12px rgba(0,0,0,0.02);
transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
animation: fadeInUp 0.5s ease forwards;
opacity: 0;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }

.stat-card:hover {
box-shadow: 0 10px 25px rgba(0,0,0,0.06);
transform: translateY(-5px);
}

.stat-card.cyan { border-left: 4px solid #00f2ea; }
.stat-card.blue { border-left: 4px solid #0ea5e9; }
.stat-card.purple { border-left: 4px solid #8b5cf6; }
.stat-card.green { border-left: 4px solid #16a34a; }

.stat-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }

.stat-icon {
width: 48px;
height: 48px;
background: #f0fdfa;
border-radius: 0.75rem;
display: flex;
align-items: center;
justify-content: center;
color: #00f2ea;
font-size: 1.5rem;
transition: transform 0.3s ease;
}

.stat-card:hover .stat-icon { transform: rotate(10deg) scale(1.1); }

.stat-badge { background: #f0fdf4; color: #16a34a; padding: 0.25rem 0.5rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; }
.stat-label { color: #6f767e; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
.stat-value { color: #1a1d1f; font-size: 2rem; font-weight: 800; }

.content-grid {
display: grid;
grid-template-columns: repeat(2, 1fr);
gap: 2rem;
animation: fadeInUp 0.6s ease 0.3s forwards;
opacity: 0;
}

.content-card {
background: #ffffff;
border: 1px solid #f0f2f5;
border-radius: 1.25rem;
padding: 2rem;
box-shadow: 0 2px 12px rgba(0,0,0,0.02);
}

.content-title { color: #1a1d1f; font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }

.anime-list, .import-list { display: flex; flex-direction: column; gap: 1rem; }

.anime-item, .import-item {
display: flex;
align-items: center;
justify-content: space-between;
background: #fcfdfe;
border: 1px solid #f0f2f5;
border-radius: 0.75rem;
padding: 1rem;
transition: all 0.2s ease;
}

.anime-item:hover {
background: #ffffff;
border-color: #00f2ea;
transform: translateX(5px);
box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.anime-content { display: flex; align-items: center; gap: 1rem; flex: 1; }
.anime-poster { width: 48px; height: 64px; border-radius: 0.5rem; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
.anime-info { flex: 1; }
.anime-title { color: #1a1d1f; font-weight: 700; font-size: 0.9rem; margin-bottom: 0.25rem; }
.anime-meta { color: #6f767e; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
.anime-rating { color: #00f2ea; font-size: 0.9rem; font-weight: 800; }

.import-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; }
.import-type { color: #6f767e; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
.import-status { padding: 0.25rem 0.5rem; border-radius: 0.5rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; }
.import-status.completed { background: #f0fdf4; color: #16a34a; }
.import-status.running { background: #fffbeb; color: #d97706; animation: pulse 2s infinite; }

@keyframes pulse {
0% { opacity: 1; }
50% { opacity: 0.6; }
100% { opacity: 1; }
}

.import-body { display: flex; justify-content: space-between; align-items: flex-end; }
.import-processed { color: #1a1d1f; font-size: 0.9rem; font-weight: 700; }
.import-date { color: #6f767e; font-size: 0.75rem; }
.import-stats { display: flex; gap: 0.5rem; }
.import-stat { font-size: 0.7rem; font-weight: 700; }
.import-stat.created { color: #16a34a; }
.import-stat.updated { color: #0ea5e9; }

@media (max-width: 1024px) {
.stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
.content-grid { grid-template-columns: 1fr; gap: 1.5rem; }
}

@media (max-width: 640px) {
.stats-grid { grid-template-columns: 1fr; }
.content-card { padding: 1.25rem; }
.stat-value { font-size: 1.5rem; }
.anime-item { padding: 0.75rem; }
.anime-poster { width: 40px; height: 54px; }
}
</style>
<div class="stats-grid">
<div class="stat-card cyan">
<div class="stat-header">
<div class="stat-icon">🎬</div>
<span class="stat-badge">+12%</span>
</div>
<div class="stat-label">Всего аниме</div>
<div class="stat-value">{{ number_format($total_anime) }}</div>
</div>

<div class="stat-card blue">
    <div class="stat-header">
        <div class="stat-icon" style="background: #eff6ff; color: #0ea5e9;">▶️</div>
    </div>
    <div class="stat-label">Эпизодов</div>
    <div class="stat-value">{{ number_format($total_episodes) }}</div>
</div>

<div class="stat-card purple">
    <div class="stat-header">
        <div class="stat-icon" style="background: #f5f3ff; color: #8b5cf6;">👥</div>
    </div>
    <div class="stat-label">Пользователей</div>
    <div class="stat-value">{{ number_format($total_users) }}</div>
</div>

<div class="stat-card green">
    <div class="stat-header">
        <div class="stat-icon" style="background: #f0fdf4; color: #16a34a;">🏷️</div>
    </div>
    <div class="stat-label">Тегов</div>
    <div class="stat-value">{{ number_format($total_tags) }}</div>
</div>
</div>
<div class="content-grid">
<div class="content-card">
<h4 class="content-title">📈 Последние аниме</h4>
<div class="anime-list">
@foreach($latest_anime as $anime)
<div class="anime-item">
<div class="anime-content">
<img src="{{ $anime->poster_url }}" class="anime-poster" alt="{{ $anime->title }}">
<div class="anime-info">
<div class="anime-title">{{ Str::limit($anime->title, 30) }}</div>
<div class="anime-meta">{{ $anime->type }} • {{ $anime->year }}</div>
</div>
</div>
<div class="anime-rating">{{ $anime->rating }}</div>
</div>
@endforeach
</div>
</div>
<div class="content-card">
    <h4 class="content-title">⏱ Логи импорта</h4>
    <div class="import-list">
        @foreach($recent_imports as $import)
        <div class="import-item">
            <div style="width: 100%">
                <div class="import-header">
                    <span class="import-type">{{ $import->import_type }}</span>
                    <span class="import-status {{ $import->status }}">
                        {{ $import->status === 'completed' ? 'Завершено' : 'Выполняется' }}
                    </span>
                </div>
                <div class="import-body">
                    <div class="import-info">
                        <div class="import-processed">Обработано: {{ $import->total_processed }}</div>
                        <div class="import-date">{{ $import->started_at->diffForHumans() }}</div>
                    </div>
                    <div class="import-stats">
                        <span class="import-stat created">+{{ $import->total_created }}</span>
                        <span class="import-stat updated">~{{ $import->total_updated }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
