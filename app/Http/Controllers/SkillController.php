<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
/* hard coded skills list for testing
class SkillController extends Controller
{
    public function index()
    {
        $skills = [
            'Web Development',
            'Graphic Design',
            'Video Editing',
            'Public Speaking',
            'Digital Marketing',
            'Photography',
            'Content Writing',
            'UI/UX Design',
            'Programming',
            'SEO Optimization'
        ];

        return view('dashboard.skills', compact('skills'));
    }
}
*/
Class SkillController extends Controller{

public function index()
{
    //dd(Auth::user()->skills);
    //dd(Auth::id());
    $user = Auth::user();

    $skillsKnow = $user->skills()->where('type', 'know')->get();
    $skillsLearn = $user->skills()->where('type', 'learn')->get();

    return view('dashboard.skills', compact('skillsKnow', 'skillsLearn'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:know,learn'
    ]);

    Skill::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'type' => $request->type
    ]);

    return redirect()->back()->with('success', 'Skill added!');
}
public function destroy($id)
{
    $skill = Skill::findOrFail($id);

    // security check (important 🔥)
    if ($skill->user_id != auth()->id()) {
        abort(403);
    }

    $skill->delete();

    return redirect()->back()->with('success', 'Skill deleted!');
}
}
