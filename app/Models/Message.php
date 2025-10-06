<?php
// app/Models/Message.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id','receiver_id','body','attachment','seen_at'];

    protected $casts = [
        'seen_at' => 'datetime',
    ];

    public function sender()   { return $this->belongsTo(User::class, 'sender_id'); }
    public function receiver() { return $this->belongsTo(User::class, 'receiver_id'); }

    // برگرداندن طرف مقابل گفتگو نسبت به یک کاربر
    public function otherParty(int $authId)
    {
        return $this->sender_id === $authId ? $this->receiver : $this->sender;
    }

    public function scopeBetween($q, int $a, int $b)
    {
        return $q->where(function($qq) use ($a,$b){
            $qq->where('sender_id',$a)->where('receiver_id',$b);
        })->orWhere(function($qq) use ($a,$b){
            $qq->where('sender_id',$b)->where('receiver_id',$a);
        });
    }
}
