<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Api\TenantFormRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;


class CategoryApiController extends Controller
{
    protected $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }

    public function categoriesByTenants(TenantFormRequest $request)
    {
        if(!$request->token_company){
             return response()->json([
                 'message' => 'Token not found'
             ], 404);
        }
        $categories = $this->CategoryService->getCategoriesById($request->token_company);
        return CategoryResource::collection($categories);
    }


    public function show(TenantFormRequest $request, $url)
    {
        if(!$category = $this->CategoryService->getCategoryByUrl($url)){
            return response()->json([
                'message' => 'Category Not Found'
            ], 404);
        }
        return new CategoryResource($category);
    }

}