<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\FiltersChartByUserData;
use App\Models\Customer;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CustomersPerMonthChart extends ChartWidget
{
    use FiltersChartByUserData;

    protected static ?string $heading = 'Clientes Cadastrados por Mês';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'success';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $filteredQuery = $this->applyUserFilter(Customer::query());

        $data = Trend::query($filteredQuery)
            ->between(now()->startOfYear(), now()->endOfYear())
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Clientes Cadastrados',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#4CAF50', // Verde
                    'borderColor' => '#388E3C',
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