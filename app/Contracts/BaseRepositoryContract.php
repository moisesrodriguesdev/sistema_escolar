<?php


namespace App\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
    public function getAll(array $filters = null): LengthAwarePaginator;

    public function create(array $data): Model;

    public function findById(int $id): Model;

}
