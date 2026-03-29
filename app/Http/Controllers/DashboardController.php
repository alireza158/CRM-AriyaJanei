<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerNote;
use App\Models\CustomerSatisfactionForm;
use App\Models\Notification;
use App\Models\Reminder;
use App\Models\Report;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $since = now()->subDay();

        // اگر در زمان لاگین این سشن را flash/set کرده باشی، فقط همان بار اول استفاده می‌شود
        $showTasksModalOnLogin = session()->pull('just_logged_in', false);

        // تسک‌های امروز
        $tasks = Task::query()
            ->where('user_id', $userId)
            ->whereDate('created_at', now()->toDateString())
            ->latest()
            ->get();

        $todayTasksCount = $tasks->count();

        // مشتری‌های جدید 24 ساعت اخیر
        $newCustomersQuery = Customer::query()
            ->where('created_at', '>=', $since);

        if (!$user->hasAnyRole(['Admin', 'Manager'])) {
            $newCustomersQuery->where('user_id', $userId);
        }

        $newCustomersCount = $newCustomersQuery->count();

        // یادداشت‌های جدید
        $newNotesCount = CustomerNote::query()
            ->where('created_at', '>=', $since)
            ->count();

        // گزارش‌های جدید
        $newReportsCount = Report::query()
            ->where('created_at', '>=', $since)
            ->count();

        // یادآورهای امروز/معوق که هنوز دیده نشده‌اند
        $todayReminders = Reminder::query()
            ->where('user_id', $userId)
            ->where('remind_at', '<=', Carbon::now())
            ->where('seen', false)
            ->orderBy('remind_at', 'asc')
            ->get();

        // فرم‌های رضایت مشتری ارجاع‌شده و ندیده
        $newAssignedCustomerSatisfactionFormsCount = CustomerSatisfactionForm::query()
            ->where('assigned_to_user_id', $userId)
            ->whereNull('referral_seen_at')
            ->count();

        // اعلان‌های ندیده
        $notifications = Notification::query()
            ->where('user_id', $userId)
            ->where('seen', false)
            ->latest()
            ->get();

        $groupedNotifications = $notifications
            ->groupBy(function ($item) {
                return $item->title ?: 'اعلان';
            })
            ->map(function ($items, $title) {
                $latest = $items->sortByDesc('created_at')->first();

                return [
                    'title' => $title,
                    'count' => $items->count(),
                    'latestCreatedAt' => optional($latest)->created_at_human,
                ];
            })
            ->values();

        $notificationCount =
            $todayReminders->count() +
            $notifications->count() +
            ($newAssignedCustomerSatisfactionFormsCount > 0 ? 1 : 0);

        return view('dashboard', [
            'tasks' => $tasks,
            'todayTasksCount' => $todayTasksCount,
            'newCustomersCount' => $newCustomersCount,
            'newNotesCount' => $newNotesCount,
            'newReportsCount' => $newReportsCount,
            'todayReminders' => $todayReminders,
            'notifications' => $notifications,
            'groupedNotifications' => $groupedNotifications,
            'notificationCount' => $notificationCount,
            'newAssignedCustomerSatisfactionFormsCount' => $newAssignedCustomerSatisfactionFormsCount,
            'showTasksModalOnLogin' => $showTasksModalOnLogin && $tasks->isNotEmpty(),
        ]);
    }
}