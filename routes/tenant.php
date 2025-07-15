<?php

declare(strict_types=1);

use App\Http\Controllers\PdfController;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class, // Inicializa o tenant
    PreventAccessFromCentralDomains::class, // Bloqueia acesso central
    ShareErrorsFromSession::class, // Compartilha erros de sessão com as views
])->group(function () {

    Route::redirect('/','/app')->name('app');
    // Route::get('/upload', [PdfController::class,'create'])->name('create');
    Route::post('/upload', [PdfController::class,'store'])->name('upload');
    // Inclua as rotas de autenticação do Breeze
    require __DIR__.'/auth.php';
});