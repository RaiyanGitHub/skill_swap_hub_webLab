<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔥 total skills count
        $skillsCount = $user->skills()->count();

        // optional split
        $skillsKnowCount = $user->skills()->where('type', 'know')->count();
        $skillsLearnCount = $user->skills()->where('type', 'learn')->count();

        return view('dashboard.index', compact(
            'skillsCount',
            'skillsKnowCount',
            'skillsLearnCount'
        ));
    }
}
