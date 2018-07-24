<?php

namespace App\Http\Controllers\API;

use App\Services\CommentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected $service;
    public function __construct(CommentService $commentService)
    {
        $this->service=$commentService;
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'Comment has been added',201);
        }catch(\Exception $e){
            return renderError($e->getTraceAsString());
        }
    }

    public function update(Request $request,$comment_id){
        try{
            $result=$this->service->update($request->all(),$comment_id);
            return renderSuccess($result,'Comment has been updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($comment_id){
        try{
            $result=$this->sevice->delete($comment_id);
            return renderSuccess($result,'Comment has been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
