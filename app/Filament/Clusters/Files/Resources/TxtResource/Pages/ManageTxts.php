<?php

namespace App\Filament\Clusters\Files\Resources\TxtResource\Pages;

use App\Filament\Clusters\Files\Resources\TxtResource;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\OrderController;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;


class ManageTxts extends ManageRecords
{
    protected static string $resource = TxtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    return app(PdfController::class)->handlePdfConversion($data);
                })
                ->successNotificationTitle('TXT criado.')
                ->after(function ($record) {
                    app(OrderController::class)->create($record->pdf);
                }),
        ];
    }
}
