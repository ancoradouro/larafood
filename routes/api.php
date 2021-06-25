<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    TenantApiController,
    CategoryApiController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('/greeting', function () { return 'Hello World'; });

Route::get('/tenants/{id}', [TenantApiController::class, 'show']);
Route::get('/tenants', [TenantApiController::class, 'index']);

Route::get('/categories', [CategoryApiController::class, 'categoriesByTenants']);


