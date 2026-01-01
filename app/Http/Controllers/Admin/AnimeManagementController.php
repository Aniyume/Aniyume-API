<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Tag;
use App\Models\AuditLog;
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

        $anime = $query->latest()->paginate(20);
        return view('admin.anime.index', compact('anime'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:planned,ongoing,finished,paused',
            'type' => 'required|in:tv,movie,ova,ona,special,music',
        ]);

        $anime = Anime::create($validated);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_anime',
            'description' => "Created anime: {$anime->title}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.anime.index')->with('success', 'Anime created');
    }

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);
        $anime->delete();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_anime',
            'description' => "Deleted anime ID: {$id}",
            'ip_address' => request()->ip(),
        ]);

        return redirect()->back()->with('success', 'Anime deleted');
    }
}
