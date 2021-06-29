<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function getProductByTenantId(string $id)
    {
        return DB::table($this->table)
                //->join('tenants', 'tenants.id', '=', 'products.tenant_id')
                ->where('tenant_id', $id)
                ->select('products.*')
                ->get();
    }

}
