<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCnae extends Model
{
    protected $fillable = [
        'customer_id',
        'codigo',
        'descricao',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}