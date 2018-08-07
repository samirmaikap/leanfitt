<?php

namespace App\Http\Controllers\API;

use App\Services\ActionItemService;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionItemController extends Controller
{
    protected $service;
    public function __construct(ActionItemService $actionItemService)
    {
        $this->service=$actionItemService;
    }

    public function index(Request $request){
        try{
            $result=$this->service->index($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show($item_id){
        try{
            $result=$this->service->show($item_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Action item has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function update(Request $request,$item_id){
        try{
            $result=$this->service->update($request->all(),$item_id);
            return renderSuccess($result,'Action item has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getTraceAsString());
        }
    }

    public function addAssignee(Request $request){
        try{
            $result=$this->service->addAssignee($request->all());
            return renderSuccess($result,'New assignee has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function removeAssignee($item_id,$assignee_id){
        try{
            $result=$this->service->removeAssignee($item_id,$assignee_id);
            return renderSuccess($result,'Assignee has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function getAssessment(){
        try{
            $result=$this->service->getAssignment();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function addAssignment(Request $request){
        try{
            $result=$this->service->addAssignment($request->all());
            return renderSuccess($result,'Assignment has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function updateAssignment(Request $request){
        try{
            $result=$this->service->updateAssignment($request->all());
            return renderSuccess($result,'Assignment has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function removeAssignment($assignment_id){
        try{
            $result=$this->service->removeAssignment($assignment_id);
            return renderSuccess($result,'Assignment has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function archive($item_id){
        try{
            $result=$this->service->archive($item_id);
            return renderSuccess($result,'Action item has been archived',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function restore($item_id){
        try{
            $result=$this->service->restore($item_id);
            return renderSuccess($result,'Action item has been restored',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($item_id){
        try{
            $result=$this->service->delete($item_id);
            return renderSuccess($result,'Action item has been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
