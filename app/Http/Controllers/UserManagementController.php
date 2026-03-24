<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $users = User::query()
            ->orderByRaw('is_approved asc')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.users', compact('users'));
    }

    public function approve(Request $request, int $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        $user->is_approved = true;
        if (!$user->role) {
            $user->role = strtolower($user->username) === 'tudor' ? 'admin' : 'user';
        }
        $user->save();

        return back()->with('success', "Utilizatorul '{$user->username}' a fost validat.");
    }

    public function revokeApproval(int $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        abort_if(strtolower($user->username) === 'tudor', 422, 'Utilizatorul admin nu poate fi devalidat.');

        $user->is_approved = false;
        $user->save();

        return back()->with('success', "Utilizatorul '{$user->username}' a fost devalidat.");
    }

    public function destroyPending(int $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        abort_if($user->is_approved, 422, 'Poți șterge doar useri nevalidați.');
        abort_if(strtolower($user->username) === 'tudor', 422, 'Utilizatorul admin nu poate fi șters.');

        $username = $user->username;
        $user->delete();

        return back()->with('success', "Utilizatorul nevalidat '{$username}' a fost șters.");
    }

    private function authorizeAdmin(): void
    {
        $user = Auth::user();
        abort_if(!$user || !$user->isAdmin(), 403);
    }
}
