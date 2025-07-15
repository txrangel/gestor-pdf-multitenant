<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Total de Pedidos por Mês';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'primary';

    protected function getData(): array
    {
        $data = Order::query()
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(DISTINCT id) as total")
            ->whereYear('created_at', now()->year) // Filtra pelo ano atual, como no seu exemplo
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
    // protected function getFilters(): ?array
    // {
    //     return [
    //         'today' => 'Today',
    //         'week' => 'Last week',
    //         'month' => 'Last month',
    //         'year' => 'This year',
    //     ];
    // }
}