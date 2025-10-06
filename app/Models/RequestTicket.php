<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes; // درصورت نیاز


class RequestTicket extends Model
{
use HasFactory; //, SoftDeletes;


protected $fillable = [
'user_id', 'title', 'description', 'status', 'manager_id', 'super_manager_id'
];


// روابط
public function user()
{
return $this->belongsTo(User::class);
}


public function manager()
{
return $this->belongsTo(User::class, 'manager_id');
}


public function superManager()
{
return $this->belongsTo(User::class, 'super_manager_id');
}
}