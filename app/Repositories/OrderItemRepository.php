<?php

namespace App\Repositories;

use App\Models\OrderItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderItemRepository
{
    public function __construct(
        private OrderItem $model,
    ) {}
    public function all()
    {
        return $this->model->get();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate(perPage: $perPage);
    }
    public function findById(int $id): OrderItem
    {
        return $this->model->findOrFail(id: $id);
    }
    public function createMany(array $items): void
    {
        $this->model->insert($items); // mais performático
    }
    public function create(array $data): OrderItem
    {
        return $this->model->create(attributes: $data);
    }
    public function update(int $id, array $data): OrderItem
    {
        $account = $this->findById(id: $id);
        $account->update(attributes: $data);
        return $account;
    }
    public function delete(int $id): bool
    {
        $account = $this->findById(id: $id);
        return $account->delete();
    }
}