<?php

namespace App\Repositories;

use App\Models\CustomerPartner;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerPartnerRepository
{
    public function __construct(
        private CustomerPartner $model
    ) {}

    public function all()
    {
        return $this->model->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function findById(int $id): CustomerPartner
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): CustomerPartner
    {
        return $this->model->create($data);
    }

    public function createMany(array $partners): void
    {
        $this->model->insert($partners);
    }

    public function update(int $id, array $data): CustomerPartner
    {
        $partner = $this->findById($id);
        $partner->update($data);
        return $partner;
    }

    public function delete(int $id): bool
    {
        $partner = $this->findById($id);
        return $partner->delete();
    }
}