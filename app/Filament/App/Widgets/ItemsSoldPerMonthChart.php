<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\FiltersChartByUserData; // 1. Importar o Trait
use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ItemsSoldPerMonthChart extends ChartWidget
{
    use FiltersChartByUserData; // 2. Usar o Trait

    protected static ?string $heading = 'Itens Vendidos por Mês';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'gray';

    protected function getData(): array
    {
        // 3. Aplicar o filtro na consulta base
        $filteredQuery = $this->applyUserFilter(OrderItem::query());

        // 4. Usar Trend::query() em vez de Trend::model()
        $data = Trend::query($filteredQuery)
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
}