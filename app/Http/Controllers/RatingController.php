<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Notification;
class RatingController extends Controller
{
    public function store(Request $request, $swapId)
{
    // ❌ already rated check
    $exists = Rating::where('swap_request_id', $swapId)
        ->where('from_user_id', auth()->id())
        ->exists();

    if ($exists) {
        return back()->with('error', 'You already rated this swap!');
    }

    Rating::create([
        'swap_request_id' => $swapId,
        'from_user_id' => auth()->id(),
        'to_user_id' => $request->to_user_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);
    Notification::create([
    'user_id' => $request->to_user_id,
    'type' => 'rating',
    'message' => auth()->user()->name . ' rated you ⭐'
    ]);

    return back()->with('success', '⭐ Rating submitted!');
}


}
