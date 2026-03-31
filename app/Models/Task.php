<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'date', 'due_at', 'completed'];

    protected $casts = [
        'due_at' => 'datetime',
        'completed' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
