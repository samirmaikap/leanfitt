<?php

namespace App\Http\Controllers\API;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $service;
    public function __construct(AuthService $authService)
    {
        $this->service=$authService;
    }

    public function login(Request $request){
        try{
            $result=$this->service->login($request->all());
            return renderSuccess($result,'',200);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }

    public function register(Request $request){
        try{
            $result=$this->service->register($request->all());
            return renderSuccess($result,'New user added',201);
        }catch(\Exception $e){
            return renderError($e->getMessage());
        }
    }
}
