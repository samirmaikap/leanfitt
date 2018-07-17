<?php

namespace App\Http\Controllers\API;

use App\Services\QuizService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    protected $service;
    public function __construct(QuizService $quizService)
    {
        $this->service=$quizService;
    }

    public function index(){
        try{
            $result=$this->service->index();
            return renderSuccess($result,'',200);
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

    public function taken(Request $request){
        try{
            $result=$this->service->taken($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Result has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
