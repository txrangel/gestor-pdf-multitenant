<?php

declare(strict_types=1);

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->prefix('v1')->group(function () {
    Route::get('/test', function () {
        // Se chegar aqui, o tenant foi identificado corretamente
        return response()->json([
            'message' => 'API do Tenant funcionando!',
            'tenant_id' => tenant('id') 
        ]);
    });

    // Rota pública para obtenção de token
    Route::post('/auth/token', [AuthController::class, 'createToken']);

    // Rotas protegidas pelo Sanctum
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        
        // Suas outras rotas de autenticação
        Route::name('auth')->prefix('auth')->controller(AuthController::class)->group(function () {
            Route::post('/renew', 'renewToken');
            Route::post('/revoke', 'revokeTokens');
            Route::get('/tokens', 'listTokens');
            Route::get('/user', 'user');
            Route::get('/audits', 'listAudits');
            Route::get('/audits/{token}', 'tokenAudits');
        });
    });
});