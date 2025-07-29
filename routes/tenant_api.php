<?php

declare(strict_types=1);

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->prefix('v1')->group(function () {
    // Rota pública para obtenção de token
    Route::post('/auth/token', [AuthController::class, 'createToken']);

    // Rotas protegidas pelo Sanctum
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders/update-erp-status', [OrderController::class, 'updateErpStatus']);
        
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