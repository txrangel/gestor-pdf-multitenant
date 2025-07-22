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
        Schema::create('api_token_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('token_id')->nullable();
            $table->string('action', 50); // create, renew, revoke, etc.
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->string('device_name', 255);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            
            // Indexes para melhor performance nas consultas
            $table->index(['user_id', 'token_id']);
            $table->index('action');
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_token_audits');
    }
};