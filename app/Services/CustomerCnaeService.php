<?php

namespace App\Services;

use App\Repositories\CustomerCnaeRepository;

class CustomerCnaeService
{
    public function __construct(
        private CustomerCnaeRepository $customerCnaeRepository
    ) {}

    public function createCnaesFromArray(int $customerId, array $cnaes): void
    {
        $formattedCnaes = collect($cnaes)->map(function ($cnae) use ($customerId) {
            return [
                'customer_id' => $customerId,
                'codigo' => $cnae['codigo'],
                'descricao' => $cnae['descricao'],
            ];
        })->toArray();

        $this->customerCnaeRepository->createMany($formattedCnaes);
    }
}