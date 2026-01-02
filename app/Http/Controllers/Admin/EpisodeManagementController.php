<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\EpisodesImportJob;
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

        $episodes = $query
            ->orderBy('anime_id', 'desc')
            ->orderBy('episode_number', 'desc')
            ->paginate(50);

        $allAnimes = Anime::orderBy('title')->get();
        $anime = $request->filled('anime_id') ? Anime::find($request->anime_id) : null;

        return view('admin.episodes.index', compact('episodes', 'anime', 'allAnimes'));
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
            'player_url' => ['nullable', 'url', 'max:2048'],
            'player_iframe' => ['nullable', 'string'],
        ]);

        $episode->update($data);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_episode',
            'description' => "Updated episode #{$episode->episode_number} for anime ID: {$episode->anime_id}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        return redirect()
            ->route('admin.episodes.index', ['anime_id' => $episode->anime_id])
            ->with('success', 'Episode updated successfully');
    }

    public function importForAnime(Request $request, string $animeId)
    {
        $anime = Anime::findOrFail($animeId);
        EpisodesImportJob::dispatch($anime->id, false);

        return redirect()->back()->with('success', 'Import started');
    }

    public function importAll(Request $request)
    {
        $anime = Anime::all();
        foreach ($anime as $item) {
            EpisodesImportJob::dispatch($item->id, false);
        }
        return redirect()->back()->with('success', 'Mass import started');
    }

    public function destroy(Request $request, string $id)
    {
        $episode = Episode::findOrFail($id);
        $episode->delete();

        return redirect()->back()->with('success', 'Episode deleted');
    }
}
