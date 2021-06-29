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

    public function getProductsByTenantId(string $id)
    {
        $tenant = $this->tenantRepository->getTenantById($id);

        return $this->productRepository->getProductByTenantId($tenant->id);
    }

}
