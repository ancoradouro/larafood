<?php

namespace App\Models;

use App\Tenant\TenantTrait;
use App\Tenant\Observers\TenantObservers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    //use HasFactory;

    use TenantTrait;

    protected $fillable = ['name', 'url', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class); // muitos para muitos
    }

}

