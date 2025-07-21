<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTributacao extends Model
{
    protected $table = 'customer_tributacoes';
    protected $fillable = [
        'customer_id',
        'ano',
        'cnpj_da_scp',
        'forma_de_tributacao',
        'quantidade_de_escrituracoes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}