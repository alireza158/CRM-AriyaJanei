<?php
// app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageGroup;
use App\Models\GroupMessage;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    // لیست مکالمات و فرم ارسال
    public function index()
    {
        $authId = Auth::id();

        $latestPerPartner = Message::where(fn($q) => $q->where('sender_id', $authId)->orWhere('receiver_id', $authId))
            ->where(function ($q) {
                $q->whereNull('body')->orWhere('body', 'not like', '[گروه:%');
            })
            ->with(['sender:id,name', 'receiver:id,name'])
            ->orderByDesc('created_at')
            ->get()
            ->unique(fn($m) => $m->sender_id === $authId ? $m->receiver_id : $m->sender_id)
            ->values();

        $users = User::where('id', '!=', $authId)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $groups = MessageGroup::with(['users:id,name', 'creator:id,name'])
            ->whereHas('users', fn($q) => $q->where('users.id', $authId))
            ->latest()
            ->get();

        return view('messages.index', [
            'threads' => $latestPerPartner,
            'users'   => $users,
            'groups'  => $groups,
        ]);
    }

    // نمایش گفت‌وگو با یک کاربر مشخص + seen
    public function show(User $user)
    {
        $authId = Auth::id();

        abort_if($user->id === $authId, 404);

        $conversation = Message::between($authId, $user->id)
            ->where(function ($q) {
                $q->whereNull('body')->orWhere('body', 'not like', '[گروه:%');
            })
            ->with(['sender:id,name', 'receiver:id,name'])
            ->orderBy('created_at', 'asc')
            ->get();

        Message::between($authId, $user->id)
            ->where(function ($q) {
                $q->whereNull('body')->orWhere('body', 'not like', '[گروه:%');
            })
            ->whereNull('seen_at')
            ->where('receiver_id', $authId)
            ->update(['seen_at' => now()]);

        return view('messages.show', [
            'conversation' => $conversation,
            'otherUser'    => $user,
        ]);
    }

    // ارسال پیام جدید از لیست
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body'        => 'required|string|max:5000',
            'attachment'  => 'nullable|file|max:10240',
        ]);

        $authId = Auth::id();
        abort_if((int) $validated['receiver_id'] === (int) $authId, 422, 'امکان ارسال پیام به خودتان وجود ندارد.');

        $attachmentPath = $request->file('attachment')
            ? $request->file('attachment')->store('attachments', 'public')
            : null;

        $message = Message::create([
            'sender_id'   => $authId,
            'receiver_id' => (int) $validated['receiver_id'],
            'body'        => $validated['body'],
            'attachment'  => $attachmentPath,
        ]);

        Notification::create([
            'user_id' => $message->receiver_id,
            'title'   => 'پیام جدید از ' . Auth::user()->name,
            'message' => mb_strimwidth($message->body ?? '', 0, 80, '…', 'UTF-8'),
            'seen'    => false,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'         => true,
                'message_id'      => $message->id,
                'receiver_id'     => $message->receiver_id,
                'body'            => $message->body,
                'attachment'      => $message->attachment,
                'time_text'       => \Hekmatinasser\Verta\Verta::instance($message->created_at)->format('H:i'),
                'created_at_text' => \Hekmatinasser\Verta\Verta::instance($message->created_at)->format('Y/m/d H:i'),
            ]);
        }

        return redirect()
            ->route('messages.show', $message->receiver_id)
            ->with('success', 'پیام ارسال شد.');
    }

    public function storeGroup(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:120',
            'members'   => 'required|array|min:1',
            'members.*' => 'integer|exists:users,id|distinct',
        ]);

        $authId = Auth::id();
        $memberIds = collect($validated['members'])->push($authId)->unique()->values()->all();

        DB::transaction(function () use ($validated, $authId, $memberIds) {
            $group = MessageGroup::create([
                'name'       => $validated['name'],
                'creator_id' => $authId,
            ]);

            $group->users()->sync($memberIds);
        });

        return back()->with('success', 'گروه با موفقیت ساخته شد.');
    }

    public function showGroup(MessageGroup $group)
    {
        $authId = Auth::id();

        $isMember = $group->users()->where('users.id', $authId)->exists();
        abort_unless($isMember, 403);

        $group->load(['users:id,name', 'creator:id,name']);

        $messages = GroupMessage::where('message_group_id', $group->id)
            ->with('sender:id,name')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('messages.group-show', [
            'group'    => $group,
            'messages' => $messages,
        ]);
    }

    public function replyGroup(Request $request, MessageGroup $group)
    {
        $authId = Auth::id();

        $isMember = $group->users()->where('users.id', $authId)->exists();
        abort_unless($isMember, 403);

        $validated = $request->validate([
            'body'       => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $attachmentPath = $request->file('attachment')
            ? $request->file('attachment')->store('attachments', 'public')
            : null;

        GroupMessage::create([
            'message_group_id' => $group->id,
            'sender_id'        => $authId,
            'body'             => $validated['body'],
            'attachment'       => $attachmentPath,
        ]);

        $recipientIds = $group->users()
            ->where('users.id', '!=', $authId)
            ->pluck('users.id')
            ->all();

        foreach ($recipientIds as $recipientId) {
            Notification::create([
                'user_id' => $recipientId,
                'title'   => 'پیام جدید در گروه ' . $group->name,
                'message' => mb_strimwidth($validated['body'], 0, 80, '…', 'UTF-8'),
                'seen'    => false,
            ]);
        }

        return back()->with('success', 'پیام گروهی ارسال شد.');
    }

    public function downloadGroupAttachment(GroupMessage $groupMessage)
    {
        $authId = Auth::id();

        $isMember = $groupMessage->group()
            ->whereHas('users', fn($q) => $q->where('users.id', $authId))
            ->exists();

        abort_unless($isMember, 403);

        if (!$groupMessage->attachment || !Storage::disk('public')->exists($groupMessage->attachment)) {
            abort(404);
        }

        return Storage::disk('public')->download($groupMessage->attachment);
    }

    // پاسخ در صفحه گفتگو
    public function reply(Request $request, User $user)
    {
        $authId = Auth::id();
        abort_if((int) $user->id === (int) $authId, 422, 'امکان ارسال پیام به خودتان وجود ندارد.');

        $validated = $request->validate([
            'body'       => 'required|string|max:5000',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $attachmentPath = $request->file('attachment')
            ? $request->file('attachment')->store('attachments', 'public')
            : null;

        $message = Message::create([
            'sender_id'   => $authId,
            'receiver_id' => $user->id,
            'body'        => $validated['body'],
            'attachment'  => $attachmentPath,
        ]);

        Notification::create([
            'user_id' => $message->receiver_id,
            'title'   => 'پیام جدید از ' . Auth::user()->name,
            'message' => mb_strimwidth($message->body ?? '', 0, 80, '…', 'UTF-8'),
            'seen'    => false,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'         => true,
                'message_id'      => $message->id,
                'receiver_id'     => $message->receiver_id,
                'body'            => $message->body,
                'attachment'      => $message->attachment,
                'time_text'       => \Hekmatinasser\Verta\Verta::instance($message->created_at)->format('H:i'),
                'created_at_text' => \Hekmatinasser\Verta\Verta::instance($message->created_at)->format('Y/m/d H:i'),
            ]);
        }

        return back()->with('success', 'ارسال شد.');
    }

    // دانلود امن فایل پیوست
    public function download(Message $message)
    {
        $authId = Auth::id();
        abort_unless(in_array($authId, [$message->sender_id, $message->receiver_id]), 403);

        if (!$message->attachment || !Storage::disk('public')->exists($message->attachment)) {
            abort(404);
        }

        return Storage::disk('public')->download($message->attachment);
    }
}