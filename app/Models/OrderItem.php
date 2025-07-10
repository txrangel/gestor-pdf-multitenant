<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'barcode',
        'client_order',
        'delivery_date',
        'product',
        'product_client',
        'product_description',
        'product_specifications',
        'sales_price',
        'sales_quantity',
    ];

    protected $casts = [
        'delivery_date' => 'date',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}