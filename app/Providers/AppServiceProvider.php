<?php

namespace App\Providers;


use App\Models\{
    Plan,
    Tenant,
    Category,
    Product,
};
use App\Observers\{
    PlanObserver,
    CategoryObserver,
    ProductObserver,
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
