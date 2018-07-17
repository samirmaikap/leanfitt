<?php

namespace App\Http\Controllers\API;

use App\Services\LeanToolService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeanToolsController extends Controller
{
    protected $service;
    public function __construct(LeanToolService $leanToolService)
    {
        $this->service=$leanToolService;
    }

    public function index(){
        try{
            $result=$this->service->index();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Lean tool has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function update(Request $request,$tool_id){
        try{
            $result=$this->service->update($request->all(),$tool_id);
            return renderSuccess($result,'Lean tool has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show($tool_id){
        try{
            $result=$this->service->show($tool_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($tool_id){
        try{
            $result=$this->service->delete($tool_id);
            return renderSuccess($result,'Lean tool has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
