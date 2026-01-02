<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Tag;
use App\Models\AuditLog;
use App\Models\Episode;
use App\Models\BlacklistedAnime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnimeManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Anime::with('tags');

        if ($request->filled('search')) {
            $query->where('title', 'ILIKE', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $anime = $query->latest()->paginate(20);
        return view('admin.anime.index', compact('anime'));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.anime.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|url',
            'rating' => 'nullable|numeric|between:0,10',
            'status' => 'required|in:planned,ongoing,finished,paused',
            'type' => 'required|in:tv,movie,ova,ona,special,music',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $anime = Anime::create($validated);

        if ($request->has('tags')) {
            $anime->tags()->sync($request->tags);
        }

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_anime',
            'description' => "Created anime: {$anime->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        return redirect()->route('admin.anime.index')->with('success', 'Anime created');
    }

    public function show($id)
    {
        $anime = Anime::with('tags')->findOrFail($id);
        $episodes = Episode::where('anime_id', $id)->orderBy('episode_number')->get();
        return view('admin.anime.show', compact('anime', 'episodes'));
    }

    public function edit($id)
    {
        $anime = Anime::with('tags')->findOrFail($id);
        $tags = Tag::orderBy('name')->get();
        return view('admin.anime.edit', compact('anime', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|url',
            'rating' => 'nullable|numeric|between:0,10',
            'status' => 'required|in:planned,ongoing,finished,paused',
            'type' => 'required|in:tv,movie,ova,ona,special,music',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $anime->update($validated);

        if ($request->has('tags')) {
            $anime->tags()->sync($request->tags);
        } else {
            $anime->tags()->detach();
        }

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_anime',
            'description' => "Updated anime: {$anime->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        return redirect()->route('admin.anime.index')->with('success', 'Anime updated');
    }

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);
        $title = $anime->title;

        if ($anime->external_id) {
            BlacklistedAnime::firstOrCreate([
                'external_id' => $anime->external_id,
                'external_source' => $anime->external_source ?? 'anilist'
            ]);
        }

        $anime->delete();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_anime',
            'description' => "Deleted anime: {$title} (ID: {$id}) and added to blacklist",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);

        return redirect()->route('admin.anime.index')->with('success', 'Anime deleted and blacklisted');
    }
}
