<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'reason',
        'manager_id',
        'super_manager_id',
        'status',
    ];


    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function accountant() {
        return $this->belongsTo(User::class, 'accountant_id');
    }

    public function superManager() {
        return $this->belongsTo(User::class, 'super_manager_id');
}




}
