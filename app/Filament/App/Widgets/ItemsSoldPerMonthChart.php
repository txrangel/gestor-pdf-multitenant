<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ItemsSoldPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Itens Vendidos por Mês';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'gray';

    protected function getData(): array
    {
        $data = Trend::model(OrderItem::class)
            ->between(now()->startOfYear(), now()->endOfYear())
            ->perMonth()
            ->sum('sales_quantity');

        return [
            'datasets' => [
                [
                    'label' => 'Itens Vendidos',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
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
