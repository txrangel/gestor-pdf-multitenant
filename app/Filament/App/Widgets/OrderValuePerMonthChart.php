<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\FiltersChartByUserData; // 1. Importar
use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrderValuePerMonthChart extends ChartWidget
{
    use FiltersChartByUserData; // 2. Usar

    protected static ?string $heading = 'Valor Total dos Pedidos por Mês';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'success';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = null;
    protected function getData(): array
    {
        // 3. Aplicar o filtro
        $filteredQuery = $this->applyUserFilter(OrderItem::query());

        // 4. Usar Trend::query()
        $data = Trend::query($filteredQuery)
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
}