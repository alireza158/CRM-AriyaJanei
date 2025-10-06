<?php
// app/Http/Controllers/MessageController.php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    // لیست مکالمات و فرم ارسال
    public function index()
    {
        $authId = Auth::id();

        // آخرین پیام هر کانورسیشن (طرف مقابل) — ساده و سریع:
        $latestPerPartner = Message::where(fn($q)=>$q->where('sender_id',$authId)->orWhere('receiver_id',$authId))
            ->with(['sender:id,name','receiver:id,name'])
            ->orderByDesc('created_at')
            ->get()
            ->unique(fn($m)=> $m->sender_id === $authId ? $m->receiver_id : $m->sender_id)
            ->values();

        $users = User::where('id','!=',$authId)->select('id','name')->orderBy('name')->get();

        return view('messages.index', [
            'threads' => $latestPerPartner,
            'users'   => $users,
        ]);
    }

    // نمایش گفت‌وگو با یک کاربر مشخص + seen
    public function show(User $user)
    {
        $authId = Auth::id();

        // اجازه نده با خودت گفتگو باز شود
        abort_if($user->id === $authId, 404);

        $conversation = Message::between($authId, $user->id)
            ->with(['sender:id,name','receiver:id,name'])
            ->orderBy('created_at','asc')
            ->get();

        // پیام‌های دریافتیِ خوانده‌نشده را seen کن
        Message::between($authId, $user->id)
            ->whereNull('seen_at')
            ->where('receiver_id',$authId)
            ->update(['seen_at' => now()]);

        return view('messages.show', [
            'conversation' => $conversation,
            'otherUser'    => $user,
        ]);
    }

    // ارسال پیام جدید از لیست
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id|different:sender_id',
            'body'        => 'required|string',
            'attachment'  => 'nullable|file|max:10240',
        ]);

        $attachmentPath = $request->file('attachment')
            ? $request->file('attachment')->store('attachments', 'public')
            : null;

        $message = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => (int)$request->receiver_id,
            'body'        => $request->body,
            'attachment'  => $attachmentPath,
        ]);

        // اعلان ساده (اختیاری)
        Notification::create([
            'user_id' => $message->receiver_id,
            'title'   => "پیام جدید از ".Auth::user()->name,
            'message' => mb_strimwidth($message->body, 0, 80, '…', 'UTF-8'),
            'seen'    => false,
        ]);

        return redirect()->route('messages.show', $message->receiver_id)
                         ->with('success', 'پیام ارسال شد.');
    }

    // پاسخ در صفحه گفتگو
    public function reply(Request $request, User $user)
    {
        $request->validate([
            'body'       => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $attachmentPath = $request->file('attachment')
            ? $request->file('attachment')->store('attachments', 'public')
            : null;

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $user->id,
            'body'        => $request->body,
            'attachment'  => $attachmentPath,
        ]);

        return back()->with('success','ارسال شد.');
    }

    // دانلود امن فایل پیوست
    public function download(Message $message)
    {
        $authId = Auth::id();
        abort_unless(in_array($authId, [$message->sender_id,$message->receiver_id]), 403);

        if (!$message->attachment || !Storage::disk('public')->exists($message->attachment)) {
            abort(404);
        }
        return Storage::disk('public')->download($message->attachment);
    }
}
