<?php

namespace App\Observers;

use App\Models\Plan;
use Illuminate\Support\Str;

class PlanObserver
{
    /**
     * Handle the Plan "created" event.
     *
     * @param  \App\Models\Plan  $Plan
     * @return void
     */
    public function creating(Plan $plan)
    {
        //$plan->name = $plan->name;
        //$plan->description = $plan->description;
        $plan->url = Str::kebab($plan->name);
        //$plan->price = $plan->price;
    }

    /**
     * Handle the Plan "updated" event.
     *
     * @param  \App\Models\Plan  $Plan
     * @return void
     */
    public function updating(Plan $plan)
    {
        //$plan->name = $plan->name;
        //$plan->description = $plan->description;
        $plan->url = Str::kebab($plan->name);
        //$plan->price = $plan->price;
    }

}
