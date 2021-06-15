<?php

namespace App\Tenant;

use App\Tenant\TenantManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantObserver
{
    /**
     * Handle the XXX event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        $managerTenant = app(TenantManager::class);

        $model->tenant_id = $managerTenant->getTenantIdentify();
    }
}
