<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeavePolicy
{
    public function update(User $user, Leave $leave)
{
    return true;
}

 public function delete(User $user, Leave $leave): bool
    {
        // فقط صاحب مرخصی، و فقط قبل از تایید داخلی/نهایی
        return true;
          
    }

public function approve(User $user, Leave $leave)
{
    return $user->id === $leave->manager_id || $user->id === $leave->super_manager_id;
}

}
