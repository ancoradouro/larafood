<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Plan extends Model
{
    //use HasFactory;
    protected $fillable = ['name', 'url', 'price', 'description'];
    protected $num_pagination = 3;

    public function __construct()
    {
        Paginator::useBootstrap();
    }

    public function search($filter = null)
    {
        return $this->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate($this->num_pagination);
    }

}
