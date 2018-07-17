<?php

namespace App\Http\Controllers\API;

use App\Services\ProjectService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    protected $service;
    public function __construct(ProjectService $projectService)
    {
        $this->service=$projectService;
    }

    public function index(Request $request){
        try{
            $result=$this->service->index($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show($project_id){
        try{
            $result=$this->service->show($project_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Project has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function update(Request $request,$project_id){
        try{
            $result=$this->service->update($request->all(),$project_id);
            return renderSuccess($result,'Project has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function archive($project_id){
        try{
            $result=$this->service->archive($project_id);
            return renderSuccess($result,'Project has been archived',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function restore($project_id){
        try{
            $result=$this->service->restore($project_id);
            return renderSuccess($result,'Project has been restored',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function complete($project_id){
        try{
            $result=$this->service->complete($project_id);
            return renderSuccess($result,'Project has been marked as completed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($project_id){
        try{
            $result=$this->service->delete($project_id);
            return renderSuccess($result,'Project has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
