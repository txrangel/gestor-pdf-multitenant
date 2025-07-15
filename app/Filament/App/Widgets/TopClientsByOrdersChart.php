<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\FiltersChartByUserData; // 1. Importar
use App\Models\Order;
use Filament\Widgets\ChartWidget;

class TopClientsByOrdersChart extends ChartWidget
{
    use FiltersChartByUserData; // 2. Usar

    protected static ?string $heading = 'Top 10 Clientes com Mais Pedidos';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'info';
    protected static ?string $pollingInterval = null;
    protected function getData(): array
    {
        // 3. Aplicar o filtro
        $filteredQuery = $this->applyUserFilter(Order::query());

        // 4. Continuar a consulta
        $data = $filteredQuery
            ->selectRaw('cnpj, COUNT(*) as total')
            ->groupBy('cnpj')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF'],
                ],
            ],
            'labels' => $data->pluck('cnpj'),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}