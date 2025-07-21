<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPartner extends Model
{
    protected $fillable = [
        'customer_id',
        'pais',
        'nome_socio',
        'codigo_pais',
        'faixa_etaria',
        'cnpj_cpf_do_socio',
        'qualificacao_socio',
        'codigo_faixa_etaria',
        'data_entrada_sociedade',
        'identificador_de_socio',
        'cpf_representante_legal',
        'nome_representante_legal',
        'codigo_qualificacao_socio',
        'qualificacao_representante_legal',
        'codigo_qualificacao_representante_legal',
    ];

    protected $casts = [
        'data_entrada_sociedade' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}