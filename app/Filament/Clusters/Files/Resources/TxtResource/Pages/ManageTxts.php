<?php

namespace App\Filament\Clusters\Files\Resources\TxtResource\Pages;

use App\Filament\Clusters\Files\Resources\TxtResource;
use App\Models\Pdf;
use App\Services\PdfToTxtService;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ManageTxts extends ManageRecords
{
    protected static string $resource = TxtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    return $this->handlePdfConversion($data);
                }),
        ];
    }

    private function handlePdfConversion(array $data): array
    {
        $pdf = Pdf::find($data['pdf_id']);

        if (!$pdf)
            throw new \Exception('PDF não encontrado.');

        $pdfFilePath = Storage::disk('public')->path($pdf->file_path);

        if (!file_exists($pdfFilePath))
            throw new \Exception("Arquivo PDF não encontrado: $pdfFilePath");

        $pdfToTxtService    = new PdfToTxtService();
        $apiResponseContent  = $pdfToTxtService->convertPdfToTxt($pdfFilePath);

        // Criar um arquivo temporário
        $tempFilePath = tempnam(sys_get_temp_dir(), 'api_response');

        // Salvar o conteúdo no arquivo temporário
        file_put_contents($tempFilePath, $apiResponseContent);

        // Determinar o tipo de arquivo
        $mimeType = mime_content_type($tempFilePath);
        // Processar o arquivo com base no tipo
        if ($mimeType === 'application/zip') {
            $result = $this->handleZipExtraction($pdf->id,$tempFilePath);
        } elseif ($mimeType === 'text/plain') {
            $result = $this->storeSingleTxt($pdf->id,$tempFilePath);
        } else {
            throw new \Exception('Formato de arquivo inesperado.');
        }

        unlink($tempFilePath);
        return $result;
    }

    private function handleZipExtraction(int $pdf_id,string $zipPath): array
    {
        $zip = new ZipArchive();
        $txtFilePath = 'tenants/'.tenant("id").'/txts/' . uniqid();
        $extractPath = storage_path('app/public/'.$txtFilePath);

        if ($zip->open($zipPath) !== true)
            throw new \Exception('Erro ao abrir o arquivo ZIP.');

        $zip->extractTo($extractPath);
        $zip->close();

        return [
            'pdf_id'        => $pdf_id,
            'file_path'     => $txtFilePath,
            'extension'     => '.zip'
        ];
    }
    private function storeSingleTxt(int $pdf_id,string $txtPath): array
    {
        $txtContent     = file_get_contents($txtPath);
        $txtFilePath    = 'tenants/'.tenant("id").'/txts/' . uniqid() . '.txt';
        Storage::disk('public')->put($txtFilePath, $txtContent);

        return [
            'pdf_id'        => $pdf_id,
            'file_path'     => $txtFilePath,
            'extension'     => '.txt'
        ];
    }
}
