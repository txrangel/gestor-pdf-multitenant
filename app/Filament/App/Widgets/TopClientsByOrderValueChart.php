<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\FiltersChartByUserData; // 1. Importar
use App\Models\Order;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class TopClientsByOrderValueChart extends ChartWidget
{
    use FiltersChartByUserData; // 2. Usar

    protected static ?string $heading = 'Top 5 Clientes por Valor em Pedidos';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'warning';
    protected static ?string $pollingInterval = null;
    protected function getData(): array
    {
        $filteredQuery = $this->applyUserFilter(Order::query());

        $data = $filteredQuery
            ->with(['customer']) // Carrega o relacionamento
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('orders.customer_id, sum(order_items.sales_price * order_items.sales_quantity) as total_value')
            ->groupBy('orders.customer_id')
            ->orderByDesc('total_value')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Valor Total',
                    'data' => $data->pluck('total_value'),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                ],
            ],
            'labels' => $data->map(function ($item) {
                return $item->customer->razao_social . "\nCNPJ: " . $item->customer->cnpj;
            }),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

}