<?php

namespace App\Services;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Services\CustomerPartnerService;
use App\Services\CustomerCnaeService;
use App\Services\CustomerTributacaoService;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CustomerService
{
    public function __construct(
        private CustomerRepository $customerRepository,
        private CustomerPartnerService $customerPartnerService,
        private CustomerCnaeService $customerCnaeService,
        private CustomerTributacaoService $customerTributacaoService
    ) {
    }

    public function createCustomerFromApiResponse(array $apiResponse): Customer
    {
        return DB::transaction(function () use ($apiResponse) {
            // Cria o cliente principal
            $customer = $this->customerRepository->create($apiResponse);

            // Cria os sócios (qsa)
            if (!empty($apiResponse['qsa'])) {
                $this->customerPartnerService->createPartnersFromArray($customer->id, $apiResponse['qsa']);
            }

            // Cria os CNAEs secundários
            if (!empty($apiResponse['cnaes_secundarios'])) {
                $this->customerCnaeService->createCnaesFromArray($customer->id, $apiResponse['cnaes_secundarios']);
            }

            // Cria os regimes tributários
            if (!empty($apiResponse['regime_tributario'])) {
                $this->customerTributacaoService->createTributacoesFromArray($customer->id, $apiResponse['regime_tributario']);
            }

            return $customer;
        });
    }
    public function findByCNPJ(string $cnpj)
    {
        return $this->customerRepository->findByCnpj($cnpj);
    }
    public function getCustomerInfoAPI(string $cnpj): array
    {
        try {
            $cnpjLimpo = preg_replace('/[^0-9]/', '', $cnpj);
            $url = "https://brasilapi.com.br/api/cnpj/v1/{$cnpjLimpo}";
            $response = Http::get(url: $url);
            if ($response->successful()) {
                $customer = $response->json();
                return $customer;
            } else {
                return [];
            }
        } catch (Exception $e) {
            // Log::error('Falha ao buscar informações do CNPJ: ' . $e->getMessage());
            return [];
        }
    }
    public function findByCNPJOrCreate(string $cnpj): Customer
    {
        $customer = $this->findByCNPJ($cnpj);
        if (!$customer) {
            $customerInfo = $this->getCustomerInfoAPI($cnpj);
            if (!empty($customerInfo)) {
                $customer = $this->createCustomerFromApiResponse($customerInfo);
            } else {
                throw new Exception("Não foi possível encontrar ou criar o cliente com o CNPJ: $cnpj");
            }
        }
        return $customer;
    }
    public function getCoordinatesFromCustomer(Customer $customer): ?array
    {
        if (empty($customer->logradouro) || empty($customer->municipio) || empty($customer->uf)) {
            return null;
        }
        try {
            $url = 'https://nominatim.openstreetmap.org/search';
            $fullAddress = implode(', ', [
                $customer->logradouro,
                $customer->numero,
                $customer->bairro, // Adicionar o bairro ajuda muito na precisão
                $customer->municipio,
                $customer->uf,
                $customer->cep
            ]);
            $queryParams = [
                'q'             => $fullAddress, // Usando a string completa aqui
                'format'        => 'json',
                'limit'         => 1,
                'countrycodes'  => 'br' // Limita a busca ao Brasil
            ];
            $response = Http::withHeaders([
                'User-Agent' => 'GPED/1.0 (contato@gped.com.br)'
            ])->get($url, $queryParams);
            $data = $response->json();
            if (!empty($data)) {
                return [
                    'latitude' => $data[0]['lat'],
                    'longitude' => $data[0]['lon']
                ];
            }
            return null;
        } catch (Exception $e) {
            // Captura outras exceções
            // Log::error('Erro inesperado ao buscar coordenadas para o cliente ' . $customer->id . ': ' . $e->getMessage());
            return null;
        }
    }
}