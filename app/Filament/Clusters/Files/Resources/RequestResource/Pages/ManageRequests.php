<?php

namespace App\Filament\Clusters\Files\Resources\RequestResource\Pages;

use App\Filament\Clusters\Files\Resources\RequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRequests extends ManageRecords
{
    protected static string $resource = RequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
