<?php

if (!function_exists('sendNotification')) {
    function sendNotification($userId, $title, $message) {
        \App\Models\Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
        ]);
    }
}
