<?php

namespace App\Providers\Filament;

use App\Http\Middleware\SessionDomainMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ->sidebarFullyCollapsibleOnDesktop(true)
            // ->sidebarWidth('200px')
            ->default()
            ->topNavigation()
            ->id('app')
            ->path('app')
            ->login(fn () => view('auth.login'))
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                // \App\Filament\Widgets\ItemsSoldPerMonthChart::class,
                // \App\Filament\Widgets\OrdersPerMonthChart::class,
                // \App\Filament\Widgets\OrderValuePerMonthChart::class,
                // \App\Filament\Widgets\TopClientsByOrdersChart::class,
                // \App\Filament\Widgets\TopClientsByOrderValueChart::class,
                
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->middleware(middleware: [
                SessionDomainMiddleware::class,
                'web',
                InitializeTenancyByDomain::class, // Inicializa o tenant
                PreventAccessFromCentralDomains::class, // Bloqueia acesso central
            ],isPersistent:true)
            ->authMiddleware([
                'auth'
            ])
            ->brandLogo(fn () => view('filament.logo'))
            ->darkModeBrandLogo(fn () => view('filament.dark-logo'))
            ->brandLogoHeight('62px')
            ->favicon(fn () => url("storage/".tenant()->photo_path))
            // ->colors(function (){
            //     dd(tenant());
            //     $array = [
            //         'primary' => Color::hex(tenant()->primary_color),
            //     ];
            //     return $array;
            // })
            ;
    }
}
