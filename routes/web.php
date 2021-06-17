<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PlanController,
    DetailPlanController,
    UserController,
    CategoryController,
    ProductController,
    CategoryProductController,
    TableController,
};
use App\Http\Controllers\Admin\ACL\{
    PlanProfileController,
    PermissionProfileController,
};
use App\Http\Controllers\Site\{
    SiteController,
};

Route::middleware(['auth'])->prefix('admin')->group(function(){


     /**
     * Routes tables
     */
    Route::post('tables',  [TableController::class, 'store'])->name('tables.store');
    Route::get('tables/create',  [TableController::class, 'create'])->name('tables.create');
    Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
    Route::put('tables/{id}',  [TableController::class, 'update'])->name('tables.update');
    Route::get('tables/{id}', [TableController::class, 'show'])->name('tables.show');
    Route::get('tables/{id}/edit', [TableController::class, 'edit'])->name('tables.edit');
    Route::delete('tables/{id}', [TableController::class, 'destroy'])->name('tables.destroy');
    Route::get('tables', [TableController::class, 'index'])->name('tables.index');

    /**
     * Routes Product X category
     */
    Route::get('products/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('products.category.detach');
    Route::post('products/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attach');
    Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
    Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
    Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');

     /**
     * Routes Products
     */
    Route::post('products',  [ProductController::class, 'store'])->name('products.store');
    Route::get('products/create',  [ProductController::class, 'create'])->name('products.create');
    Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::put('products/{id}',  [ProductController::class, 'update'])->name('products.update');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    /**
     * Routes Permissions
     */
    //Route::any('categories/search', 'App\\Http\\Controllers\\Admin\\CategoryController@search')->name('categories.search');
    //Route::resource('categories', 'App\\Http\\Controllers\\Admin\\CategoryController');
    Route::post('categories',  [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/create',  [CategoryController::class, 'create'])->name('categories.create');
    Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::put('categories/{id}',  [CategoryController::class, 'update'])->name('categories.update');
    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');


    /**
     * Routes Users
     */
    //Route::any('users/search', [PlanProfileController::class, 'search'])->name('users.search');
    //Route::get('users', [UserController::class, 'index'])->name('users.index');
    //Route::any('users', [UserController::class, 'index')->name('users.index');
    //Route::resource('users', 'App\\Http\\Controllers\\Admin\\UserController');
    
    Route::post('users',  [UserController::class, 'store'])->name('users.store');
    Route::get('users/create',  [UserController::class, 'create'])->name('users.create');
    Route::any('users/search', [UserController::class, 'search'])->name('users.search');
    Route::put('users/{url}',  [UserController::class, 'update'])->name('users.update');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    
    /**
     * Routes Plan X Profile
     */
    Route::get('plans/{id}/profile/{idprofile}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach');
    Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilePlan'])->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
    Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');


    /**
     * Routes Permissions X Profile
     */
    Route::get('profiles/{id}/permission/{idPermission}/detach',  [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions',  [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create',  [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions',  [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    Route::get('permissions/{id}/profile',  [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');

    /**
     * Routes Permissions
     */
    Route::any('permissions/search', 'App\\Http\\Controllers\\Admin\\ACL\\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'App\\Http\\Controllers\\Admin\\ACL\\PermissionController');

    /**
     * Routes Profile
     */
    Route::any('profiles/search', 'App\\Http\\Controllers\\Admin\\ACL\\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'App\\Http\\Controllers\\Admin\\ACL\\ProfileController');

    /**
     * Routes Plans
     */
    Route::get('plans/create',  [PlanController::class, 'create'])->name('plans.create');
    Route::put('plans/{url}',  [PlanController::class, 'update'])->name('plans.update');
    Route::get('plans/{url}/edit',  [PlanController::class, 'edit'])->name('plans.edit');
    Route::any('plans/search',  [PlanController::class, 'search'])->name('plans.search');
    Route::delete('plans/{url}',  [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::get('plans/{url}',  [PlanController::class, 'show'])->name('plans.show');
    Route::post('plans',  [PlanController::class, 'store'])->name('plans.store');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');

    /**
     * Routes Details Plan
     */
    Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
    Route::delete('plans/{id}/details/{idDetails}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
    Route::get('plans/{id}/details/{idDetails}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
    Route::get('plans/{id}/details/{idDetails}', [DetailPlanController::class, 'show'])->name('details.plan.show');    
    Route::put('plans/{id}/details/{idDetails}', [DetailPlanController::class, 'update'])->name('details.plan.update');
    Route::post('plans/{id}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
    Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
    

    /**
     * home dashbord
     */
    Route::get('/',  [PlanController::class, 'index'])->name('admin.index');
});



Route::get('/', function () {
    return view('admin.pages.plans.create');
})->middleware(['auth'])->name('dashboard');

/**
 * Site
 */
Route::get('/register/{$url}', [SiteController::class, 'plan'])->name('plan.subscription');
Route::get('/', [SiteController::class, 'index'])->name('home-index');





require __DIR__.'/auth.php';

//Route::get('/', function () { return view('welcome'); });



