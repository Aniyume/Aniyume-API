@extends('layouts.admin')
@section('title', 'Управление аниме - АниЮм Админ')
@section('content')
<style>
.page-header {
display: flex;
justify-content: space-between;
align-items: center;
margin-bottom: 32px;
gap: 20px;
flex-wrap: wrap;
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

.btn-create {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
color: #0a0a1a;
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

.btn-create:hover {
box-shadow: 0 12px 30px rgba(0, 255, 200, 0.3);
transform: translateY(-2px);
}

.btn-create:active {
transform: translateY(0);
}

.filter-card {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
border: 1.5px solid rgba(0, 255, 200, 0.2);
border-radius: 16px;
padding: 24px;
backdrop-filter: blur(10px);
margin-bottom: 24px;
}

.filter-grid {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
gap: 16px;
}

.filter-group {
display: flex;
flex-direction: column;
}

.filter-label {
color: #b0e0ff;
font-weight: 600;
font-size: 13px;
text-transform: uppercase;
letter-spacing: 1px;
margin-bottom: 8px;
}

.filter-input,
.filter-select {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
border: 1px solid rgba(0, 255, 200, 0.2);
color: #e0e0e0;
border-radius: 10px;
padding: 12px 14px;
transition: all 0.3s ease;
font-family: 'Onest', sans-serif;
font-size: 14px;
}

.filter-input::placeholder {
color: rgba(224, 224, 224, 0.4);
}

.filter-input:focus,
.filter-select:focus {
outline: none;
background: linear-gradient(135deg, rgba(0, 255, 200, 0.12), rgba(0, 200, 255, 0.08));
border-color: #00ffc8;
box-shadow: 0 0 20px rgba(0, 255, 200, 0.3), inset 0 0 10px rgba(0, 255, 200, 0.08);
}

.filter-button {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
color: #0a0a1a;
border: none;
border-radius: 10px;
padding: 12px 20px;
font-weight: 700;
cursor: pointer;
transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
align-self: flex-end;
font-size: 14px;
}

.filter-button:hover {
box-shadow: 0 12px 30px rgba(0, 255, 200, 0.3);
transform: translateY(-2px);
}

.table-container {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.08), rgba(0, 200, 255, 0.05));
border: 1.5px solid rgba(0, 255, 200, 0.2);
border-radius: 16px;
overflow: hidden;
backdrop-filter: blur(10px);
}

table {
width: 100%;
border-collapse: collapse;
}

thead {
background: linear-gradient(90deg, #0f1419, #1a2535);
}

th {
color: #00ffc8;
padding: 16px;
text-align: left;
font-weight: 700;
font-size: 12px;
text-transform: uppercase;
letter-spacing: 1px;
border-bottom: 1.5px solid rgba(0, 255, 200, 0.25);
}

th:last-child {
text-align: right;
}

tbody tr {
border-bottom: 1px solid rgba(0, 255, 200, 0.1);
transition: all 0.3s ease;
}

tbody tr:hover {
background: rgba(0, 255, 200, 0.08);
}

tbody tr:last-child {
border-bottom: none;
}

td {
padding: 16px;
color: #d0e8ff;
font-size: 14px;
}

.anime-cell {
display: flex;
align-items: center;
gap: 12px;
}

.anime-poster {
width: 50px;
height: 70px;
border-radius: 8px;
object-fit: cover;
border: 1px solid rgba(0, 255, 200, 0.2);
flex-shrink: 0;
box-shadow: 0 4px 12px rgba(0, 255, 200, 0.1);
}

.anime-title-link {
color: #00ffc8;
font-weight: 700;
text-decoration: none;
transition: all 0.3s ease;
display: flex;
flex-direction: column;
gap: 6px;
}

.anime-title-link:hover {
color: #00ffc8;
text-decoration: underline;
}

.nsfw-badge {
display: inline-block;
background: linear-gradient(135deg, rgba(255, 100, 100, 0.2), rgba(255, 80, 80, 0.15));
color: #ff9fa0;
padding: 4px 10px;
border-radius: 6px;
font-size: 11px;
font-weight: 700;
text-transform: uppercase;
border: 1px solid rgba(255, 100, 100, 0.3);
letter-spacing: 0.5px;
}

.type-badge {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
color: #00ffc8;
padding: 6px 12px;
border-radius: 6px;
font-size: 11px;
font-weight: 700;
text-transform: uppercase;
border: 1px solid rgba(0, 255, 200, 0.2);
letter-spacing: 0.5px;
display: inline-block;
width: fit-content;
}

.status-badge {
padding: 6px 12px;
border-radius: 6px;
font-size: 11px;
font-weight: 700;
text-transform: uppercase;
border: 1px solid;
letter-spacing: 0.5px;
display: inline-block;
width: fit-content;
}

.status-planned {
background: linear-gradient(135deg, rgba(100, 150, 255, 0.15), rgba(100, 180, 255, 0.1));
color: #a0c8ff;
border-color: rgba(100, 150, 255, 0.3);
}

.status-ongoing {
background: linear-gradient(135deg, rgba(255, 200, 100, 0.15), rgba(255, 180, 80, 0.1));
color: #ffc878;
border-color: rgba(255, 200, 100, 0.3);
}

.status-finished {
background: linear-gradient(135deg, rgba(0, 255, 200, 0.15), rgba(0, 200, 255, 0.1));
color: #00ffc8;
border-color: rgba(0, 255, 200, 0.3);
}

.status-paused {
background: linear-gradient(135deg, rgba(150, 100, 150, 0.15), rgba(150, 100, 180, 0.1));
color: #d0a8ff;
border-color: rgba(150, 100, 150, 0.3);
}

.rating-cell {
font-weight: 700;
background: linear-gradient(135deg, #ffc857, #ffaa00);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
font-size: 15px;
}

.actions-cell {
text-align: right;
}

.action-link {
display: inline-flex;
align-items: center;
gap: 4px;
color: #00ffc8;
text-decoration: none;
font-weight: 600;
transition: all 0.3s ease;
margin-left: 16px;
font-size: 13px;
}

.action-link:first-child {
margin-left: 0;
}

.action-link:hover {
color: #00ffc8;
text-decoration: underline;
}

.action-delete {
color: #ff9fa0;
}

.action-delete:hover {
color: #ff6464;
}

.empty-state {
padding: 60px 20px;
text-align: center;
color: #b0e0ff;
}

.empty-emoji {
font-size: 56px;
margin-bottom: 16px;
display: block;
}

.empty-text {
font-size: 16px;
margin-bottom: 20px;
}

.pagination-container {
display: flex;
justify-content: center;
margin-top: 32px;
}

.pagination {
display: flex;
gap: 8px;
align-items: center;
flex-wrap: wrap;
justify-content: center;
}

.pagination a,
.pagination span {
padding: 10px 12px;
border-radius: 8px;
border: 1px solid rgba(0, 255, 200, 0.2);
color: #b0e0ff;
text-decoration: none;
transition: all 0.3s ease;
font-size: 13px;
font-weight: 600;
}

.pagination a:hover {
border-color: rgba(0, 255, 200, 0.4);
background: rgba(0, 255, 200, 0.1);
color: #00ffc8;
}

.pagination .active span {
background: linear-gradient(135deg, #00ffc8, #00c8ff);
color: #0a0a1a;
border-color: rgba(0, 255, 200, 0.4);
font-weight: 700;
}

.pagination .disabled span {
opacity: 0.5;
cursor: not-allowed;
}

@media (max-width: 768px) {
.page-header {
flex-direction: column;
align-items: flex-start;
}

.btn-create {
width: 100%;
justify-content: center;
}

.filter-grid {
grid-template-columns: 1fr;
}

.filter-button {
width: 100%;
align-self: stretch;
}

.table-container {
overflow-x: auto;
}

table {
min-width: 900px;
}

td, th {
padding: 12px;
font-size: 12px;
}

.anime-poster {
width: 40px;
height: 55px;
}

.actions-cell {
white-space: nowrap;
}

.action-link {
margin-left: 8px;
font-size: 12px;
}
}
</style>
<div class="page-header">
<h1 class="page-title">📺 Управление аниме</h1>
<a href="{{ route('admin.anime.create') }}" class="btn-create">
<span>➕</span>
Добавить аниме
</a>
</div>
<div class="filter-card">
<form method="GET" class="filter-grid">
<div class="filter-group">
<label class="filter-label">Поиск по названию</label>
<input type="text" name="search" value="{{ request('search') }}"
placeholder="Введите название аниме..." class="filter-input">
</div>

<div class="filter-group">
        <label class="filter-label">Статус</label>
        <select name="status" class="filter-select">
            <option value="">Все статусы</option>
            <option value="planned" {{ request('status') === 'planned' ? 'selected' : '' }}>Планируется</option>
            <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Выходит</option>
            <option value="finished" {{ request('status') === 'finished' ? 'selected' : '' }}>Завершено</option>
            <option value="paused" {{ request('status') === 'paused' ? 'selected' : '' }}>На паузе</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Тип</label>
        <select name="type" class="filter-select">
            <option value="">Все типы</option>
            <option value="tv" {{ request('type') === 'tv' ? 'selected' : '' }}>ТВ</option>
            <option value="movie" {{ request('type') === 'movie' ? 'selected' : '' }}>Фильм</option>
            <option value="ova" {{ request('type') === 'ova' ? 'selected' : '' }}>OVA</option>
            <option value="ona" {{ request('type') === 'ona' ? 'selected' : '' }}>ONA</option>
            <option value="special" {{ request('type') === 'special' ? 'selected' : '' }}>Спецвыпуск</option>
            <option value="music" {{ request('type') === 'music' ? 'selected' : '' }}>Музыка</option>
        </select>
    </div>

    <div class="filter-group">
        <button type="submit" class="filter-button">
            🔍 Фильтровать
        </button>
    </div>
</form>
</div>
<div class="table-container">
<table>
<thead>
<tr>
<th style="width: 35%;">Название</th>
<th style="width: 10%;">Тип</th>
<th style="width: 12%;">Статус</th>
<th style="width: 8%;">Год</th>
<th style="width: 8%;">Рейтинг</th>
<th style="width: 12%;">Источник</th>
<th style="width: 15%;">Действия</th>
</tr>
</thead>
<tbody>
@forelse($anime as $item)
<tr>
<td>
<div class="anime-cell">
@if($item->poster_url)
<img src="{{ $item->poster_url }}" alt="{{ $item->title }}" class="anime-poster" loading="lazy">
@else
<div style="width: 50px; height: 70px; background: rgba(0, 255, 200, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
🎬
</div>
@endif
<div>
<a href="{{ route('admin.anime.show', $item->id) }}" class="anime-title-link">
{{ Str::limit($item->title, 30) }}
</a>
@if($item->nsfw_flag)
<span class="nsfw-badge">🔞 NSFW</span>
@endif
</div>
</div>
</td>
<td>
<span class="type-badge">{{ strtoupper($item->type) }}</span>
</td>
<td>
<span class="status-badge status-{{ $item->status }}">
@switch($item->status)
@case('planned')
📅 Планируется
@break
@case('ongoing')
🎯 Выходит
@break
@case('finished')
✅ Завершено
@break
@case('paused')
⏸️ На паузе
@break
@default
{{ ucfirst($item->status) }}
@endswitch
</span>
</td>
<td>{{ $item->year ?? '—' }}</td>
<td>
@if($item->rating)
<span class="rating-cell">{{ number_format($item->rating, 1) }}</span>
@else
<span style="color: rgba(176, 224, 255, 0.5);">—</span>
@endif
</td>
<td>{{ $item->external_source ?? '—' }}</td>
<td class="actions-cell">
<a href="{{ route('admin.anime.edit', $item->id) }}" class="action-link">
✏️ Редактировать
</a>
<form action="{{ route('admin.anime.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Вы уверены? Это действие нельзя отменить.')">
@csrf
@method('DELETE')
<button type="submit" class="action-link action-delete" style="background: none; border: none; cursor: pointer; padding: 0; margin-left: 16px;">
🗑️ Удалить
</button>
</form>
</td>
</tr>
@empty
<tr>
<td colspan="7">
<div class="empty-state">
<span class="empty-emoji">🔍</span>
<div class="empty-text">Аниме не найдено</div>
<a href="{{ route('admin.anime.create') }}" class="btn-create">
<span>➕</span>
Добавить первое аниме
</a>
</div>
</td>
</tr>
@endforelse
</tbody>
</table>
</div>
@if($anime->count() > 0)
<div class="pagination-container">
{{ $anime->links() }}
</div>
@endif
@endsection
