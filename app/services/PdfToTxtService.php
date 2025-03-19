<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class PdfToTxtService
{
    public function convertPdfToTxt($pdfFile)
    {
        $apiUrl = config('services.api.url');
        $url = $apiUrl . '/processar-pdf';

        try {
            $response = Http::attach(
                'file', file_get_contents($pdfFile), basename($pdfFile)
            )->post($url, [
                'opcao_saida' => '2',
            ]);

            if ($response->successful()) {
                return $response->body();
            } else {
                throw new Exception('Erro na requisição: ' . $response->status());
            }
        } catch (Exception $e) {
            throw new Exception('Erro ao enviar o arquivo para a API: ' . $e->getMessage());
        }
    }
}