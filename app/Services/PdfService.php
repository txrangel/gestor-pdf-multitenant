<?php
namespace App\Services;

use App\Models\Pdf;
use App\Repositories\PdfRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
class PdfService
{
    public function __construct(
        private PdfRepository $repository,
    ) {
    }
    public function getAll(): Collection
    {
        return $this->repository->all();
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginate(perPage: $perPage);
    }
    public function findById(int $id): Pdf
    {
        return $this->repository->findById(id: $id);
    }
    public function ConvertPDFAPI($pdfFile, string $opcao_saida = '2'): string
    {
        $apiUrl = config('services.api.url');
        $url = $apiUrl . '/processar-pdf';

        try {
            $response = Http::attach(
                'file',
                file_get_contents($pdfFile),
                basename($pdfFile)
            )->post($url, [
                        'opcao_saida' => $opcao_saida,
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
    public function create(array $data): Pdf
    {
        try {
            if (isset($data['file_path']))
                $data['file_path'] = $data['file_path']->store('tenants/' . tenant("id") . '/pdfs', 'public');
            $data['user_id'] = auth()->user()->id;
            return $this->repository->create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete(int $id): bool
    {
        try {
            return $this->repository->delete(id: $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function handlePdfConversion(array $data): array
    {
        try {
            $pdf = $this->findById($data['pdf_id']);
            if (!$pdf)
                throw new Exception('PDF não encontrado.');
            $pdfFilePath = Storage::disk('public')->path($pdf->file_path);
            if (!file_exists($pdfFilePath))
                throw new Exception("Arquivo PDF não encontrado: $pdfFilePath");
            $apiResponseContent  = $this->ConvertPDFAPI($pdfFilePath,'2');
            return $this->storeFile($apiResponseContent,$pdf->id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    private function handleZipExtraction(int $pdf_id, string $zipPath): array
    {
        try {
            $zip = new ZipArchive();
            $txtFilePath = 'tenants/' . tenant("id") . '/txts/' . uniqid();
            $extractPath = storage_path('app/public/' . $txtFilePath);

            if ($zip->open($zipPath) !== true)
                throw new Exception('Erro ao abrir o arquivo ZIP.');

            $zip->extractTo($extractPath);
            $zip->close();

            return [
                'pdf_id' => $pdf_id,
                'file_path' => $txtFilePath,
                'extension' => '.zip'
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    private function storeSingleTxt(int $pdf_id, string $txtPath): array
    {
        try {
            $txtContent = file_get_contents($txtPath);
            $txtFilePath = 'tenants/' . tenant("id") . '/txts/' . uniqid() . '.txt';
            Storage::disk('public')->put($txtFilePath, $txtContent);

            return [
                'pdf_id' => $pdf_id,
                'file_path' => $txtFilePath,
                'extension' => '.txt'
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function storeFile(string $apiResponseContent,int $pdf_id)
    {
        try {
            // Criar um arquivo temporário
            $tempFilePath = tempnam(sys_get_temp_dir(), 'api_response');

            // Salvar o conteúdo no arquivo temporário
            file_put_contents($tempFilePath, $apiResponseContent);

            // Determinar o tipo de arquivo
            $mimeType = mime_content_type($tempFilePath);
            // Processar o arquivo com base no tipo
            if ($mimeType === 'application/zip') {
                $result = $this->handleZipExtraction($pdf_id, $tempFilePath);
            } elseif ($mimeType === 'text/plain') {
                $result = $this->storeSingleTxt($pdf_id, $tempFilePath);
            } else {
                throw new Exception('Formato de arquivo inesperado.');
            }

            unlink($tempFilePath);

            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}