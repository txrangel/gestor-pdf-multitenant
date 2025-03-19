<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected function mapWebRoutes()
    {
        foreach ($this->centralDomains() as $domain) {
            Route::middleware('web')
                ->domain($domain)
                // ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        }
    }
     
    protected function mapApiRoutes()
    {
        foreach ($this->centralDomains() as $domain) {
            Route::prefix('api')
                ->domain($domain)
                ->middleware('api')
                // ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
        }
    }
     
    protected function centralDomains(): array
    {
        return config('tenancy.central_domains');
    }
}