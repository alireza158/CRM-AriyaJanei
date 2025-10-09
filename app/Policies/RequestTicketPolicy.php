<?php
namespace App\Policies;


use App\Models\RequestTicket;
use App\Models\User;


class RequestTicketPolicy
{
/**
* صاحب درخواست تا زمانی که pending است، می‌تواند ویرایش/حذف کند.
* ادمین همیشه دسترسی دارد.
*/
public function update(User $user, RequestTicket $ticket): bool
{
if ($user->hasRole('Admin')) return true;
return $ticket->status === 'pending' && $ticket->user_id === $user->id;
}


public function delete(User $user, RequestTicket $ticket): bool
{
if ($user->hasRole('Admin')) return true;
// اجازه حذف تا قبل از تایید نهایی
return in_array($ticket->status, ['pending','manager_approved']) && $ticket->user_id === $user->id;
}
public function view(User $user, RequestTicket $ticket): bool
{
    if ($user->hasRole('Admin') || $user->hasAnyRole(['Manager','InternalManager','internalManager'])) {
        return true;
    }
    return $ticket->user_id === $user->id; // صاحب درخواست
}
}