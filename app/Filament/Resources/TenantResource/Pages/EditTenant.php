<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditTenant extends EditRecord
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        Notification::make()
            ->title('Tenant Updated')
            ->sendToDatabase(auth()->user());
    }
}
