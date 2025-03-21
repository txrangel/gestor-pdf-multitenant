<?php

namespace App\Filament\Clusters\Files\Resources\PdfResource\Pages;

use App\Filament\Clusters\Files\Resources\PdfResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePdf extends CreateRecord
{
    protected static string $resource = PdfResource::class;
    
}
