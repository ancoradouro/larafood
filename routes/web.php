<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PlanController
};
use App\Http\Controllers\Admin\ACL\{
    PlanProfileController
};
use App\Http\Controllers\Admin\ACL\{
    PermissionProfileController
};
use App\Http\Controllers\Admin\{
    DetailPlanController
};

Route::middleware(['auth'])->prefix('admin')->group(function(){
    
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
    Route::get('plans/{id}/details/{idDetails}', [DetailPlanController::class, 'show'])->name('details.plan.show');
    Route::put('plans/{id}/details/{idDetails}', [DetailPlanController::class, 'update'])->name('details.plan.update');
    Route::get('plans/{id}/details/{idDetails}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
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

require __DIR__.'/auth.php';

//Route::get('/', function () { return view('welcome'); });

