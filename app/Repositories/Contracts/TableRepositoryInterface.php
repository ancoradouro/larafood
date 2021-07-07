<?php

namespace App\Repositories\Contracts;
interface TableRepositoryInterface
{
    public function getTablesByTenantId(string $id);
    public function getTablesByTenantId2(int $idTenant);
    public function getTableByIdentify(string $identify);
    public function getTableByUuid(string $uuid);
}
