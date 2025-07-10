<?php

namespace App\Services;

use App\Repositories\OrderItemRepository;
use Illuminate\Support\Carbon;

class OrderItemService
{
    public function __construct(
        private OrderItemRepository $orderItemRepository
    ) {}

    public function createItemsFromArray(int $orderId, array $items): void
    {
        $formattedItems = collect($items)->map(function ($item) use ($orderId) {
            return [
                'order_id' => $orderId,
                'barcode' => $item['Barcode'] ?? '',
                'client_order' => $item['ClientOrder'],
                'delivery_date' => Carbon::createFromFormat('d/m/Y', $item['DeliveryDate']),
                'product' => $item['Product'] ?? '',
                'product_client' => $item['ProductClient'],
                'product_description' => $item['ProductDescription'],
                'product_specifications' => $item['ProductSpecifications'] ?? '',
                'sales_price' => $item['SalesPrice'],
                'sales_quantity' => $item['SalesQuantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        $this->orderItemRepository->createMany($formattedItems);
    }
}
