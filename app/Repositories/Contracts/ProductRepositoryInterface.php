<?php

namespace App\Repositories\Contracts;


interface ProductRepositoryInterface
{

    public function getProductByTenantId(string $id, array $categories);
    public function getProductByFlag(string $flag);
}