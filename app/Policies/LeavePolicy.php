<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeavePolicy
{
    public function update(User $user, Leave $leave)
{
    return $user->id === $leave->user_id;
}

public function delete(User $user, Leave $leave)
{
    // فقط صاحب مرخصی می‌تواند حذف کند و مرخصی هنوز تایید نهایی نشده باشد
    return $leave->user_id === $user->id && $leave->status === 'pending';
}


public function approve(User $user, Leave $leave)
{
    return $user->id === $leave->manager_id || $user->id === $leave->super_manager_id;
}

}
