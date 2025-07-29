<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'pdf_id'            => $this->pdf_id,
            'client_order'      => $this->client_order,
            'date'              => $this->date->format('Y-m-d'),
            'message_for_note'  => $this->message_for_note,
            'operation'         => $this->operation,
            'shipping_type'     => $this->shipping_type,
            'export'            => $this->export,
            'order_erp'         => $this->order_erp,
            'error_erp'         => $this->error_erp,
            'created_at'        => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'        => $this->updated_at->format('Y-m-d H:i:s'),
            'customer'          => new CustomerResource($this->whenLoaded('customer')),
            'items'             => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
