<?php
namespace App\Services;

use App\Models\Pdf;
use App\Repositories\PdfRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class PdfService
{
    public function __construct(
        private PdfRepository $repository,
    ) {}
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
    public function ConvertPDFAPI($pdfFile,string $opcao_saida = '2'): string
    {
        $apiUrl = config('services.api.url');
        $url    = $apiUrl . '/processar-pdf';

        try {
            $response = Http::attach(
                'file', file_get_contents($pdfFile), basename($pdfFile)
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
        if (isset($data['file_path']))
            $data['file_path'] = $data['file_path']->store('tenants/'.tenant("id").'/pdfs', 'public');
        return $this->repository->create($data);
    }
    public function delete(int $id): bool
    {
        try {
            return $this->repository->delete(id: $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}