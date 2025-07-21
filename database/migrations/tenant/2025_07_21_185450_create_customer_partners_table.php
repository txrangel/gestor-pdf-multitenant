<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('pais')->nullable();
            $table->string('nome_socio');
            $table->string('codigo_pais')->nullable();
            $table->string('faixa_etaria');
            $table->string('cnpj_cpf_do_socio');
            $table->string('qualificacao_socio');
            $table->integer('codigo_faixa_etaria');
            $table->date('data_entrada_sociedade');
            $table->integer('identificador_de_socio');
            $table->string('cpf_representante_legal');
            $table->string('nome_representante_legal');
            $table->integer('codigo_qualificacao_socio');
            $table->string('qualificacao_representante_legal');
            $table->integer('codigo_qualificacao_representante_legal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_partners');
    }
};
