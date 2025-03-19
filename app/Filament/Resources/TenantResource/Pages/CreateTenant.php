<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    protected function afterCreate(): void{
        $tenant = $this->getRecord();
        $tenant->domains()->create([
            'domain' => $this->data['domain'],
        ]);
    }
    protected function beforeSave(): void
    {
        Notification::make()
            ->title('Tenant Updated')
            ->sendToDatabase(auth()->user());
    }
}
