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

    public function getProductByTenantId(string $id, array $categories)
    {
        return DB::table($this->table)
                ->join('category_product', 'category_product.product_id', '=', 'products.id')
                ->join('categories', 'category_product.category_id', '=', 'categories.id')
                ->where('products.tenant_id', $id)
                ->where('categories.tenant_id', $id)
                ->where(function($query) use ($categories) {
                    if(!empty($categories != []))$query->whereIn('categories.id', $categories);
                })
                ->select('products.*')
                ->get();
    }

    public function getProductByUuid(string $uuid)
    {
        return DB::table($this->table)
                    ->where('uuid', $uuid)
                    ->first();
    }

    public function getProductByFlag(string $flag)
    {
        return DB::table($this->table)
                    ->where('flag', $flag)
                    ->first();
    }

}
