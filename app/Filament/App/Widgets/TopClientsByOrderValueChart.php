<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;

class TopClientsByOrderValueChart extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Clientes por Valor em Pedidos';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'warning';

    protected function getData(): array
    {
        $data = Order::query()
            ->select('cnpj')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('sum(sales_price*sales_quantity) as total_value')
            ->groupBy('cnpj')
            ->orderByDesc('total_value')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Valor Total',
                    'data' => $data->pluck('total_value'),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                ],
            ],
            'labels' => $data->pluck('cnpj'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
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
