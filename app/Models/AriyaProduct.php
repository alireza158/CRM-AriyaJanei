<?php

// app/Models/AriyaProduct.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AriyaProduct extends Model
{
  protected $fillable = [
    'ariya_id','title','base_price','base_quantity','has_varieties','synced_at'
  ];

  public function varieties()
  {
    return $this->hasMany(AriyaProductVariety::class, 'ariya_product_id');
  }
}
