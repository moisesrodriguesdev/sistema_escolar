<?php


namespace App\Contracts;


interface BaseRepositoryContract
{
    public function getAll(array $filters);

}
