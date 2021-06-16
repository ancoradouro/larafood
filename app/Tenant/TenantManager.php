<?php

namespace App\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

Class TenantManager
{
    public function getTenantIdentify() : int
    {
        return Auth::user()->tenant_id;
    }

    public function getTenant(): Tenant
    {
        return Auth::user()->tenant; //Retorna o relacionamento de user com tenant
    }

    public function isAdmin() : bool
    {
        return in_array(Auth::user()->email, config('tenant.admins'));
    }

}
