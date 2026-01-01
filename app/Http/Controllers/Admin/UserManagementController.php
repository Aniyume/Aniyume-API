<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'ILIKE', '%' . $request->search . '%');
        }

        $users = $query->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function ban(Request $request, User $user)
    {
        $request->validate(['reason' => 'required|string|max:255']);

        $user->update([
            'is_banned' => true,
            'ban_reason' => $request->reason
        ]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'ban_user',
            'description' => "Banned user {$user->email}: {$request->reason}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Пользователь заблокирован');
    }

    public function unban(Request $request, User $user)
    {
        $user->update([
            'is_banned' => false,
            'ban_reason' => null
        ]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'unban_user',
            'description' => "Unbanned user {$user->email}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Пользователь разблокирован');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Пользователь удален');
    }
}
