<?php

namespace App\Filament\Clusters\Settings\Resources\ProfileResource\Pages;

use App\Filament\Clusters\Settings\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;
}
