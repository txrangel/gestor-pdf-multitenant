<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrderValuePerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Valor Total dos Pedidos por Mês';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'success';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Trend::model(OrderItem::class)
            ->between(now()->startOfYear(), now()->endOfYear())
            ->perMonth()
            ->sum('sales_price*sales_quantity');

        return [
            'datasets' => [
                [
                    'label' => 'Valor dos Pedidos',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
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