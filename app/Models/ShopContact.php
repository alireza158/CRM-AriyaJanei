<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopContact extends Model
{
    protected $fillable = [
        'visitor_name','city','relation_type',
        'address','lat','lng',
        'shop_name','owner_name','owner_phone',
        'cooperation_interest',

        'activity_field','shop_size','shop_location','shop_grade',
        'main_goods','arya_customer','payment_terms',

        'nr_activity','nr_activity_other','nr_goods','nr_goods_other',
         'description', // ✅ اضافه شد
    ];

   protected $casts = ['main_goods'=>'array','nr_goods'=>'array'];
protected $guarded = [];

}
