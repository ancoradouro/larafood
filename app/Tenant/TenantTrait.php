<?php

namespace App\Tenant;

use App\Tenant\{
    TenantObservers,
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
        static::observe(TenantObservers ::class);

        static::addGlobalScope(new TenantScope);
    }
    
}
