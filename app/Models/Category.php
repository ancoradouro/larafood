<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Tenant\TenantObserver;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'url', 
        'description',
        'tenant_id'
    ];

   
}
