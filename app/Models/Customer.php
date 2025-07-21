<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'uf',
        'cep',
        'cnpj',
        'pais',
        'email',
        'porte',
        'bairro',
        'numero',
        'ddd_fax',
        'municipio',
        'logradouro',
        'cnae_fiscal',
        'codigo_pais',
        'complemento',
        'codigo_porte',
        'razao_social',
        'nome_fantasia',
        'capital_social',
        'ddd_telefone_1',
        'ddd_telefone_2',
        'opcao_pelo_mei',
        'descricao_porte',
        'codigo_municipio',
        'natureza_juridica',
        'situacao_especial',
        'opcao_pelo_simples',
        'situacao_cadastral',
        'data_opcao_pelo_mei',
        'data_exclusao_do_mei',
        'cnae_fiscal_descricao',
        'codigo_municipio_ibge',
        'data_inicio_atividade',
        'data_situacao_especial',
        'data_opcao_pelo_simples',
        'data_situacao_cadastral',
        'nome_cidade_no_exterior',
        'codigo_natureza_juridica',
        'data_exclusao_do_simples',
        'motivo_situacao_cadastral',
        'ente_federativo_responsavel',
        'identificador_matriz_filial',
        'qualificacao_do_responsavel',
        'descricao_situacao_cadastral',
        'descricao_tipo_de_logradouro',
        'descricao_motivo_situacao_cadastral',
        'descricao_identificador_matriz_filial',
    ];

    protected $casts = [
        'data_inicio_atividade' => 'date',
        'data_situacao_especial' => 'date',
        'data_opcao_pelo_simples' => 'date',
        'data_situacao_cadastral' => 'date',
        'data_exclusao_do_simples' => 'date',
        'data_opcao_pelo_mei' => 'date',
        'data_exclusao_do_mei' => 'date',
        'capital_social' => 'float',
    ];

    public function partners(): HasMany
    {
        return $this->hasMany(CustomerPartner::class);
    }

    public function cnaes(): HasMany
    {
        return $this->hasMany(CustomerCnae::class);
    }

    public function tributacoes(): HasMany
    {
        return $this->hasMany(CustomerTributacao::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}