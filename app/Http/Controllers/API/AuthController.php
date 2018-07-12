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
            return successMessage($result,'common_fetch',200);
        }catch(\Exception $e){
            return errorMessage($e->getMessage());
        }
    }

    public function register(Request $request){
        try{
            $result=$this->service->register($request->all());
            $response['success']=true;
            $response['data']=$result;
            return response()->json($response,201);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response,400);
        }
    }
}
