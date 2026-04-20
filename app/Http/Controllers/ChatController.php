<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SwapRequest;

class ChatController extends Controller
{
    public function index($id)
    {
    // 🔒 check if swap accepted
    $swap = SwapRequest::where(function($q) use ($id){
        $q->where('sender_id', auth()->id())
          ->where('receiver_id', $id);
    })->orWhere(function($q) use ($id){
        $q->where('sender_id', $id)
          ->where('receiver_id', auth()->id());
    });

    if(!$swap) {
        abort(403); // ❌ block chat
    }

    $user = User::findOrFail($id);

    return view('chat.index', compact('user'));
  }

    public function send(Request $request)
    {
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return response()->json(['status' => 'sent']);
    }

    public function fetch($id)
    {
        $messages = Message::where(function ($q) use ($id) {
            $q->where('sender_id', auth()->id())
              ->where('receiver_id', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('sender_id', $id)
              ->where('receiver_id', auth()->id());
        })->get();

        return response()->json($messages);
    }
    public function inbox()
{
    $userId = auth()->id();

    // 🔥 get all unique chat users
    $userIds = Message::where('sender_id', $userId)
        ->pluck('receiver_id')
        ->merge(
            Message::where('receiver_id', $userId)
                ->pluck('sender_id')
        )
        ->unique();

    $users = User::whereIn('id', $userIds)->get();

    // 👉 attach last message
    $users = $users->map(function ($u) use ($userId) {

        $lastMessage = Message::where(function ($q) use ($u, $userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $u->id);
        })->orWhere(function ($q) use ($u, $userId) {
            $q->where('sender_id', $u->id)->where('receiver_id', $userId);
        })
        ->latest()
        ->first();

        $u->last_message = $lastMessage?->message;

        return $u;
    });

    return view('chat.inbox', compact('users'));
    }
}
