<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerNote;
use App\Models\Report;
use App\Models\Reminder;
use App\Models\Notification;
class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = collect();

        $userId = Auth::id();


        $newCustomersCount = Customer::where('user_id', $userId)
        ->where(function($q){
            $q->where('created_at', '>=', now()->subDay())
            ->orWhere('updated_at', '>=', now()->subDay());
        })
        ->count();


        // برای نمایش مودال بعد از لاگین، یک session می‌فرستیم
        session()->put('just_logged_in', true);

        $tasks = Task::whereDate('created_at', now()->toDateString())
        ->where('user_id', auth()->id())
        ->get();

        $since = now()->subDay();

        $newCustomersCount = Customer::where('updated_at', '>=', now()->subDay())->count();
        $todayTasksCount = $tasks->count();




        $newNotesCount = CustomerNote::where('created_at', '>=', $since)->count();

        $newReportsCount = Report::where('created_at', '>=', $since)->count();

$todayReminders = Reminder::where('user_id', auth()->id())
    ->where('remind_at', '<=', Carbon::now())
    ->where('seen', false)
    ->orderBy('remind_at', 'asc')
    ->get();



    // ...

    $notifications = Notification::where('user_id', auth()->id())
        ->where('seen', false)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('dashboard', [
        'tasks' => $tasks,
        'newCustomersCount' => $newCustomersCount,
        'todayTasksCount' => $todayTasksCount,
        'newNotesCount' =>$newNotesCount,
        'newReportsCount' =>$newReportsCount,
        'todayReminders'=>$todayReminders,
        'notifications' => $notifications, // اضافه شد
    ]);

    }



}

