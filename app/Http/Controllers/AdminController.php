<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BannedEmail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard (count)
public function dashboard()
{
    $users = User::latest()->get(); //   list
    $totalUsers = User::count(); //  count

    return view('admin.dashboard', compact('users', 'totalUsers'));
}

    // Users list
    public function users()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }

    // DELETE USER
    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'User deleted');
    }

    // 🔥 FIXED BAN USER
    public function banUser($id)
    {
        $user = User::findOrFail($id);

        // save email
        BannedEmail::create([
            'email' => $user->email
        ]);

        // delete user
        $user->delete();

        return back()->with('success', 'User banned');
    }

    public function reports()
    {
        return view('admin.reports');
    }
}
