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
            $result=$this->service->index($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
