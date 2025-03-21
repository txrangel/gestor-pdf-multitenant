<?php

namespace App\Filament\Clusters\Files\Resources\PdfResource\Pages;

use App\Filament\Clusters\Files\Resources\PdfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPdf extends EditRecord
{
    protected static string $resource = PdfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
