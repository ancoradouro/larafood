<?php

namespace App\Repositories\Contracts;


interface TenantRepositoryInterface
{

    public function getAllTenants($per_page);
    public function getTenantById(String $Id);
    
}