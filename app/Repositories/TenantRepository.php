<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;


class TenantRepository implements TenantRepositoryInterface
{

    protected $entity;

    public function __construct(Tenant $tenant)
    { 
        $this->entity = $tenant;
    }

    public function getAllTenants($per_page)
    {
        return $this->entity->paginate($per_page);
        //return $this->entity->all();
    }

    public function getTenantById(String $Id)
    {
        return $this->entity->where('Id', $Id)->first();
    }

    public function getTenantByUuid(String $Uuid)
    {
        return $this->entity->where('uuid', $Uuid)->first();
    }
}