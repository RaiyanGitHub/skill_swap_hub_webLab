<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, $swapId)
    {
        Rating::create([
            'swap_request_id' => $swapId,
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->to_user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Rating submitted!');
    }
}
