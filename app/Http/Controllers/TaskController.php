<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Task;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            $tasks = Task::with('user')->orderByDesc('due_at')->orderByDesc('date')->get();
        } elseif ($user->hasRole('Manager')) {
            $tasks = Task::with('user')
                ->whereHas('user', function ($q) use ($user) {
                    $q->where('manager_id', $user->id);
                })
                ->orderByDesc('due_at')
                ->orderByDesc('date')
                ->get();
        } else {
            $tasks = Task::with('user')
                ->where('user_id', $user->id)
                ->orderByDesc('due_at')
                ->orderByDesc('date')
                ->get();
        }

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('Admin')) {
            $users = User::all();
        } elseif (auth()->user()->hasRole('Manager')) {
            $users = User::where('manager_id', auth()->id())->get();
        } else {
            abort(403);
        }

        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'due_date' => 'required|string',
            'due_time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        $dueAt = Verta::parseFormat('Y/m/d H:i', $request->due_date . ' ' . $request->due_time)->datetime();

        $task = Task::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $dueAt->format('Y-m-d'),
            'due_at' => $dueAt,
        ]);

        Notification::create([
            'user_id' => $task->user_id,
            'task_id' => $task->id,
            'title' => 'تسک جدید',
            'message' => 'تسک جدید برای شما ثبت شده است.',
            'seen' => false,
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'تسک ساخته شد.');
    }

    public function today()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->whereDate('date', now())
            ->orderByDesc('created_at')
            ->get();

        return view('marketer.tasks.today', compact('tasks'));
    }

    public function complete(Task $task)
    {
        $task->update(['completed' => !$task->completed]);

        return response()->json(['success' => true, 'completed' => $task->completed]);
    }

    public function edit(Task $task)
    {
        $user = auth()->user();

        if ($user->hasRole('Admin') || ($user->hasRole('Manager') && $task->user->manager_id == $user->id)) {
            return view('admin.tasks.edit', compact('task'));
        }

        abort(403);
    }

    public function destroy(Task $task)
    {
        $user = auth()->user();

        if ($user->hasRole('Admin') || ($user->hasRole('Manager') && $task->user->manager_id == $user->id)) {
            $task->delete();

            return redirect()->route('admin.tasks.index')->with('success', 'تسک حذف شد.');
        }

        abort(403);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'required|string',
            'due_time' => 'required|date_format:H:i',
        ]);

        $dueAt = Verta::parseFormat('Y/m/d H:i', $request->due_date . ' ' . $request->due_time)->datetime();

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $dueAt->format('Y-m-d'),
            'due_at' => $dueAt,
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'تسک با موفقیت بروزرسانی شد.');
    }
}
