<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(TenantFormRequest $request)
    {
        // if (!$request->token_company){
        //     return response()->json(['message' => 'Token Not Found'], 404);
        // }

        //return $this->productService->getCategoriesById($request->id);

        //return response()->json(  $request->get('categories', []) );

        $products = $this->productService->getProductsByTenantId(
            $request->token_company,
            $request->get('categories', [])
        );
        return ProductResource::collection($products);
    }

    public function show(TenantFormRequest $request, $flag)
    {
        if(!$product = $this->productService->getProductByFlag($flag)){
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        return new ProductResource($product);
    }

}
