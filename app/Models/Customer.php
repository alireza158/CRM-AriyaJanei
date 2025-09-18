<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Prompts\Note;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'DISC',
      'phone',
      'address',
      'category_id',
      'reference_type_id',
      'user_id',
      'marketer_changed_at',
    ];
    protected $casts = [
        'marketer_changed_at' => 'datetime',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function referenceType(){
        return $this->belongsTo(ReferenceType::class);
    }
    public function marketer()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    public function notes(){
        return $this->hasMany(CustomerNote::class);
    }

}
