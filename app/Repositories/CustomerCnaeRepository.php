<?php

namespace App\Repositories;

use App\Models\CustomerCnae;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerCnaeRepository
{
    public function __construct(
        private CustomerCnae $model
    ) {}

    public function all()
    {
        return $this->model->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function findById(int $id): CustomerCnae
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): CustomerCnae
    {
        return $this->model->create($data);
    }

    public function createMany(array $cnaes): void
    {
        $this->model->insert($cnaes);
    }

    public function update(int $id, array $data): CustomerCnae
    {
        $cnae = $this->findById($id);
        $cnae->update($data);
        return $cnae;
    }

    public function delete(int $id): bool
    {
        $cnae = $this->findById($id);
        return $cnae->delete();
    }
}