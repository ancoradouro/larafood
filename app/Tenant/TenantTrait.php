<?php

namespace App\Tenant;

use App\Tenant\{
    TenantObserver,
    TenantScope,
};

trait TenantTrait
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::observe(TenantObserver::class);

        static::addGlobalScope(new TenantScope);
    }
    
}
