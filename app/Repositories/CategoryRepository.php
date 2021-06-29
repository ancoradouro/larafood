<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct(){
        $this->table = 'categories';
    }

    public function getCategoriesByTenantId(String $id){

        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'categories.tenant.id')
            ->where('tenant.id', $id)
            ->select('categories.*')
            ->get();
  }

    public function getCategoriesByTenantId2(int $idTenant){

        return DB::table($this->table)->where('tenant_id', $idTenant)->get();
        
    }

    public function getCategoryByUrl(string $url)
    {
        return DB::table($this->table)->where('url', $url)->first();
    }
    
}