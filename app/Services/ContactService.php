<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactService
{
    public function __construct(
        private ContactRepository $repository,
    ) {}
    public function getAll()
    {
        return $this->repository->all();
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginate(perPage: $perPage);
    }
    public function findById(int $id): Contact
    {
        return $this->repository->findById(id: $id);
    }
    public function create(array $data): Contact
    {
        try {
            return $this->repository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update(int $id, array $data): Contact
    {
        try {
            return $this->repository->update(id: $id, data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete(int $id): bool
    {
        try {
            return $this->repository->delete(id: $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}