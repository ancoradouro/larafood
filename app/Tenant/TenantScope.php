<?php

namespace App\Tenant;

use App\Tenant\TenantManager;
use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Scope,
};

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $identify = app(TenantManager::class)->getTenantIdentify();

        if ($identify)
            $builder->where('tenant_id', $identify);
    }


}
