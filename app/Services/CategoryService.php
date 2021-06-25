<?php

namespace App\Services;

use App\Repositories\Contracts\{
    TenantRepositoryInterface,
    CategoryRepositoryInterface,
};

class CategoryService
{
    private $tenantRepository, $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, TenantRepositoryInterface $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesById(string $id)
    {
        $tenant = $this->tenantRepository->getTenantById($id);
        return $this->categoryRepository->getCategoriesByTenantId2($tenant->id);
    }
    
}