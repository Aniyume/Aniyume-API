<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentModerationController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'anime']);

        if ($request->filled('status')) {
            $isApproved = $request->status === 'approved';
            $query->where('is_approved', $isApproved);
        }

        if ($request->filled('search')) {
            $query->where('comment', 'ILIKE', '%' . $request->search . '%');
        }

        $comments = $query->latest()->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Comment approved');
    }

    public function reject(Comment $comment)
    {
        $comment->update(['is_approved' => false]);

        return redirect()->back()->with('success', 'Comment rejected');
    }

    public function destroy(Comment $comment)
    {
        $animeId = $comment->anime_id;
        $comment->delete();

        $anime = \App\Models\Anime::find($animeId);
        $anime->decrement('comments_count');

        return redirect()->back()->with('success', 'Comment deleted');
    }
}
