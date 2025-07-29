<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'cnpj'          => $this->cnpj,
            'razao_social'  => $this->razao_social,
            'nome_fantasia' => $this->nome_fantasia,
            'email'         => $this->email,
        ];
    }
}
