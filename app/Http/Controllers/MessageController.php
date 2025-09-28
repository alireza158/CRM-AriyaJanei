<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
class MessageController extends Controller
{
    // لیست پیام‌ها و کاربران
    public function index()
    {
        $messages = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::where('id', '!=', Auth::id())->get();

        return view('messages.index', compact('messages', 'users'));
    }

    // نمایش گفتگوی با یک کاربر
   public function show($otherUserId)
{
    $authId = auth()->id();
    
    $otherUser = User::findOrFail($otherUserId);

    $conversation = Message::where(function($q) use ($authId, $otherUserId){
            $q->where('sender_id', $authId)
              ->where('receiver_id', $otherUserId);
        })
        ->orWhere(function($q) use ($authId, $otherUserId){
            $q->where('sender_id', $otherUserId)
              ->where('receiver_id', $authId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

    return view('messages.show', compact('conversation', 'otherUser'));
}



    // ارسال پیام جدید
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string',
            'attachment' => 'nullable|file|max:10240', // 10MB
        ]);

        $attachmentPath = null;
        if($request->hasFile('attachment')){
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
            'attachment' => $attachmentPath,
        ]);

         Notification::create([
            'user_id' =>  $request->receiver_id,
            'title' => "پیام جدید",
            'message' => "پیام جدید دارید.",
            'seen' => false,
        ]);
        return back()->with('success', 'پیام ارسال شد.');
    }

    // پاسخ به پیام در صفحه گفت‌وگو
    public function reply(Request $request, User $user)
    {
        $request->validate([
            'body' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $attachmentPath = null;
        if($request->hasFile('attachment')){
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'body' => $request->body,
            'attachment' => $attachmentPath,
        ]);

        return back();
    }
}
