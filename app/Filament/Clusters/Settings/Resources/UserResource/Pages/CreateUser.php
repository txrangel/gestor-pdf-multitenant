<?php

namespace App\Filament\Clusters\Settings\Resources\UserResource\Pages;

use App\Filament\Clusters\Settings\Resources\UserResource;
use App\Models\Profile;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function afterCreate(): void
    {
        // 1. Encontre o perfil "Usuário Comum" (ajuste o nome conforme seu sistema)
        $perfil = Profile::where('name', 'Usuário Comum')->first();

        if ($perfil) {
            // 2. Vincula o perfil ao usuário recém-criado
            $this->getRecord()->profiles()->sync([$perfil->id]);
        }
    }
}
