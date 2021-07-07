<?php

namespace App\Services;

use App\Repositories\Contracts\{
    TableRepositoryInterface,
    TenantRepositoryInterface,
};

class TableService
{
    protected $table, $categoryRepository;

    public function __construct(TableRepositoryInterface $categoryRepository, TenantRepositoryInterface $table)
    {
        $this->categoryRepository = $categoryRepository;
        $this->table = $table;
    }

    public function getTablesById(string $id)
    {
        $tenant = $this->table->getTenantById($id);

        return $this->categoryRepository->getTablesByTenantId2($tenant->id);
    }

    public function getTableByUrl(string $identify)
    {
        return $this->categoryRepository->getTableByIdentify($identify);
    }

    public function getTableByUuid(string $uuid)
    {
        return $this->categoryRepository->getTableByUuid($uuid);
    }

}
