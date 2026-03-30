<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Message;
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
                    ->with('headerNotificationsUnseenCount', 0)
                    ->with('headerMessages', collect())
                    ->with('headerMessagesUnseenCount', 0);
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
                ->when($user->hasRole('Manager'), function ($q) use ($user) {
                    $q->where(function ($nested) use ($user) {
                        $nested->whereNull('leave_id')
                            ->orWhereHas('leave', function ($leaveQ) use ($user) {
                                $leaveQ->where('manager_id', $user->id)
                                    ->orWhere('substitute_user_id', $user->id)
                                    ->orWhere('user_id', $user->id);
                            });
                    });
                })
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();

            $headerNotificationsUnseenCount = Notification::query()
                ->where('user_id', $user->id)
                ->where('seen', false)
                ->count();

            $headerMessages = Message::query()
                ->where(function ($q) use ($user) {
                    $q->where('sender_id', $user->id)
                        ->orWhere('receiver_id', $user->id);
                })
                ->where(function ($q) {
                    $q->whereNull('body')
                        ->orWhere('body', 'not like', '[گروه:%');
                })
                ->with(['sender:id,name', 'receiver:id,name'])
                ->orderByDesc('created_at')
                ->get()
                ->unique(function ($message) use ($user) {
                    return $message->sender_id === $user->id ? $message->receiver_id : $message->sender_id;
                })
                ->take(10)
                ->values();

            $headerMessagesUnseenCount = Message::query()
                ->where('receiver_id', $user->id)
                ->whereNull('seen_at')
                ->where(function ($q) {
                    $q->whereNull('body')
                        ->orWhere('body', 'not like', '[گروه:%');
                })
                ->count();

            $view->with('headerAnnouncements', $headerAnnouncements)
                ->with('headerNotifications', $headerNotifications)
                ->with('headerNotificationsUnseenCount', $headerNotificationsUnseenCount)
                ->with('headerMessages', $headerMessages)
                ->with('headerMessagesUnseenCount', $headerMessagesUnseenCount);
        });
    }
}
