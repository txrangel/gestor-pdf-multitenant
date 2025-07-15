<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Page;

class UserDashboard extends Page
{
    protected static ?string $slug = 'dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Home';
    protected static string $view = 'filament.app.pages.user-dashboard';
    protected ?string $heading = '';
    public array $widgets = [];
    public function mount(): void
    {
        // Populamos nossa propriedade pública com as strings das classes dos widgets.
        $widgetClasses = [
            \App\Filament\Widgets\ItemsSoldPerMonthChart::class,
            \App\Filament\Widgets\OrdersPerMonthChart::class,
            \App\Filament\Widgets\OrderValuePerMonthChart::class,
            \App\Filament\Widgets\TopClientsByOrdersChart::class,
            \App\Filament\Widgets\TopClientsByOrderValueChart::class,
        ];

        $this->widgets = collect($widgetClasses)->map(function ($widgetClass) {
            // Usamos a reflexão para obter o valor da propriedade estática $columnSpan.
            // O valor padrão para a maioria dos widgets é 6 (metade da largura em um grid de 12).
            $defaultProperties = (new \ReflectionClass($widgetClass))->getDefaultProperties();
            $span = $defaultProperties['columnSpan'] ?? 6;

            return [
                'class' => $widgetClass,
                'span' => $span,
            ];
        })->toArray();
    }
}
