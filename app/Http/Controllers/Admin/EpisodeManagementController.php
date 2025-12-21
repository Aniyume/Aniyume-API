<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ImportEpisodesJob;
use App\Models\Anime;
use App\Models\AuditLog;
use App\Models\Episode;
use App\Models\ImportLog;
use Illuminate\Http\Request;

class EpisodeManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Episode::with('anime');

        if ($request->filled('anime_id')) {
            $query->where('anime_id', $request->anime_id);
        }

        if ($request->filled('search')) {
            $query->whereHas('anime', function ($q) use ($request) {
                $q->where('title', 'ILIKE', '%'.$request->search.'%');
            });
        }

        if ($request->filled('translator')) {
            $query->where('translator', $request->translator);
        }

        if ($request->filled('quality')) {
            $query->where('quality', $request->quality);
        }

        $episodes = $query
            ->orderBy('anime_id')
            ->orderBy('season_number')
            ->orderBy('episode_number')
            ->paginate(50);

        $anime = null;
        if ($request->filled('anime_id')) {
            $anime = Anime::find($request->anime_id);
        }

        $allAnimes = Anime::orderBy('title')->get();

        return view('admin.episodes.index', compact('episodes', 'anime', 'allAnimes'));
    }

    public function importForAnime(Request $request, string $animeId)
    {
        $anime = Anime::findOrFail($animeId);

        $importLog = ImportLog::create([
            'import_type' => 'episodes_update',
            'started_at' => now(),
            'status' => 'running',
        ]);

        ImportEpisodesJob::dispatch($anime->id, false, $importLog->id);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'import_episodes',
            'description' => "Started episodes import for anime: {$anime->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('admin.episodes.index', ['anime_id' => $animeId])
            ->with('success', 'Episodes import started for '.$anime->title);
    }

    public function importAll(Request $request)
    {
        $isInitialImport = true;

        $importLog = ImportLog::create([
            'import_type' => 'episodes_initial',
            'started_at' => now(),
            'status' => 'running',
        ]);

        $anime = Anime::all();

        foreach ($anime as $animeItem) {
            ImportEpisodesJob::dispatch($animeItem->id, $isInitialImport, $importLog->id);
        }

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'import_all_episodes',
            'description' => 'Started mass episodes import (initial) for all anime',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('admin.episodes.index')
            ->with('success', 'Mass episodes import (only new episodes) started. Check queue worker progress.');
    }

    public function destroy(Request $request, string $id)
    {
        $episode = Episode::findOrFail($id);
        $animeId = $episode->anime_id;
        $episodeInfo = "{$episode->anime->title} - S{$episode->season_number}E{$episode->episode_number}";

        $episode->delete();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_episode',
            'description' => "Deleted episode: {$episodeInfo}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('admin.episodes.index', ['anime_id' => $animeId])
            ->with('success', 'Episode deleted successfully');
    }

    public function edit(Episode $episode)
    {
        return view('admin.episodes.edit', compact('episode'));
    }

    public function update(Request $request, Episode $episode)
    {
        $data = $request->validate([
            'episode_number' => ['required', 'integer', 'min:1'],
            'title' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:published,draft,archived'],
            'player_url' => ['nullable', 'url', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        $episode->update($data);

        return redirect()
            ->route('admin.episodes.index')
            ->with('success', 'Episode updated successfully');
    }

    public function bulkImport(Request $request)
    {
        $data = $request->validate([
            'anime_id' => ['required', 'exists:anime,id'],
        ]);

        $onlyNew = true;

        $importLog = ImportLog::create([
            'import_type' => 'episodes_bulk_new',
            'started_at' => now(),
            'status' => 'running',
        ]);

        ImportEpisodesJob::dispatch((int) $data['anime_id'], ! $onlyNew, $importLog->id);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'bulk_import_episodes',
            'description' => "Started bulk import for anime ID {$data['anime_id']} (mode: new)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('admin.episodes.index', ['anime_id' => $data['anime_id']])
            ->with('success', 'Bulk episodes import started');
    }
}
