<?php

declare(strict_types=1);

use App\Http\Controllers\PdfController;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    ShareErrorsFromSession::class,
])->group(function () {
    Route::redirect('/','/app')->name('app');
    Route::post('/upload', [PdfController::class,'store'])->name('upload');
    
    // Rotas de autenticação do Breeze
    require __DIR__.'/auth.php';
});