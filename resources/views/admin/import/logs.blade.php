@extends('layouts.admin')

@section('title', 'Import Logs - AniYume Admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500 bg-clip-text text-transparent">📊 Import Logs</h1>
        <p class="text-gray-500 mt-2">Detailed history of all import operations</p>
    </div>
    <a href="{{ route('admin.import.index') }}" class="bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white px-6 py-3 rounded-lg font-bold transition shadow-lg">
        ⬅️ Back to Import
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-cyan-500">
    @if($logs->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
                <tr>
                    <th class="px-6 py-4 text-left font-bold">#</th>
                    <th class="px-6 py-4 text-left font-bold">📊 Type</th>
                    <th class="px-6 py-4 text-left font-bold">📊 Status</th>
                    <th class="px-6 py-4 text-center font-bold">🌀</th>
                    <th class="px-6 py-4 text-center font-bold">✅ Created</th>
                    <th class="px-6 py-4 text-center font-bold">🔄 Updated</th>
                    <th class="px-6 py-4 text-center font-bold">⏭️ Skipped</th>
                    <th class="px-6 py-4 text-left font-bold">📅 Started</th>
                    <th class="px-6 py-4 text-left font-bold">⏱️ Duration</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($logs as $index => $log)
                @php
                    $statusBg = match($log->status) {
                        'completed' => 'from-green-100 to-emerald-100 text-green-800 border-green-300',
                        'failed' => 'from-red-100 to-rose-100 text-red-800 border-red-300',
                        'running' => 'from-yellow-100 to-amber-100 text-yellow-800 border-yellow-300',
                        default => 'from-gray-100 to-slate-100 text-gray-800 border-gray-300'
                    };
                    $statusEmoji = match($log->status) {
                        'completed' => '✅',
                        'failed' => '❌',
                        'running' => '⏳',
                        default => 'ℹ️'
                    };
                @endphp
                <tr class="hover:bg-cyan-50 transition">
                    <td class="px-6 py-4 font-bold text-cyan-600">#{{ $log->id }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold capitalize">
                            {{ $log->import_type === 'initial' ? '🆕 New' : '🔄 Update' }} 
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-gradient-to-r {{ $statusBg }} rounded-full text-xs font-bold border-l-4">
                            {{ $statusEmoji }} {{ ucfirst($log->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-lg text-gray-700">
                        {{ number_format($log->total_processed) }}
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-lg text-green-600">
                        {{ number_format($log->total_created) }}
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-lg text-blue-600">
                        {{ number_format($log->total_updated) }}
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-lg text-orange-600">
                        {{ number_format($log->total_skipped) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <div class="font-bold">{{ $log->started_at->format('M d') }}</div>
                        <div class="text-gray-500">{{ $log->started_at->format('H:i:s') }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold">
                        @if($log->finished_at)
                            <div class="text-teal-600">{{ $log->started_at->diffInMinutes($log->finished_at) }}m {{ $log->started_at->diff($log->finished_at)->format('%s') }}s</div>
                            <div class="text-gray-500 text-xs">{{ $log->finished_at->diffForHumans() }}</div>
                        @else
                            <div class="text-yellow-600 animate-pulse">📋 In progress...</div>
                        @endif
                    </td>
                </tr>
                @if($log->errors)
                <tr class="bg-red-50 border-l-4 border-red-500">
                    <td colspan="9" class="px-6 py-4">
                        <div class="flex gap-3">
                            <span class="text-2xl">⚠️</span>
                            <div class="flex-1">
                                <div class="font-bold text-red-800 mb-2">Import Errors</div>
                                <div class="bg-white p-4 rounded border-2 border-red-300 overflow-x-auto">
                                    <pre class="text-red-700 text-xs font-mono">{{ $log->errors }}</pre>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 bg-gradient-to-r from-cyan-50 to-teal-50 border-t-2 border-cyan-200">
        {{ $logs->links('pagination::tailwind') }}
    </div>
    @else
    <div class="p-12 text-center">
        <span class="text-6xl mb-4">📊</span>
        <p class="text-gray-600 text-lg mb-4">No import logs found</p>
        <p class="text-gray-500 text-sm mb-6">Import history will appear here after you run your first import</p>
        <a href="{{ route('admin.import.index') }}" class="inline-block bg-gradient-to-r from-cyan-500 to-teal-500 text-white px-6 py-3 rounded-lg font-bold hover:shadow-lg transition">
            🚀 Start First Import
        </a>
    </div>
    @endif
</div>

<div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-gradient-to-br from-cyan-50 to-teal-50 rounded-xl shadow-lg border-l-4 border-cyan-500 p-6">
        <div class="text-gray-600 text-sm font-bold mb-2">📥 Total Imports</div>
        <div class="text-3xl font-bold text-cyan-600">{{ $logs->total() }}</div>
    </div>

    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-lg border-l-4 border-green-500 p-6">
        <div class="text-gray-600 text-sm font-bold mb-2">✅ Successful</div>
        <div class="text-3xl font-bold text-green-600">{{ $logs->where('status', 'completed')->count() }}</div>
    </div>

    <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-xl shadow-lg border-l-4 border-red-500 p-6">
        <div class="text-gray-600 text-sm font-bold mb-2">❌ Failed</div>
        <div class="text-3xl font-bold text-red-600">{{ $logs->where('status', 'failed')->count() }}</div>
    </div>

    <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl shadow-lg border-l-4 border-yellow-500 p-6">
        <div class="text-gray-600 text-sm font-bold mb-2">🔄 Success Rate</div>
        @php
            $completed = $logs->where('status', 'completed')->count();
            $total = $logs->count();
            $rate = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp
        <div class="text-3xl font-bold text-yellow-600">{{ $rate }}%</div>
    </div>
</div>
@endsection
