<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    protected $fillable = ['user_id', 'product_id', 'sales', 'commission'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // محاسبه پورسانت با توجه به تنظیمات محصول
    public function getCommissionAttribute()
    {
        $b = $this->sales;
        $c = $this->product->condition;
        $d = $this->product->percent;
        $e = $this->product->price;

        if ($b > $c) {
            return ($b - $c) * $d * $e;
        } else {
            return -($c - $b) * $d * $e;
        }
    }

}
