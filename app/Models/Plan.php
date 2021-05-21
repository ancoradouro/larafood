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
<<<<<<< HEAD
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate(3);
        return $results;
=======
        return $this->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate($this->num_pagination);
>>>>>>> 64e253133598e4a069a4ee3111d2706b2132e5aa
    }

}
