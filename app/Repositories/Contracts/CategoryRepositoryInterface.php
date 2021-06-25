<?php

namespace App\Repositories\Contracts;


interface CategoryRepositoryInterface
{

    public function getCategoriesByTenantId(String $id);
    public function getCategoriesByTenantId2(int $idTenant);
    
}