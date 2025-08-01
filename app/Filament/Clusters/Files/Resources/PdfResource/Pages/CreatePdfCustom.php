<?php

namespace App\Filament\Clusters\Files\Resources\PdfResource\Pages;

use App\Filament\Clusters\Files\Resources\PdfResource;
use Filament\Resources\Pages\Page;

class CreatePdfCustom extends Page
{
    protected static string $resource = PdfResource::class;
    protected static ?string $title = 'Importar';
    protected ?string $heading = 'Importar Pdf';
    protected static string $view = 'filament.clusters.files.resources.pdf-resource.pages.create-pdf-custom';
}
