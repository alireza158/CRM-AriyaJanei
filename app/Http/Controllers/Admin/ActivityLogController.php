<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $userId = $request->get('user_id');
        $action = $request->get('action');

        $logs = Activity::with('causer')
            ->when($search, function ($query, $search) {
                $query->where('description', 'like', "%{$search}%")
                      ->orWhere('subject_type', 'like', "%{$search}%")
                      ->orWhere('subject_id', 'like', "%{$search}%");
            })
            ->when($userId, function ($query, $userId) {
                $query->where('causer_id', $userId);
            })
            ->when($action, function ($query, $action) {
                $query->where('description', $action);
            })
            ->latest()
            ->paginate(20);

        $users = User::all();
        $actions = Activity::select('description')->distinct()->pluck('description');

        return view('admin.activity_logs.index', compact('logs', 'search', 'users', 'userId', 'actions', 'action'));
    }
}
