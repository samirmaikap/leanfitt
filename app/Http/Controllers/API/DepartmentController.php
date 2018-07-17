<?php

namespace App\Http\Controllers\API;

use App\Services\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    protected $service;
    public function __construct(DepartmentService $departmentService)
    {
        $this->service=$departmentService;
    }

    public function index(){
        try{
            $result=$this->service->allDepartments();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function departmentList(Request $request){
        try{
            $result=$this->service->list($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show($department_id){
        try{
            $result=$this->service->details($department_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->createDepartment($request->all());
            return renderSuccess($result,'Department has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function update(Request $request,$department_id){
        try{
            $result=$this->service->updateDepartment($request->all(),$department_id);
            return renderSuccess($result,'Department has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($department_id){
        try{
            $result=$this->service->removeDepartment($department_id);
            return renderSuccess($result,'Department has been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
