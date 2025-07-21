<?php

namespace App\Repositories;

use App\Models\CustomerTributacao;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerTributacaoRepository
{
    public function __construct(
        private CustomerTributacao $model
    ) {}

    public function all()
    {
        return $this->model->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function findById(int $id): CustomerTributacao
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): CustomerTributacao
    {
        return $this->model->create($data);
    }

    public function createMany(array $tributacoes): void
    {
        $this->model->insert($tributacoes);
    }

    public function update(int $id, array $data): CustomerTributacao
    {
        $tributacao = $this->findById($id);
        $tributacao->update($data);
        return $tributacao;
    }

    public function delete(int $id): bool
    {
        $tributacao = $this->findById($id);
        return $tributacao->delete();
    }
}