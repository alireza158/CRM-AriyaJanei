<?php

use App\Models\Reminder;
use App\Policies\ReminderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Reminder::class => ReminderPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
