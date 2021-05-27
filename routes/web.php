<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){

    
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
    Route::get('plans', 'App\\Http\\Controllers\\Admin\\PlanController@index')->name('plans.index');

    /**
     * Routes Details Plan
     */
    Route::get('plans/{url}/details', 'App\\Http\\Controllers\\Admin\\DetailPlanController@index')->name('details.plan.index');
    
    
    /**
     * home dashbord
     */
    Route::get('/', 'App\\Http\\Controllers\\Admin\\PlanController@index')->name('admin.index');
});

Route::get('/', function () {
    return view('welcome');
});
