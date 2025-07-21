<?php

namespace App\Services;

use App\Repositories\CustomerTributacaoRepository;

class CustomerTributacaoService
{
    public function __construct(
        private CustomerTributacaoRepository $customerTributacaoRepository
    ) {}

    public function createTributacoesFromArray(int $customerId, array $tributacoes): void
    {
        $formattedTributacoes = collect($tributacoes)->map(function ($tributacao) use ($customerId) {
            return [
                'customer_id' => $customerId,
                'ano' => $tributacao['ano'],
                'cnpj_da_scp' => $tributacao['cnpj_da_scp'] ?? null,
                'forma_de_tributacao' => $tributacao['forma_de_tributacao'],
                'quantidade_de_escrituracoes' => $tributacao['quantidade_de_escrituracoes'],
            ];
        })->toArray();

        $this->customerTributacaoRepository->createMany($formattedTributacoes);
    }
}