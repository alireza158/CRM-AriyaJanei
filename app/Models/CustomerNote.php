<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'user_id',
        'title',
        'content',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

public function customers() { return $this->hasMany(Customer::class, 'user_id'); }

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}
// Note.php
public function user()
{
    return $this->belongsTo(User::class);
}

}
