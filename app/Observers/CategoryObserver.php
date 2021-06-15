<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function creating(Category $Category)
    {
        //$Category->name = $Category->name;
        //$Category->description = $Category->description;
        $Category->url = Str::kebab($Category->name);
        //$Category->price = $Category->price;
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function updating(Category $Category)
    {
        //$Category->name = $Category->name;
        //$Category->description = $Category->description;
        $Category->url = Str::kebab($Category->name);
        //$Category->price = $Category->price;
    }
    
}
