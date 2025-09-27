<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RemindersController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // مدیر می‌تواند برای کاربران خود Reminder ببیند
        if ($user->hasRole('Manager')|| $user->hasRole(roles: 'Admin')) {
            $reminders = Reminder::where('user_id', $user->employees->pluck('id')->toArray())
                                 ->orWhere('user_id', $user->id)
                                 ->latest()
                                 ->paginate(15);
        } else {
            $reminders = Reminder::where('user_id', $user->id)->latest()->paginate(15);
        }

        return view('reminders.index', compact('reminders'));
    }

    public function create()
    {
        $user = auth()->user();
        $users = $user->hasRole('Manager') ? $user->employees : [$user];

        return view('reminders.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_at' => 'required|date', // زمان میلادی
        ]);

        $data['repeat'] = 'once';
        $data['seen'] = false;

        Reminder::create($data);

        return redirect()->route('reminders.index')->with('success', 'یادآور ساخته شد.');
    }

    public function edit(Reminder $reminder)
    {
        $this->authorize('update', $reminder);
        $user = auth()->user();
        $users = $user->hasRole('Manager') ? $user->employees : [$user];

        return view('reminders.edit', compact('reminder','users'));
    }

    public function update(Request $request, Reminder $reminder)
    {
        $this->authorize('update', $reminder);

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_at' => 'required|date',
        ]);

        $reminder->update($data);

        return redirect()->route('reminders.index')->with('success', 'یادآور بروزرسانی شد.');
    }

    public function destroy(Reminder $reminder)
    {
        $this->authorize('delete', $reminder);
        $reminder->delete();

        return redirect()->route('reminders.index')->with('success', 'یادآور حذف شد.');
    }

    public function markAsSeen(Reminder $reminder)
    {
        if ($reminder->user_id !== auth()->id()) {
            abort(403);
        }

        $reminder->update(['seen' => true]);

        return redirect()->back()->with('success', 'یادآور علامت‌گذاری شد.');
    }
}
