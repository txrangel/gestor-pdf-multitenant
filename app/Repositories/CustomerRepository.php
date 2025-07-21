<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerRepository
{
    public function __construct(
        private Customer $model
    ) {}

    public function all()
    {
        return $this->model->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function findById(int $id): Customer
    {
        return $this->model->findOrFail($id);
    }

    public function findByCnpj(string $cnpj): ?Customer
    {
        return $this->model->where('cnpj', $cnpj)->first();
    }

    public function create(array $data): Customer
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Customer
    {
        $customer = $this->findById($id);
        $customer->update($data);
        return $customer;
    }

    public function delete(int $id): bool
    {
        $customer = $this->findById($id);
        return $customer->delete();
    }
}