<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\FiltersChartByUserData; // 1. Importar
use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersPerMonthChart extends ChartWidget
{
    use FiltersChartByUserData; // 2. Usar

    protected static ?string $heading = 'Total de Pedidos por Mês';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'primary';

    protected function getData(): array
    {
        // 3. Aplicar o filtro na consulta base
        $filteredQuery = $this->applyUserFilter(Order::query());

        // 4. Continuar a consulta a partir da base filtrada
        $data = $filteredQuery
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(DISTINCT id) as total")
            ->whereYear('created_at', now()->year)
            ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(created_at, '%Y-%m') ASC")
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Pedidos Únicos',
                    'data' => $data->pluck('total'),
                ],
            ],
            'labels' => $data->pluck('month'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}