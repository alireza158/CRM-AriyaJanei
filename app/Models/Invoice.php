<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'invoice_date',
        'total_amount',
        'description',
         'attachment_path', // 👈 این رو اضافه کن
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function marketer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function attachments()
{
    return $this->hasMany(InvoiceAttachment::class);
}

}
