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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('barcode')->nullable();
            $table->string('client_order');
            $table->date('delivery_date');
            $table->string('product')->nullable();
            $table->string('product_client');
            $table->string('product_description');
            $table->string('product_specifications')->nullable();
            $table->decimal('sales_price', 16, 2);
            $table->integer('sales_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
