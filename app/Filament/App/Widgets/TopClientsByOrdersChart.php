<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class TopClientsByOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Clientes com Mais Pedidos';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'info';

    protected function getData(): array
    {
        $data = Order::query()
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