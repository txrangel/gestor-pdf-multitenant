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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('txt_id')->constrained()->onDelete('cascade')->unique();
            $table->string('cnpj', 20);
            $table->string('client_order');
            $table->date('date');
            $table->text('message_for_note')->nullable();
            $table->string('operation');
            $table->string('shipping_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
