<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('uf', 2);
            $table->string('cep', 10);
            $table->string('cnpj', 18)->unique();
            $table->string('pais')->nullable();
            $table->string('email')->nullable();
            $table->string('porte');
            $table->string('bairro');
            $table->string('numero');
            $table->string('ddd_fax');
            $table->string('municipio');
            $table->string('logradouro');
            $table->integer('cnae_fiscal');
            $table->string('codigo_pais')->nullable();
            $table->string('complemento');
            $table->integer('codigo_porte');
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->float('capital_social');
            $table->string('ddd_telefone_1');
            $table->string('ddd_telefone_2');
            $table->string('opcao_pelo_mei')->nullable();
            $table->string('descricao_porte')->nullable();
            $table->integer('codigo_municipio');
            $table->string('natureza_juridica');
            $table->string('situacao_especial');
            $table->string('opcao_pelo_simples')->nullable();
            $table->integer('situacao_cadastral');
            $table->date('data_opcao_pelo_mei')->nullable();
            $table->date('data_exclusao_do_mei')->nullable();
            $table->string('cnae_fiscal_descricao');
            $table->integer('codigo_municipio_ibge');
            $table->date('data_inicio_atividade');
            $table->date('data_situacao_especial')->nullable();
            $table->date('data_opcao_pelo_simples')->nullable();
            $table->date('data_situacao_cadastral');
            $table->string('nome_cidade_no_exterior');
            $table->integer('codigo_natureza_juridica');
            $table->date('data_exclusao_do_simples')->nullable();
            $table->integer('motivo_situacao_cadastral');
            $table->string('ente_federativo_responsavel');
            $table->integer('identificador_matriz_filial');
            $table->integer('qualificacao_do_responsavel');
            $table->string('descricao_situacao_cadastral');
            $table->string('descricao_tipo_de_logradouro');
            $table->string('descricao_motivo_situacao_cadastral');
            $table->string('descricao_identificador_matriz_filial');
            $table->timestamps();
            $table->index('razao_social');
            $table->index('nome_fantasia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
