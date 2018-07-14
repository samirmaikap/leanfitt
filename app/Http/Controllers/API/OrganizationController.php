<?php

namespace App\Http\Controllers\API;

use App\Services\OrganizationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    protected $service;
    public function __construct(OrganizationService $organizationService)
    {
        $this->service=$organizationService;
    }

    public function stripe(Request $request){
         return $this->service->create($request->all());
    }
}
