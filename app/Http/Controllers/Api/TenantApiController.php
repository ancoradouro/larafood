<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TenantService;
use App\Http\Resources\TenantResource;

class TenantApiController extends Controller
{
    
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index()
    {

        //dd('teste');
        $tenants = $this->tenantService->getAllTenants();
        
        //$per_page = (int) $request->get('per_page', 15);

        //$tenants = $this->tenantService->getAllTenants($per_page);
        //$tenants = $this->tenantService->getAllTenants();

        return TenantResource::collection($tenants);
    }

    public function show($uuid)
    {
        if (!$tenant = $this->tenantService->getTenantByUuid($uuid)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new TenantResource($tenant);
    }
}
