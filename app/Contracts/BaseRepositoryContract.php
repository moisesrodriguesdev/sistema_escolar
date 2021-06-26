<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
    public function getAll(string $orderBy, string $order, int $currentPage, int $perPage, array $filters = null): LengthAwarePaginator;

    public function create(array $data): Model;

    public function findById(int $id): Model;

    public function update(Model $model, array $data): bool;

    public function delete(Model $model): ?bool;

}
