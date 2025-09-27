<?php

namespace App\Policies;

use App\Models\Reminder;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class ReminderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reminder $reminder): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    use HandlesAuthorization;

    public function update(User $user, Reminder $reminder)
    {
        // مدیر می‌تواند برای خودش یا کارکنانش ویرایش کند
        return $user->hasRole('Manager') 
               ? $reminder->user_id == $user->id || $user->employees->pluck('id')->contains($reminder->user_id)
               : $reminder->user_id == $user->id;
    }

    public function delete(User $user, Reminder $reminder)
    {
        // مدیر می‌تواند برای کارکنانش حذف کند
        return $user->hasRole('Manager') 
               ? $reminder->user_id == $user->id || $user->employees->pluck('id')->contains($reminder->user_id)
               : $reminder->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reminder $reminder): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reminder $reminder): bool
    {
        return false;
    }
}
