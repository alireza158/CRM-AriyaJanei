<?php
namespace App\Http\Controllers;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Notification;

class TaskController extends Controller
{
    // Admin: نمایش و مدیریت تسک‌ها
   public function index() {
    $user = auth()->user();

    if ($user->hasRole('Admin')) {
        $tasks = Task::with('user')->orderBy('date','desc')->get();
    } elseif ($user->hasRole('Manager')) {
        $tasks = Task::with('user')
            ->whereHas('user', function($q) use ($user) {
                $q->where('manager_id', $user->id); // فقط اعضای زیرمجموعه
            })
            ->orderBy('date','desc')->get();
    } else {
        $tasks = Task::with('user')
            ->whereHas('user', function($q) use ($user) {
                $q->where('user_id', $user->id); // فقط اعضای زیرمجموعه
            })
            ->orderBy('date','desc')->get();
    }

    return view('admin.tasks.index', compact('tasks'));
}


  public function create() {
    if (auth()->user()->hasRole('Admin')) {
        $users = User::all();
    } elseif (auth()->user()->hasRole('Manager')) {
        $users = User::where('manager_id', auth()->id())->get();
    } else {
        abort(403);
    }

    return view('admin.tasks.create', compact('users'));
}



public function store(Request $request) {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'title'   => 'required|string',
        'date'    => 'required|string', // رشته شمسی می‌آید
    ]);

    // تبدیل تاریخ شمسی به میلادی
    $gregorianDate = Verta::parseFormat('Y/m/d', $request->date)->datetime();

    Task::create([
        'user_id'    => $request->user_id,
        'title'      => $request->title,
        'description'=> $request->description,
        'date'       => $gregorianDate->format('Y-m-d'), // ذخیره میلادی
    ]);


$message = "تسک جدید ثبت شده است." ;
$title="تسک جدید" ;


    Notification::create([
        'user_id' => $id,
        'title' => $title,
        'message' => $message,
        'seen' => false,
    ]);


    return redirect()->route('admin.tasks.index')->with('success','تسک ساخته شد.');
}

    // Marketer: دریافت تسک‌های امروز
    public function today() {
       $tasks = Task::where('user_id', auth()->id())
             ->whereDate('date', now())
             ->orderBy('created_at','desc')
             ->get();

        return view('marketer.tasks.today', compact('tasks'));
    }

    // Marketer: تیک زدن تسک
   public function complete(Task $task) {
    $task->update(['completed' => !$task->completed]);
    return response()->json(['success'=>true, 'completed'=>$task->completed]);
}


    // نمایش فرم ویرایش
public function edit(Task $task) {
    $user = auth()->user();

    if ($user->hasRole('Admin') || ($user->hasRole('Manager') && $task->user->manager_id == $user->id)) {
        return view('admin.tasks.edit', compact('task'));
    }

    abort(403);
}

public function destroy(Task $task) {
    $user = auth()->user();

    if ($user->hasRole('Admin') || ($user->hasRole('Manager') && $task->user->manager_id == $user->id)) {
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'تسک حذف شد.');
    }

    abort(403);
}

public function update(Request $request, Task $task) {
    $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'date' => 'required|date_format:Y-m-d',
    ]);

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'date' => $request->date,
    ]);

    return redirect()->route('admin.tasks.index')->with('success', 'تسک با موفقیت بروزرسانی شد.');
}



}
