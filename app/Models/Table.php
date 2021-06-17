<?php

namespace App\Models;

use App\Tenant\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['identify', 'description'], $num_pagination = 10;
}
