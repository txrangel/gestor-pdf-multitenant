<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdfCreateRequest;
use App\Models\Pdf;
use App\Services\PdfService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PdfController extends Controller
{
    public function __construct(
        private PdfService $service,
    ) {}
    public function getAll(): Collection
    {
        try {
            return $this->service->getAll();
        } catch (\Exception $e) {
            throw new \Exception("Erro: $e");
        }
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        try {
            return $this->service->getPaginate(perPage: $perPage);
        } catch (\Exception $e) {
            throw new \Exception("Erro: $e");
        }
    }
    public function findById(int $id): Pdf
    {
        try {
            return $this->service->findById(id: $id);
        } catch (\Exception $e) {
            throw new \Exception("Erro: $e");
        }
    }
    public function create(): View
    {
        return view(view: 'pdf.upload');
    }
    public function ConvertPDFAPI($pdfFile,string $opcao_saida)
    {
        $user = auth()->user();
        Gate::authorize(ability: 'create', arguments: $user);
        try {
            return $this->service->ConvertPDFAPI($pdfFile,$opcao_saida);
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function store(PdfCreateRequest $request): RedirectResponse
    {
        $user = auth()->user();
        Gate::authorize(ability: 'create', arguments: $user);
        try {
            $data = [
                "name"      => $request['name'],
                "file_path" => $request['file_path']
            ];
            $pdf = $this->service->create($data);
            return redirect('/app/files/pdfs');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
}
