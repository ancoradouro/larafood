<?php

namespace App\Repositories\Contracts;


interface ProductRepositoryInterface
{

    public function getProductByTenantId(string $id);
}