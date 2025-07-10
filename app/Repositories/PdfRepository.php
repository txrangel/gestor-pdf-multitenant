<?php

namespace App\Repositories;

use App\Models\Pdf;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PdfRepository
{
    public function __construct(
        private Pdf $model,
    ) {}
    public function all()
    {
        return $this->model->get();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate(perPage: $perPage);
    }
    public function findById(int $id): Pdf
    {
        return $this->model->findOrFail(id: $id);
    }
    public function create(array $data): Pdf
    {
        return $this->model->create(attributes: $data);
    }
    public function update(int $id, array $data): Pdf
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