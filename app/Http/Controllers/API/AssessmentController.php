<?php

namespace App\Http\Controllers\API;

use App\Services\AssessmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentController extends Controller
{
    protected $service;
    public function __construct(AssessmentService $assessmentService)
    {
        $this->service=$assessmentService;
    }

    public function index(Request $request){
        try{
            $result=$this->service->index($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function show(){
        try{
            $result=$this->service->show();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Assessment has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
