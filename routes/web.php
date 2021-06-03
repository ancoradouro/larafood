<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PlanController
};

Route::prefix('admin')->group(function(){
    
    /**
     * Routes Plan X Profile
     */
    Route::get('plans/{id}/profile/{idprofile}/detach', 'App\\Http\\Controllers\\Admin\\ACL\\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');
    Route::post('plans/{id}/profiles', 'App\\Http\\Controllers\\Admin\\ACL\\PlanProfileController@attachProfilePlan')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', 'App\\Http\\Controllers\\Admin\\ACL\\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', 'App\\Http\\Controllers\\Admin\\ACL\\PlanProfileController@profiles')->name('plans.profiles');
    Route::get('profiles/{id}/plans', 'App\\Http\\Controllers\\Admin\\ACL\\PlanProfileController@plans')->name('profiles.plans');


    /**
     * Routes Permissions X Profile
     */
    Route::get('profiles/{id}/permission/{idPermission}/detach', 'App\\Http\\Controllers\\Admin\\ACL\\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions', 'App\\Http\\Controllers\\Admin\\ACL\\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'App\\Http\\Controllers\\Admin\\ACL\\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'App\\Http\\Controllers\\Admin\\ACL\\PermissionProfileController@permissions')->name('profiles.permissions');
    Route::get('permissions/{id}/profile', 'App\\Http\\Controllers\\Admin\\ACL\\PermissionProfileController@profiles')->name('permissions.profiles');

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
    Route::get('plans/create', 'App\\Http\\Controllers\\Admin\\PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'App\\Http\\Controllers\\Admin\\PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'App\\Http\\Controllers\\Admin\\PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'App\\Http\\Controllers\\Admin\\PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'App\\Http\\Controllers\\Admin\\PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'App\\Http\\Controllers\\Admin\\PlanController@show')->name('plans.show');
    Route::post('plans', 'App\\Http\\Controllers\\Admin\\PlanController@store')->name('plans.store');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');

    /**
     * Routes Details Plan
     */
    Route::get('plans/{url}/details/create', 'App\\Http\\Controllers\\Admin\\DetailPlanController@create')->name('details.plan.create');
    Route::delete('plans/{id}/details/{idDetails}', 'App\\Http\\Controllers\\Admin\\DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{id}/details/{idDetails}', 'App\\Http\\Controllers\\Admin\\DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{id}/details/{idDetails}', 'App\\Http\\Controllers\\Admin\\DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{id}/details/{idDetails}/edit', 'App\\Http\\Controllers\\Admin\\DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{id}/details', 'App\\Http\\Controllers\\Admin\\DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'App\\Http\\Controllers\\Admin\\DetailPlanController@index')->name('details.plan.index');
    

    /**
     * home dashbord
     */
    Route::get('/', 'App\\Http\\Controllers\\Admin\\PlanController@index')->name('admin.index');
});

Route::get('/', function () { return view('welcome'); });
