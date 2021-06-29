<?php

namespace App\Repositories;

use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTablesByTenantId(string $id)
    {
        return DB::table($this->table)
                ->join('tenants', 'tenants.id', '=', 'tables.tenant.id')
                ->where('tenant.id', $id)
                ->select('tables.*')
                ->get();
    }

    public function getTablesByTenantId2(int $idTenant)
    {
        return DB::table($this->table)
                    ->where('tenant_id', $idTenant)
                    ->get();
    }

    public function getTableByIdentify(string $identify)
    {
        return DB::table($this->table)
                    ->where('identify', $identify)
                    ->first();
    }
}
