<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
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
    public function explore(Request $request)
{
    $user = auth()->user();

    $search = $request->input('search');

    // 🔹 my learn skills
    $myLearn = Skill::where('user_id', $user->id)
        ->where('type', 'learn')
        ->pluck('name');

    // 🔹 my know skills
    $myKnow = Skill::where('user_id', $user->id)
        ->where('type', 'know')
        ->pluck('name');

    $query = User::query();

    //  except self user
    $query->where('id', '!=', $user->id);

    // 🔍 SEARCH MODE
    if ($search) {
        $query->whereHas('skills', function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%");
        });
    }

    //  AUTO MATCH MODE ( FIXED LOGIC)
    else {
        $query->where(function ($q) use ($myLearn, $myKnow) {

            // ✔️ condition 1:
            // other user knows what I want
            $q->whereHas('skills', function ($sub) use ($myLearn) {
                $sub->where('type', 'know')
                    ->whereIn('name', $myLearn);
            });

            // ✔️ condition 2:
            // AND I know what they want
            $q->whereHas('skills', function ($sub) use ($myKnow) {
                $sub->where('type', 'learn')
                    ->whereIn('name', $myKnow);
            });

        });
    }

    //  eager load all skills (no filter)
    $users = $query->with('skills')->get();

    return view('dashboard.explore', compact('users', 'search'));
}
}
