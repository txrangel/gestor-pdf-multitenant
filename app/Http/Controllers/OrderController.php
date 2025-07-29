<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Services\OrderService;
use App\Services\PdfService;
use Filament\Notifications\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function __construct(
        private PdfService $pdfService,
        private OrderService $orderService
    ) {}

    public function create(Pdf $pdf): JsonResponse
    {
        $pdfFilePath = Storage::disk('public')->path($pdf->file_path);
        if (!file_exists($pdfFilePath))
            throw new \Exception("Arquivo PDF não encontrado: $pdfFilePath");
        $json = $this->pdfService->ConvertPDFAPI($pdfFilePath, '3');
        $orders = json_decode($json, true);
        if (is_array($orders)) {
            $this->orderService->createOrdersFromArray($orders, $pdf->id);
                Notification::make()
                ->success()
                ->title('Pedido criado.')
                ->send();
            return response()->json(['message' => 'Pedidos importados com sucesso!']);
        }
        return response()->json(['error' => 'Erro ao converter PDF para JSON'], 422);
    }
}