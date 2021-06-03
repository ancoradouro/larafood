<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'], $num_pagination = 10;

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    /**
     * Get Plans
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    } 

    /**
     * Permission not linked with this profile
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIN('id', function($query){
            $query
                ->select('permission_id')
                ->from('permission_profile')
                ->whereRaw("profile_id=?", $this->id);
        })
        ->where(function($queryFilter) use($filter){
            if ($filter)$queryFilter->where('name', 'LIKE', "%$filter%");
        })
        ->paginate($this->num_pagination);
        //->toSql();
        //dd($permissions);

        return $permissions;
    }

}