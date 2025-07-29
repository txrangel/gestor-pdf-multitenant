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
    public function getByDatesForAPI($start_date,$end_date): Collection
    {
        return $this->model::with(['customer', 'items'])
                ->whereBetween('date', [
                    $start_date,
                    $end_date
                ])
                ->where('export',false)
                ->orderBy('id')
                ->orderBy('date', 'desc')
                ->get();
    }
    public function create(array $data): Order
    {
        return $this->model->create(attributes: $data);
    }
    public function update(int $id, array $data): Order
    {
        $order = $this->findById(id: $id);
        $order->update(attributes: $data);
        return $order;
    }
    public function delete(int $id): bool
    {
        $order = $this->findById(id: $id);
        return $order->delete();
    }
}