@extends('layouts.admin')

@section('title', 'Import Management - AniYume Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500 bg-clip-text text-transparent">📥 Import Management</h1>
    <p class="text-gray-500 mt-2">Manage anime and episode imports from AniList</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-cyan-50 to-teal-50 rounded-xl shadow-lg border-l-4 border-cyan-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">📥 Total Imports</div>
                <div class="text-4xl font-bold text-cyan-600">{{ $stats['total_imports'] }}</div>
                <div class="text-cyan-500 text-xs mt-2">All time</div>
            </div>
            <span class="text-4xl">📥</span>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-lg border-l-4 border-green-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">✅ Successful</div>
                <div class="text-4xl font-bold text-green-600">{{ $stats['successful_imports'] }}</div>
                <div class="text-green-500 text-xs mt-2">Completed</div>
            </div>
            <span class="text-4xl">✅</span>
        </div>
    </div>

    <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-xl shadow-lg border-l-4 border-red-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">❌ Failed</div>
                <div class="text-4xl font-bold text-red-600">{{ $stats['failed_imports'] }}</div>
                <div class="text-red-500 text-xs mt-2">With errors</div>
            </div>
            <span class="text-4xl">❌</span>
        </div>
    </div>

    <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl shadow-lg border-l-4 border-yellow-500 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-gray-600 text-sm font-medium mb-1">⏳ Running</div>
                <div class="text-4xl font-bold text-yellow-600">{{ $stats['running_imports'] }}</div>
                <div class="text-yellow-500 text-xs mt-2">In progress</div>
            </div>
            <span class="text-4xl">⏳</span>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg p-8 mb-8 border-t-4 border-cyan-500">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">🚀 Start New Import</h2>
    
    <form action="{{ route('admin.import.run') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-cyan-700 mb-3">📊 Import Type</label>
                <select name="type" required class="w-full px-4 py-3 border-2 border-cyan-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition">
                    <option value="initial">🆕 Initial Import (New anime only, skip existing)</option>
                    <option value="update">🔄 Update Import (Refresh all anime data)</option>
                </select>
                <p class="mt-3 text-sm text-gray-600">
                    <strong>🆕 Initial:</strong> Fetches only new anime from AniList<br>
                    <strong>🔄 Update:</strong> Refreshes data for all existing anime
                </p>
            </div>

            <div>
                <label class="block text-sm font-bold text-teal-700 mb-3">📝 Description (optional)</label>
                <input type="text" name="description" placeholder="e.g., Weekly update, Monthly refresh..."
                       class="w-full px-4 py-3 border-2 border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition">
            </div>
        </div>

        <div class="bg-gradient-to-r from-cyan-50 to-teal-50 border-2 border-dashed border-cyan-300 rounded-lg p-6">
            <div class="flex gap-3">
                <span class="text-2xl">⚠️</span>
                <div class="text-sm text-gray-700">
                    <p class="font-bold mb-1">Before starting import:</p>
                    <ul class="list-disc list-inside space-y-1 text-gray-600">
                        <li>Make sure your Laravel queue worker is running: <code class="bg-gray-200 px-2 py-1 rounded">php artisan queue:work</code></li>
                        <li>This process may take several minutes depending on data volume</li>
                        <li>You can check progress in the "Latest Import Status" section below</li>
                    </ul>
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white px-8 py-3 rounded-lg font-bold transition shadow-lg text-lg"
                    onclick="return confirm('🚀 Start import?\n\n⚠️ Make sure queue worker is running!\nphp artisan queue:work');">
                ✅ Start Import Process
            </button>
        </div>
    </form>
</div>

@if($latestImport)
<div class="bg-white rounded-xl shadow-lg p-8 mb-8 border-t-4 border-teal-500">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">📊 Latest Import Status</h2>
    
    @php
        $statusBg = match($latestImport->status) {
            'completed' => 'from-green-100 to-emerald-100 text-green-900 border-green-300',
            'failed' => 'from-red-100 to-rose-100 text-red-900 border-red-300',
            'running' => 'from-yellow-100 to-amber-100 text-yellow-900 border-yellow-300',
            default => 'from-gray-100 to-slate-100 text-gray-900 border-gray-300'
        };
        $statusEmoji = match($latestImport->status) {
            'completed' => '✅',
            'failed' => '❌',
            'running' => '⏳',
            default => 'ℹ️'
        };
        $progressPercent = 0;
        if ($latestImport->total_processed > 0) {
            $progressPercent = round(($latestImport->total_created + $latestImport->total_updated + $latestImport->total_skipped) / $latestImport->total_processed * 100);
        }
    @endphp
    
    <div class="bg-gradient-to-r {{ $statusBg }} border-l-4 p-6 rounded-lg mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <div class="text-3xl font-bold mb-2">{{ $statusEmoji }} {{ ucfirst($latestImport->status) }}</div>
                <div class="text-sm opacity-75 capitalize">{{ $latestImport->import_type }} Import</div>
            </div>
            <a href="{{ route('admin.import.logs') }}" class="text-sm font-bold underline hover:no-underline">View Full Logs →</a>
        </div>
        
        @if($latestImport->status === 'running')
        <div class="mb-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-bold">Progress</span>
                <span class="text-sm font-bold">{{ $progressPercent }}%</span>
            </div>
            <div class="w-full bg-white bg-opacity-30 rounded-full h-4 overflow-hidden">
                <div class="bg-white h-full rounded-full transition-all" style="width: {{ $progressPercent }}%"></div>
            </div>
        </div>
        @endif
        
        <div class="grid grid-cols-4 gap-3 text-sm">
            <div>
                <div class="opacity-75">Processed</div>
                <div class="text-2xl font-bold">{{ number_format($latestImport->total_processed) }}</div>
            </div>
            <div>
                <div class="opacity-75">✅ Created</div>
                <div class="text-2xl font-bold text-green-600">{{ number_format($latestImport->total_created) }}</div>
            </div>
            <div>
                <div class="opacity-75">🔄 Updated</div>
                <div class="text-2xl font-bold text-blue-600">{{ number_format($latestImport->total_updated) }}</div>
            </div>
            <div>
                <div class="opacity-75">⏭️ Skipped</div>
                <div class="text-2xl font-bold text-orange-600">{{ number_format($latestImport->total_skipped) }}</div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
        <div class="bg-cyan-50 border-2 border-cyan-200 rounded-lg p-4">
            <div class="text-gray-600 mb-1">📅 Started</div>
            <div class="font-bold text-cyan-900">{{ $latestImport->started_at->format('M d, H:i') }}</div>
            <div class="text-xs text-cyan-700 mt-1">{{ $latestImport->started_at->diffForHumans() }}</div>
        </div>
        
        @if($latestImport->finished_at)
        <div class="bg-teal-50 border-2 border-teal-200 rounded-lg p-4">
            <div class="text-gray-600 mb-1">⏹️ Finished</div>
            <div class="font-bold text-teal-900">{{ $latestImport->finished_at->format('M d, H:i') }}</div>
            <div class="text-xs text-teal-700 mt-1">{{ $latestImport->finished_at->diffForHumans() }}</div>
        </div>
        
        <div class="bg-purple-50 border-2 border-purple-200 rounded-lg p-4">
            <div class="text-gray-600 mb-1">⏱️ Duration</div>
            <div class="font-bold text-purple-900">{{ $latestImport->started_at->diffInMinutes($latestImport->finished_at) }}m {{ $latestImport->started_at->diff($latestImport->finished_at)->format('%s') }}s</div>
            <div class="text-xs text-purple-700 mt-1">Execution time</div>
        </div>
        
        <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
            <div class="text-gray-600 mb-1">⚡ Speed</div>
            <div class="font-bold text-blue-900">{{ $latestImport->total_processed > 0 ? round($latestImport->total_processed / max(1, $latestImport->started_at->diffInSeconds($latestImport->finished_at)), 1) : 0 }} items/sec</div>
            <div class="text-xs text-blue-700 mt-1">Throughput</div>
        </div>
        @endif
    </div>
    
    @if($latestImport->errors)
    <div class="mt-6 bg-red-50 border-2 border-red-200 rounded-lg p-4">
        <div class="text-red-900 font-bold mb-2">⚠️ Errors</div>
        <pre class="text-red-800 text-xs bg-white p-3 rounded overflow-x-auto">{{ $latestImport->errors }}</pre>
    </div>
    @endif
</div>
@endif

<div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-blue-500">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">📜 Import History (Last 5)</h2>
        <a href="{{ route('admin.import.logs') }}" class="text-blue-600 hover:text-blue-800 font-bold">View All Logs →</a>
    </div>
    
    <p class="text-gray-600 text-center py-6">
        📊 Detailed import history and logs available on the <a href="{{ route('admin.import.logs') }}" class="text-blue-600 hover:underline">Import Logs page</a>
    </p>
</div>

@endsection
