<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use App\Services\OrderItemService;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderItemService $orderItemService
    ) {}

    public function createOrdersFromArray(array $ordersData): void
    {
        DB::transaction(function () use ($ordersData) {
            foreach ($ordersData as $orderData) {
                $order = $this->orderRepository->create([
                    'cnpj' => $orderData['CNPJ'],
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
}
