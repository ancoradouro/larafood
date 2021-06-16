<?php

namespace App\Models;

use App\Tenant\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use TenantTrait;

    protected $fillable = [
        'title', 
        'flag', 
        'price', 
        'description', 
        'image',
    ];

    public function categories()
    {
        $this->belongsToMany(Category::class); // muitos para muitos
    }
}

