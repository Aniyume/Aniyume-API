@extends('layouts.admin')

@section('title', 'Episodes Management - AniYume Admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500 bg-clip-text text-transparent">📺 Episodes Management</h1>
        <p class="text-gray-500 mt-2">Manage and import anime episodes</p>
    </div>
    <button onclick="document.getElementById('bulk-import-modal').classList.remove('hidden')" 
            class="bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white px-6 py-3 rounded-lg font-bold transition shadow-lg">
        📥 Bulk Import Episodes
    </button>
</div>

@if($anime)
<div class="bg-gradient-to-r from-cyan-50 to-teal-50 rounded-xl shadow-lg border-l-4 border-cyan-500 p-8 mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-cyan-900 mb-2">{{ $anime->title }}</h2>
            <div class="flex gap-4 text-sm">
                <span class="px-3 py-1 bg-cyan-200 text-cyan-800 rounded-full font-bold">📺 {{ $episodes->total() }} Episodes</span>
                <span class="px-3 py-1 bg-teal-200 text-teal-800 rounded-full font-bold">{{ strtoupper($anime->type) }}</span>
                <span class="px-3 py-1 bg-blue-200 text-blue-800 rounded-full font-bold capitalize">{{ $anime->status }}</span>
            </div>
        </div>
        <form action="{{ route('admin.episodes.import', $anime->id) }}" method="POST" class="flex gap-2">
            @csrf
            <select name="import_type" class="px-4 py-2 border-2 border-cyan-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="initial">🆕 New Episodes Only</option>
                <option value="update">🔄 Update All Episodes</option>
            </select>
            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-2 rounded-lg font-bold transition shadow-lg"
                    onclick="return confirm('⚠️ Import episodes for \"{{ $anime->title }}\"?\n\nThis will fetch episodes from AniList API.')">
                ✨ Import Episodes for This Anime
            </button>
        </form>
    </div>
</div>
@endif

<div class="bg-white rounded-xl shadow-lg p-8 mb-8 border-t-4 border-cyan-500">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">🔍 Smart Search & Filter</h2>
    <form method="GET" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-bold text-cyan-700 mb-2">🎬 Anime Title</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search anime title..." 
                           class="w-full px-4 py-2 border-2 border-cyan-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
                           id="anime-search">
                    <div id="search-suggestions" class="hidden absolute top-full left-0 right-0 bg-white border-2 border-cyan-200 rounded-lg mt-1 shadow-lg max-h-48 overflow-y-auto z-10"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">💡 Type to see matching anime</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-teal-700 mb-2">🎯 Episode Number</label>
                <input type="number" name="episode" value="{{ request('episode') }}" 
                       placeholder="e.g., 1, 12, 24" min="1"
                       class="w-full px-4 py-2 border-2 border-teal-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-blue-700 mb-2">📊 Status</label>
                <select name="status" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">All Episodes</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>✅ Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>📦 Archived</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-purple-700 mb-2">📅 Sort By</label>
                <select name="sort" class="w-full px-4 py-2 border-2 border-purple-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    <option value="episode_number" {{ request('sort') === 'episode_number' ? 'selected' : '' }}>Episode Number</option>
                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Recently Added</option>
                    <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title A-Z</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white px-4 py-2 rounded-lg font-bold transition shadow-lg">
                    🔎 Search
                </button>
            </div>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-teal-500">
    <div class="bg-gradient-to-r from-teal-50 to-cyan-50 px-8 py-4 border-b-2 border-teal-200">
        <h3 class="text-lg font-bold text-teal-900">📺 Episodes List</h3>
        <p class="text-sm text-teal-700">Total: <span class="font-bold">{{ $episodes->total() }}</span> episodes</p>
    </div>
    
    @if($episodes->count() > 0)
    <table class="w-full">
        <thead class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
            <tr>
                <th class="px-6 py-4 text-left font-bold">#</th>
                <th class="px-6 py-4 text-left font-bold">🎬 Anime</th>
                <th class="px-6 py-4 text-left font-bold">📺 Episode</th>
                <th class="px-6 py-4 text-left font-bold">📝 Title</th>
                <th class="px-6 py-4 text-left font-bold">⏱️ Duration</th>
                <th class="px-6 py-4 text-left font-bold">📊 Status</th>
                <th class="px-6 py-4 text-center font-bold">⚙️ Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($episodes as $index => $episode)
            <tr class="hover:bg-cyan-50 transition">
                <td class="px-6 py-4 font-bold text-cyan-600">{{ $episodes->firstItem() + $index }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.anime.show', $episode->anime_id) }}" 
                       class="text-cyan-600 hover:text-cyan-800 font-bold hover:underline">
                        {{ Str::limit($episode->anime->title, 20) }}
                    </a>
                </td>
                <td class="px-6 py-4 font-bold text-2xl text-teal-600">{{ $episode->episode_number }}</td>
                <td class="px-6 py-4 text-gray-800">{{ Str::limit($episode->title ?? 'N/A', 25) }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $episode->duration ?? '-' }} min</td>
                <td class="px-6 py-4">
                    @php
                        $statusBg = match($episode->status) {
                            'published' => 'bg-green-100 text-green-800',
                            'draft' => 'bg-yellow-100 text-yellow-800',
                            'archived' => 'bg-gray-100 text-gray-800',
                            default => 'bg-blue-100 text-blue-800'
                        };
                        $statusEmoji = match($episode->status) {
                            'published' => '✅',
                            'draft' => '📝',
                            'archived' => '📦',
                            default => '❓'
                        };
                    @endphp
                    <span class="px-3 py-1 {{ $statusBg }} rounded-full text-xs font-bold">{{ $statusEmoji }} {{ $episode->status }}</span>
                </td>
                <td class="px-6 py-4 text-center space-x-2">
                    @if($episode->player_url)
                        <a href="{{ $episode->player_url }}" target="_blank" 
                           class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm font-bold transition" title="Watch Episode">
                            ▶️
                        </a>
                    @endif
                    <a href="{{ route('admin.episodes.edit', $episode->id) }}" 
                       class="inline-block bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-1 rounded text-sm font-bold transition" title="Edit">
                        ✏️
                    </a>
                    <form action="{{ route('admin.episodes.destroy', $episode->id) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('🗑️ Delete episode {{ $episode->episode_number }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-bold transition">
                            🗑️
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="p-12 text-center">
        <span class="text-6xl mb-4">📺</span>
        <p class="text-gray-600 text-lg mb-4">No episodes found matching your criteria</p>
        <p class="text-gray-500 text-sm mb-6">Try adjusting your search filters</p>
        @if($anime)
        <form action="{{ route('admin.episodes.import', $anime->id) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white px-6 py-3 rounded-lg font-bold hover:shadow-lg transition">
                📥 Import Episodes Now
            </button>
        </form>
        @endif
    </div>
    @endif
</div>

<div class="mt-8">
    {{ $episodes->links('pagination::tailwind') }}
</div>

<div id="bulk-import-modal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-96 border-t-4 border-cyan-500">
        <h3 class="text-2xl font-bold mb-6 text-cyan-900">📥 Bulk Import Episodes</h3>
        
        <form action="{{ route('admin.episodes.bulk-import') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-3">🎯 Select Anime</label>
                <select name="anime_id" required class="w-full px-4 py-2 border-2 border-cyan-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    <option value="">-- Choose an anime --</option>
                    @foreach($animes ?? [] as $a)
                    <option value="{{ $a->id }}">{{ $a->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-3">📊 Import Type</label>
                <select name="import_type" required class="w-full px-4 py-2 border-2 border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <option value="initial">🆕 New Episodes Only</option>
                    <option value="update">🔄 Update All Episodes</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('bulk-import-modal').classList.add('hidden')" 
                        class="flex-1 px-4 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg font-bold transition">
                    ❌ Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white rounded-lg font-bold transition shadow-lg">
                    ✅ Start Import
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const animeSearch = document.getElementById('anime-search');
const suggestions = document.getElementById('search-suggestions');

if (animeSearch) {
    animeSearch.addEventListener('input', async (e) => {
        const query = e.target.value.trim();
        if (query.length < 2) {
            suggestions.classList.add('hidden');
            return;
        }
        
        try {
            const response = await fetch(`/api/v1/admin/anime?search=${encodeURIComponent(query)}&per_page=5`);
            const data = await response.json();
            
            if (data.data && data.data.length > 0) {
                suggestions.innerHTML = data.data.map(anime => 
                    `<div class="px-4 py-2 hover:bg-cyan-100 cursor-pointer border-b" onclick="document.getElementById('anime-search').value='${anime.title}'; document.querySelector('form').submit();">🎬 ${anime.title}</div>`
                ).join('');
                suggestions.classList.remove('hidden');
            } else {
                suggestions.innerHTML = '<div class="px-4 py-2 text-gray-500">No anime found</div>';
                suggestions.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Search error:', error);
        }
    });
}
</script>
@endsection
