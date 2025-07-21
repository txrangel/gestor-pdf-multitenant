<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\FiltersChartByUserData; // 1. Importar
use App\Models\Order;
use Filament\Widgets\ChartWidget;
use App\Http\Controllers\CustomerController;

class TopClientsByOrdersChart extends ChartWidget
{
    use FiltersChartByUserData; // 2. Usar

    protected static ?string $heading = 'Top 5 Clientes com Mais Pedidos';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'info';
    protected static ?string $pollingInterval = null;
    protected function getData(): array
    {
        $filteredQuery = $this->applyUserFilter(Order::query());

        $data = $filteredQuery
            ->with(['customer']) // Carrega o relacionamento
            ->selectRaw('customer_id, COUNT(*) as total')
            ->groupBy('customer_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF'],
                ],
            ],
            'labels' => $data->map(function ($item) {
                return $item->customer->razao_social . "\nCNPJ: " . $item->customer->cnpj;
            }),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}