<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
class TaskController extends Controller
{
    // Admin: نمایش و مدیریت تسک‌ها
    public function index() {
        $tasks = Task::with('user')->orderBy('date','desc')->get();
        return view('admin.tasks.index', compact('tasks'));
    }
 
    public function create() {
        return view('admin.tasks.create');
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'date' => 'required|date',
        ]);
        $request->validate([
    'date' => 'required|date_format:Y-m-d',
]);

        Task::create([
            'user_id' => $request->user_id,
            'title'   => $request->title,
            'description' => $request->description,
            'date'    => $request->date, // این باید YYYY-MM-DD باشد
        ]);


        // بعد از ذخیره تسک در Controller
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
      // $this->authorize('update', $task); // حذف کنید
$task->update(['completed' => !$task->completed]);
return response()->json(['success'=>true, 'completed'=>$task->completed]);

    }
}
