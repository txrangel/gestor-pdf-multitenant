<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                        => $this->id,
            'barcode'                   => $this->barcode,
            'product'                   => $this->product,
            'product_client'            => $this->product_client,
            'product_description'       => $this->product_description,
            'product_specifications'    => $this->product_specifications,
            'sales_price'               => $this->sales_price,
            'sales_quantity'            => $this->sales_quantity,
            'delivery_date'             => $this->delivery_date->format('Y-m-d'),
        ];
    }
}
