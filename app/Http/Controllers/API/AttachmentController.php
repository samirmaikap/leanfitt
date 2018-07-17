<?php

namespace App\Http\Controllers\API;

use App\Services\AttachmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttachmentController extends Controller
{
    protected $service;
    public function __construct(AttachmentService $attachmentService)
    {
        $this->service=$attachmentService;
    }

    public function create(Request $request){
        try{
            $file=$request->hasFile('file') ? $request->file('file') : null;
            $result=$this->service->create($request->all(),$file);
            return renderSuccess($result,'New attachment has been added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($attachment_id){
        try{
            $result=$this->service->delete($attachment_id);
            return renderSuccess($result,'Attachment has been removed',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
