<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\PdfService;

class OrderController extends Controller
{
    public function __construct(
        private PdfService $pdfService,
        private OrderService $orderService
    ) {}

    public function create(string $pdfFilePath)
    {
        if (!file_exists($pdfFilePath)) {
            throw new \Exception("Arquivo PDF não encontrado: $pdfFilePath");
        }

        $json = $this->pdfService->ConvertPDFAPI($pdfFilePath, '3');

        $orders = json_decode($json, true);

        if (is_array($orders)) {
            $this->orderService->createOrdersFromArray($orders);
            return response()->json(['message' => 'Pedidos importados com sucesso!']);
        }

        return response()->json(['error' => 'Erro ao converter PDF para JSON'], 422);
    }
}