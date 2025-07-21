<?php

namespace App\Services;

use App\Repositories\CustomerPartnerRepository;

class CustomerPartnerService
{
    public function __construct(
        private CustomerPartnerRepository $customerPartnerRepository
    ) {}

    public function createPartnersFromArray(int $customerId, array $partners): void
    {
        $formattedPartners = collect($partners)->map(function ($partner) use ($customerId) {
            return [
                'customer_id' => $customerId,
                'pais' => $partner['pais'] ?? null,
                'nome_socio' => $partner['nome_socio'],
                'codigo_pais' => $partner['codigo_pais'] ?? null,
                'faixa_etaria' => $partner['faixa_etaria'],
                'cnpj_cpf_do_socio' => $partner['cnpj_cpf_do_socio'],
                'qualificacao_socio' => $partner['qualificacao_socio'],
                'codigo_faixa_etaria' => $partner['codigo_faixa_etaria'],
                'data_entrada_sociedade' => $partner['data_entrada_sociedade'],
                'identificador_de_socio' => $partner['identificador_de_socio'],
                'cpf_representante_legal' => $partner['cpf_representante_legal'],
                'nome_representante_legal' => $partner['nome_representante_legal'],
                'codigo_qualificacao_socio' => $partner['codigo_qualificacao_socio'],
                'qualificacao_representante_legal' => $partner['qualificacao_representante_legal'],
                'codigo_qualificacao_representante_legal' => $partner['codigo_qualificacao_representante_legal'],
            ];
        })->toArray();

        $this->customerPartnerRepository->createMany($formattedPartners);
    }
}