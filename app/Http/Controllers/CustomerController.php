<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use Filament\Notifications\Notification;

class CustomerController extends Controller
{
    public function __construct(
        private CustomerService $customerService
    ) {}

    public function createFromApiResponse(array $apiResponse): Customer
    {
        try {
            $customer = $this->customerService->createCustomerFromApiResponse($apiResponse);
            // Notification::make()
            //     ->success()
            //     ->title('Cliente criado com sucesso')
            //     ->send();
            return $customer;
        } catch (\Exception $e) {
            // Notification::make()
            //     ->danger()
            //     ->title('Erro ao criar cliente')
            //     ->body($e->getMessage())
            //     ->send();    
            throw $e;
        }
    }
    public function findByCNPJOrCreate(string $cnpj): Customer
    {
        return $this->customerService->findByCNPJOrCreate($cnpj);
    }
    public function getCoordinatesFromCustomer(Customer $customer):?array
    {
        return $this->customerService->getCoordinatesFromCustomer($customer);
    }
}