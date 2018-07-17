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

    public function index(){
        try{
            $result=$this->service->all();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'New organization added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show($organization_id){
        try{
            $result=$this->service->show($organization_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function update(Request $request,$organization_id){
        try{
            $image=$request->hasFile('image') ? $request->file('image') : null;
            $result=$this->service->updateOrganization($request->all(),$image,$organization_id);
            return renderSuccess($result,'Organization has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function list(){
        try{
            $result=$this->service->list();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($organization_id){
        try{
            $result=$this->service->removeOrganization($organization_id);
            return renderSuccess($result,'Organization has been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function stripe(Request $request){
         return $this->service->create($request->all());
    }
}
