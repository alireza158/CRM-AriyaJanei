<?php

// app/Models/AriyaProductVariety.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AriyaProductVariety extends Model
{
  protected $fillable = [
    'ariya_product_id','ariya_variety_id','model_name','unique_key',
    'price','quantity','is_placeholder','synced_at'
  ];

  public function product()
  {
    return $this->belongsTo(AriyaProduct::class, 'ariya_product_id');
  }
}
