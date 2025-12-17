@extends('layouts.admin')

@section('title', 'Dashboard - AniYume Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500 bg-clip-text text-transparent">✨ Dashboard</h1>
    <p class="text-gray-500 mt-2">Welcome to AniYume Admin Panel</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-cyan-50 to-teal-50 rounded-xl shadow-lg border-l-4 border-cyan-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">Total Anime</div>
                <div class="text-4xl font-bold text-cyan-600">{{ number_format($total_anime) }}</div>
                <div class="text-cyan-500 text-xs mt-2">🎬 Content management</div>
            </div>
            <span class="text-4xl">🎬</span>
        </div>
    </div>

    <div class="bg-gradient-to-br from-teal-50 to-green-50 rounded-xl shadow-lg border-l-4 border-teal-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">Episodes</div>
                <div class="text-4xl font-bold text-teal-600">{{ number_format($total_episodes ?? 0) }}</div>
                <div class="text-teal-500 text-xs mt-2">📺 Total episodes</div>
            </div>
            <span class="text-4xl">📺</span>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl shadow-lg border-l-4 border-blue-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">Total Users</div>
                <div class="text-4xl font-bold text-blue-600">{{ number_format($total_users) }}</div>
                <div class="text-blue-500 text-xs mt-2">👥 Community members</div>
            </div>
            <span class="text-4xl">👥</span>
        </div>
    </div>

    <div class="bg-gradient-to-br from-violet-50 to-purple-50 rounded-xl shadow-lg border-l-4 border-violet-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">Tags</div>
                <div class="text-4xl font-bold text-violet-600">{{ number_format($total_tags) }}</div>
                <div class="text-violet-500 text-xs mt-2">🏷️ Content labels</div>
            </div>
            <span class="text-4xl">🏷️</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 border-t-4 border-cyan-500">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">📊 Anime Statistics</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $statuses = ['ongoing' => '🎯', 'planned' => '📅', 'finished' => '✅', 'paused' => '⏸️'];
            @endphp
            @foreach($statuses as $status => $emoji)
                @php $count = $anime_by_status[$status] ?? 0; @endphp
                <div class="bg-gradient-to-br from-cyan-50 to-teal-50 rounded-lg p-4 text-center border border-cyan-200">
                    <div class="text-3xl mb-2">{{ $emoji }}</div>
                    <div class="text-2xl font-bold text-cyan-600">{{ number_format($count) }}</div>
                    <div class="text-xs text-gray-600 capitalize mt-1">{{ $status }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-teal-500">
        <h2 class="text-xl font-bold mb-6 text-gray-800">📺 By Type</h2>
        <div class="space-y-3">
            @php
                $types = ['tv' => '📺', 'movie' => '🎞️', 'ova' => '📻', 'ona' => '💻', 'special' => '⭐'];
            @endphp
            @foreach($anime_by_type as $type => $count)
                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg border border-teal-200">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">{{ $types[$type] ?? '📽️' }}</span>
                        <span class="capitalize font-medium text-gray-700">{{ $type }}</span>
                    </div>
                    <span class="font-bold text-teal-600 text-lg">{{ number_format($count) }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-cyan-500">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">⬆️ Recent Imports</h2>
        <div class="space-y-3">
            @forelse($recent_imports as $import)
                @php
                    $statusBg = match($import->status) {
                        'completed' => 'from-green-100 to-emerald-100 text-green-700 border-green-300',
                        'failed' => 'from-red-100 to-rose-100 text-red-700 border-red-300',
                        'running' => 'from-yellow-100 to-amber-100 text-yellow-700 border-yellow-300',
                        default => 'from-gray-100 to-slate-100 text-gray-700 border-gray-300'
                    };
                    $statusEmoji = match($import->status) {
                        'completed' => '✅',
                        'failed' => '❌',
                        'running' => '⏳',
                        default => 'ℹ️'
                    };
                @endphp
                <div class="bg-gradient-to-r {{ $statusBg }} border-l-4 p-4 rounded-lg">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">{{ $statusEmoji }}</span>
                            <div>
                                <div class="font-bold capitalize">{{ $import->import_type }} Import</div>
                                <div class="text-sm opacity-75">{{ $import->started_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-white bg-opacity-60 rounded-full text-xs font-bold">{{ $import->status }}</span>
                    </div>
                    <div class="grid grid-cols-4 gap-2 text-sm">
                        <div class="text-center"><div class="text-lg font-bold">{{ number_format($import->total_processed) }}</div><div class="text-xs">Processed</div></div>
                        <div class="text-center"><div class="text-lg font-bold text-green-600">{{ number_format($import->total_created) }}</div><div class="text-xs">Created</div></div>
                        <div class="text-center"><div class="text-lg font-bold text-blue-600">{{ number_format($import->total_updated) }}</div><div class="text-xs">Updated</div></div>
                        <div class="text-center"><div class="text-lg font-bold text-orange-600">{{ number_format($import->total_skipped) }}</div><div class="text-xs">Skipped</div></div>
                    </div>
                </div>
            @empty
                <div class="bg-cyan-50 border-2 border-dashed border-cyan-300 rounded-lg p-6 text-center text-cyan-700">
                    <span class="text-4xl mb-2">📥</span>
                    <p>No imports yet. <a href="{{ route('admin.import.index') }}" class="font-bold hover:underline">Start one now!</a></p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-teal-500">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">🔥 Top Anime</h2>
        <div class="space-y-3">
            @forelse($latest_anime as $anime)
                <div class="flex items-start justify-between p-3 bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg border border-teal-200 hover:border-teal-400 transition">
                    <div class="flex-1">
                        <a href="{{ route('admin.anime.show', $anime->id) }}" class="font-bold text-teal-600 hover:text-teal-800 block">
                            {{ Str::limit($anime->title, 25) }}
                        </a>
                        <div class="flex gap-2 mt-1 text-xs">
                            <span class="px-2 py-1 bg-cyan-200 text-cyan-800 rounded">{{ strtoupper($anime->type) }}</span>
                            <span class="px-2 py-1 bg-teal-200 text-teal-800 rounded capitalize">{{ $anime->status }}</span>
                        </div>
                    </div>
                    <div class="text-right ml-2">
                        @if($anime->rating)
                            <div class="text-2xl font-bold text-amber-500">{{ $anime->rating }}</div>
                            <div class="text-xs text-gray-600">Rating</div>
                        @else
                            <div class="text-gray-400">-</div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-cyan-50 border-2 border-dashed border-cyan-300 rounded-lg p-6 text-center text-cyan-700">
                    <span class="text-4xl mb-2">🎬</span>
                    <p>No anime yet. <a href="{{ route('admin.anime.create') }}" class="font-bold hover:underline">Add one!</a></p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500 rounded-xl shadow-lg p-8 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold mb-2">🚀 Quick Actions</h3>
            <p class="opacity-90">Manage your content efficiently</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.anime.create') }}" class="bg-white text-cyan-600 hover:bg-cyan-50 px-4 py-2 rounded-lg font-bold transition">➕ New Anime</a>
            <a href="{{ route('admin.import.index') }}" class="bg-white text-cyan-600 hover:bg-cyan-50 px-4 py-2 rounded-lg font-bold transition">📥 Import</a>
            <a href="{{ route('admin.episodes.index') }}" class="bg-white text-cyan-600 hover:bg-cyan-50 px-4 py-2 rounded-lg font-bold transition">📺 Episodes</a>
        </div>
    </div>
</div>

@endsection
