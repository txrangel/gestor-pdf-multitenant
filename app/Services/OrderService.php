<?php
namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\OrderItemService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomerController;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderItemService $orderItemService
    ) {}
    public function getAll(): Collection
    {
        return $this->orderRepository->all();
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->orderRepository->paginate(perPage: $perPage);
    }
    public function findById(int $id): Order
    {
        return $this->orderRepository->findById(id: $id);
    }
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
    public function getByDatesForAPI($start_date,$end_date): Collection
    {
        return $this->orderRepository->getByDatesForAPI($start_date,$end_date);
    }
    public function markAsExported(int $orderId, string $erpNumber): Order
    {
        return $this->orderRepository->update($orderId,[
            'order_erp' => $erpNumber,
            'export'    => true,
            'error_erp' => null
        ]);
    }

    public function markAsFailed(int $orderId, string $errorMessage): Order
    {
        return $this->orderRepository->update($orderId,[
            'error_erp' => $errorMessage,
            'export'    => false,
            'order_erp' => null
        ]);
    }
}
