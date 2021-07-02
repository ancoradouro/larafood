<?php

namespace App\Providers;


use App\Models\{
    Plan,
    Category,
    Product,
    Client,
};
use App\Observers\{
    PlanObserver,
    CategoryObserver,
    ProductObserver,
    ClientObserver,
};
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TenantRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(
        //    TenantRepositoryInterface::class,
        //    TenantRepository::class,
        //);
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
        Client::observe(ClientObserver::class);
    }
}
