<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSatisfactionForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'submitted_at',
        'customer_name',
        'shipment_sent_at',
        'customer_family',
        'shipping_method',
        'satisfaction_status',
        'assigned_to_user_id',
        'created_by_user_id',
        'referral_note',
        'result',
        'result_filled_at',
    ];

    protected $casts = [
        'submitted_at' => 'date',
        'shipment_sent_at' => 'date',
        'result_filled_at' => 'datetime',
    ];

    public function assignedToUser()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
