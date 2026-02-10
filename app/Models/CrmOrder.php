<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmOrder extends Model
{
    protected $fillable = [
        'uuid',
        'created_by',
        'assigned_to',
        'status',
        'customer_name',
        'customer_mobile',
        'customer_address',
        'province_id',
        'city_id',
        'shipping_id',
        'shipping_price',
        'discount_amount',
        'total_price',
        'ariya_customer_id',
        'ariya_address_id',
        'ariya_order_id',
        'embed_token',

        // ✅ lock fields
        'locked_by',
        'locked_at',
        'lock_expires_at',
    ];

    protected $casts = [
        'locked_at' => 'datetime',
        'lock_expires_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CrmOrderItem::class);
    }

    // اگر User model داری
    public function lockedByUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'locked_by');
    }

    public function isLocked(): bool
    {
        if (!$this->locked_by || !$this->lock_expires_at) return false;
        return now()->lt($this->lock_expires_at);
    }
}
