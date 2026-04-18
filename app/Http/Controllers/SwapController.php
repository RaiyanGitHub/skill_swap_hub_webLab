<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SwapRequest;



class SwapController extends Controller
{
    //  SEND REQUEST
   public function send(Request $request, $id)
{
    $sender = auth()->id();

    //  same user ke request dite parbe na
    if ($sender == $id) {
        return back()->with('error', 'Invalid request');
    }

    //  duplicate check
    $exists = \App\Models\SwapRequest::where('sender_id', $sender)
        ->where('receiver_id', $id)
        ->where('skill_offered', $request->skill_offered)
        ->where('skill_requested', $request->skill_requested)
        ->whereIn('status', ['pending','accepted'])
        ->exists();

    if ($exists) {
        return back()->with('error', 'Request already sent!');
    }

    // SAME SKILL (know == learn) block
    if ($request->skill_offered == $request->skill_requested) {
        return back()->with('error', 'Invalid skill swap');
    }

    //  create
    \App\Models\SwapRequest::create([
        'sender_id' => $sender,
        'receiver_id' => $id,
        'skill_offered' => $request->skill_offered,
        'skill_requested' => $request->skill_requested,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Request sent!');
}

    //  ACCEPT
   public function accept($id)
{
    $swap = SwapRequest::findOrFail($id);

    if ($swap->status != 'pending') {
        return back()->with('error', 'Already processed');
    }

    $swap->update(['status' => 'accepted']);

    return back()->with('success', 'Accepted');
}


    //  REJECT
   public function reject($id)
{
    $swap = SwapRequest::findOrFail($id);

    if ($swap->status != 'pending') {
        return back()->with('error', 'Already processed');
    }

    $swap->update(['status' => 'rejected']);

    return back()->with('success', 'Rejected');
}



    // 🎯 COMPLETE

public function complete($id)
{
    $swap = SwapRequest::findOrFail($id);
    $swap->update(['status' => 'completed']);

    return back()->with('success', 'Marked as completed!');
}

    public function incoming()
{
    $requests = SwapRequest::where('receiver_id', auth()->id())
        ->with('sender')
        ->latest()
        ->get();

    return view('dashboard.requests', compact('requests'));
}





}
