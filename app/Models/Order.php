<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'txt_id',
        'customer_id',
        'client_order',
        'date',
        'message_for_note',
        'operation',
        'shipping_type',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function txt(): BelongsTo
    {
        return $this->belongsTo(Txt::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}