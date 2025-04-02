<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::middleware('web')->domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');
        Route::post('/contact', [ContactController::class,'store'])->name('contact.submit');
    });
}

require __DIR__.'/auth.php';
