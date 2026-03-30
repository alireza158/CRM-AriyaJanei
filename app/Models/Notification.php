<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'leave_id',
        'title',
        'message',
        'seen',
    ];

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
