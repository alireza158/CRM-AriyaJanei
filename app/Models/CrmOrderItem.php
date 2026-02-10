<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmOrderItem extends Model
{
    protected $fillable = [
        'crm_order_id',
        'product_id',
        'variety_id',
        'quantity',
        'price',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(CrmOrder::class, 'crm_order_id');
    }
}
