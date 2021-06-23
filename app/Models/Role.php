<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'], $num_pagination = 10;

    /**
     * Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profil::class);
    }

    /**
     * Get Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Permission not linked with this profile
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIN('permissions.id', function($query){
            $query
                ->select('permission_role.permission_id')
                ->from('permission_role')
                ->whereRaw("permission_role.role_id={$this->id}");
        })
        ->where(function($queryFilter) use($filter){
            if ($filter)$queryFilter->where('permissions.name', 'LIKE', "%$filter%");
        })
        ->paginate($this->num_pagination);
        //->toSql();
        //dd($permissions);

        return $permissions;
    }

}