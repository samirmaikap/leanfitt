<?php

namespace App\Http\Controllers\API;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $userService)
    {
        $this->service=$userService;
    }

    public function index(Request $request){
        try{
            $result=$this->service->all($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function list(Request $request){
        try{
            $result=$this->service->list($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function find($user_id){
        try{
            $result=$this->service->find($user_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function profile(){
        try{
            $result=$this->service->profile();
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function update(Request $request,$user_id){
        try{
            $image=$request->hasFile('image') ? $request->file('image') : '';
            $result=$this->service->update($request->all(),$image,$user_id);
            return renderSuccess($result,'User details updated',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function getRelatedOrganization($user_id){
        try{
            $result=$this->service->getRelatedOrganization($user_id);
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            $result=$this->service->create($request->all());
            return renderSuccess($result,'New user added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function delete($user_id){
        try{
            $result=$this->service->delete($user_id);
            return renderSuccess($result,'User has been deleted',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function invitation(Request $request){
        try{
            $result=$this->service->invitaton($request->all());
            return renderSuccess($result,'An inviation has been sent',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function resendInvitation($user_id){
        try{
            $result=$this->service->reInvite($user_id);
            return renderSuccess($result,'An inviation has been sent',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function suspend($user_id){
        try{
            $result=$this->service->suspend($user_id);
            return renderSuccess($result,'User has been suspended',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function restore($user_id){
        try{
            $result=$this->service->restore($user_id);
            return renderSuccess($result,'User has been restored',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
