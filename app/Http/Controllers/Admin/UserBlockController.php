<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class UserBlockController extends Controller
{
    public function block(Request $request, User $user)
    {
        $request->validate([
            'hours' => 'required|integer|min:1|max:8760',
        ]);

        $hours = (int) $request->hours;
        $blockedUntil = now()->addHours($hours);

        $user->blocked_until = $blockedUntil;
        $user->save();

        // ثبت لاگ
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->withProperties([
                'blocked_until' => $blockedUntil->toDateTimeString()
            ])
            ->log("کاربر مسدود شد برای {$hours} ساعت");

        return redirect()->back()->with('success', "کاربر برای {$hours} ساعت مسدود شد.");
    }

    public function unblock(User $user)
    {
        $user->blocked_until = null;
        $user->save();

        // ثبت لاگ
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("کاربر آزاد شد");

        return redirect()->back()->with('success', "کاربر آزاد شد.");
    }
}
