<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'txt_id',
        'cnpj',
        'client_order',
        'date',
        'message_for_note',
        'operation',
        'shipping_type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date' => 'date',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function txt()
    {
        return $this->belongsTo(Txt::class);
    }
}