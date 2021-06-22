<?php


namespace App\Contracts;


use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryContract
{
    public function getAll(array $filters = null): Collection;

}
