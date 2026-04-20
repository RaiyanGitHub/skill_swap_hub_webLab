<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SwapRequest;
use Illuminate\Database\QueryException;


class SwapController extends Controller
{
    //  SEND REQUEST
   public function send(Request $request, $id)
{
    $sender = auth()->id();

    //  prevent self request
    if ($sender == $id) {
        return back()->with('error', 'Invalid request');
    }

    // 🔒 duplicate check (your existing logic - keep it)
    $exists = \App\Models\SwapRequest::where('sender_id', $sender)
        ->where('receiver_id', $id)
        ->where('skill_offered', $request->skill_offered)
        ->where('skill_requested', $request->skill_requested)
        ->whereIn('status', ['pending','accepted'])
        ->exists();

    if ($exists) {
        return back()->with('error', '⚠️ Request already sent!');
    }

    try {
        // ✅ create
        \App\Models\SwapRequest::create([
            'sender_id' => $sender,
            'receiver_id' => $id,
            'skill_offered' => $request->skill_offered,
            'skill_requested' => $request->skill_requested,
            'status' => 'pending'
        ]);
    } catch (QueryException $e) {
        // 🔥 DB level duplicate fallback (IMPORTANT)
        return back()->with('error', '⚠️ Duplicate request blocked!');
    }

    return back()->with('success', '✅ Request sent!');
}
public function sent()
{
    $requests = \App\Models\SwapRequest::where('sender_id', auth()->id())
        ->with('receiver')
        ->latest()
        ->get();

    return view('dashboard.sent-requests', compact('requests'));
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
    // 📥 incoming
    $incoming = \App\Models\SwapRequest::where('receiver_id', auth()->id())
        ->with('sender')
        ->latest()
        ->get();

    // 📤 sent
    $sent = \App\Models\SwapRequest::where('sender_id', auth()->id())
        ->with('receiver')
        ->latest()
        ->get();

    return view('dashboard.requests', compact('incoming', 'sent'));
}





}
