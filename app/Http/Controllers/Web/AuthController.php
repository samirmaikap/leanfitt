<?php

namespace App\Http\Controllers\Web;

use App\Events\UsersUpdated;
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

    public function recovery(){
        return view('auth.recovery');
    }

    public function checkRecovery(Request $request){
        try{
            $this->service->recovery($request->all());
            return redirect()->back()->with('success','An email has been sent with instructions');
        }catch(\Exception $e){
            return redirect()->back()->withInput($request->all())->withErrors($e->getMessage());
        }

    }

    public function changePassword(){
        return view('auth.password');
    }

    public function updatePassword(Request $request){
        try{
            $this->service->updatePassword($request->all());
            return redirect(env('APP_URL').'/login');
        }catch(\Exception $e){
            return redirect()->back()->withInput($request->all())->withErrors($e->getMessage());
        }

    }

    public function invitation(Request $request){
        try{
            $this->service->checkInvitation($request->all());
            $data['success']='Thank you joining';
            return view('auth.invitation',$data);
        }catch(\Exception $e){
            $data['error']=$e->getMessage();
            return view('auth.invitation',$data);
        }

    }
}
