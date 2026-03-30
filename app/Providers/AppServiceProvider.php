<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.navigation', function ($view) {
            $user = auth()->user();

            if (!$user) {
                $view->with('headerAnnouncements', collect())
                    ->with('headerNotifications', collect())
                    ->with('headerNotificationsUnseenCount', 0);
                return;
            }

            $headerAnnouncements = Announcement::query()
                ->where('is_active', true)
                ->with('creator:id,name')
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();

            $headerNotifications = Notification::query()
                ->with(['leave.user', 'leave.substituteUser'])
                ->where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();

            $headerNotificationsUnseenCount = Notification::query()
                ->where('user_id', $user->id)
                ->where('seen', false)
                ->count();

            $view->with('headerAnnouncements', $headerAnnouncements)
                ->with('headerNotifications', $headerNotifications)
                ->with('headerNotificationsUnseenCount', $headerNotificationsUnseenCount);
        });
    }
}
