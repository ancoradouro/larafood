<?php

namespace App\Models;

use App\Tenant\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = [
        'identify',
        'tenant_id', 
        'cliente_id', 
        'table_id',
        'total',
        'status',
        'comment',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
