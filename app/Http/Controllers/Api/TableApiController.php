<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TableResource;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    protected $tableService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function tablesByTenant(TenantFormRequest $request)
    {
        // if (!$request->token_company){
        //     return response()->json(['message' => 'Token Not Found'], 404);
        // }

        //return $this->tableService->getCategoriesById($request->id);
        return TableResource::collection($this->tableService->getTablesById($request->token_company));
    }

    public function show(TenantFormRequest $request, $identify)
    {
        if(!$table = $this->tableService->getTableByUrl($identify)){
            return response()->json(['message' => 'Table Not Found'], 404);
        }
        return new TableResource($table);
    }
}

