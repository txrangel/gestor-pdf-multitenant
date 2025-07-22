<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function __construct(
        private Order $model,
    ) {}
    public function all()
    {
        return $this->model->get();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate(perPage: $perPage);
    }
    public function findById(int $id): Order
    {
        return $this->model->findOrFail(id: $id);
    }
    public function getByDates($start_date,$end_date): Collection
    {
        return $this->model::with(['customer', 'items'])
                ->whereBetween('date', [
                    $start_date,
                    $end_date
                ])
                ->orderBy('date', 'desc')
                ->get();
    }
    public function create(array $data): Order
    {
        return $this->model->create(attributes: $data);
    }
    public function update(int $id, array $data): Order
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