<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use App\Services\OrderItemService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomerController;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderItemService $orderItemService
    ) {}

    public function createOrdersFromArray(array $ordersData,int $pdf_id): void
    {
        DB::transaction(function () use ($ordersData, $pdf_id) {
            foreach ($ordersData as $orderData) {
                $customer = app(CustomerController::class)->findByCNPJOrCreate($orderData['CNPJ']);
                $order = $this->orderRepository->create([
                    'pdf_id' => $pdf_id,
                    'customer_id' => $customer->id,
                    'client_order' => $orderData['ClientOrder'],
                    'date' => \Carbon\Carbon::createFromFormat('d/m/Y', $orderData['Date']),
                    'message_for_note' => $orderData['MessageForNote'] ?? '',
                    'operation' => $orderData['Operation'],
                    'shipping_type' => $orderData['ShippingType'],
                ]);

                $this->orderItemService->createItemsFromArray($order->id, $orderData['Items']);
            }
        });
    }
    public function getByDates($start_date,$end_date): Collection
    {
        return $this->orderRepository->getByDates($start_date,$end_date);
    }
}
