<?php

namespace App\Services;

use App\Repositories\Contracts\{
    ProductRepositoryInterface,
    TenantRepositoryInterface,
};

class ProductService
{
    protected $productRepository, $tenantRepository;

    public function __construct(ProductRepositoryInterface $productRepository, TenantRepositoryInterface $tenantRepository)
    {
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantId(string $id, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantById($id);

        return $this->productRepository->getProductByTenantId($tenant->id, $categories);
    }

    public function getProductByFlag(string $flag)
    {
        return $this->productRepository->getProductByFlag($flag);
    }
}
