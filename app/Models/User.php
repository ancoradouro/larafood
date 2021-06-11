<?php

/**
 * Teste de commit - 
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query, $request = null)
    {
        //return $query->where('tenant_id', Auth::user()->tenant_id);
        /*
        static::addGlobalScope('tenant', function(Builder $builder){
            $builder->where('tenant_id','=', Auth::user()->tenant_id);
        });
        */

        if($request){
            if ($request->filter) {
                $query
                    ->orWhere('name', 'LIKE', "%{$request->filter}%")
                    ->orWhere('email', $request->filter);
            }

            /*
            [pesquisar como buscar campos de forma dinamica para fazer os filtros]
            $termos = $request->only('name', 'email');           
            foreach ($termos as $nome => $valor) {
                if ($valor) { 
                    $query->orWhere($nome, 'LIKE', '%' . $value . '%');
                }
            }
            
            $iguais = $request->only('tenant_id');
            foreach ($iguais as $nome => $valor) {
                if ($valor) { 
                    $query->orWhere($nome, '=', $value);
                }
            }
            */

            $query->where('tenant_id', '=', Auth::user()->tenant_id);
            //dd($query->toSql());
        }
        
        return $query;
    }

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
/*
    public function tenant()
    {
        return $this->hasMany(Tenant::class);
    }
*/
  

}
