<?php

namespace App\Services;


use App\Mail\PasswordResetMail;
use App\Repositories\DeviceRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\AuthServiceInterface;
use App\Validators\UserValidator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthService implements AuthServiceInterface
{
    protected $repo;
    protected $deviceRepo;
    protected $recoveryRepo;
    protected $organizationRepo;
    public function __construct(UserRepository $userRepository,
                                DeviceRepository $deviceRepository,
                                PasswordResetRepository $passwordResetRepository,
                                OrganizationRepository $organizationRepository)
    {
        $this->repo=$userRepository;
        $this->deviceRepo=$deviceRepository;
        $this->recoveryRepo=$passwordResetRepository;
        $this->organizationRepo=$organizationRepository;
    }

    public function login($data)
    {
        if(Auth::attempt(['email' => arrayValue($data,'email'), 'password' => arrayValue($data,'password')], true))
        {
            $user = Auth::user();
            if(!$user){
                throw new \Exception('Your account does not exists');
            }
//
//            if($user->is_verified==0){
//                throw new \Exception("Email address is not verified");
//            }

            if(!empty(arrayValue($data,'uuid'))){
                $data['user_id']=$user->id;
                $this->updateDevice($data);
            }

            return $this->loggedUser($user->id);
        }
        else{
            throw  new AuthenticationException('Email and password does not match');
        }
    }

    protected function updateDevice($data){
        $device=$this->deviceRepo->where('user_id',$data['user_id'])->where('uuid',$data['uuid'])->first();
        if($device){
            $this->deviceRepo->fillUpdate($device,['fcm_token'=>$data['fcm_token']]);
        }
        else{
            $this->deviceRepo->create($data);
        }
    }


    public function register($data){
        $validator=new UserValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $user=$this->repo->create($data);
        if($user)
            return $this->loggedUser($user);

        throw new \Exception(config('messages.common_error'));
    }

    protected function loggedUser($user_id){
//         $user=$this->repo->with(['organizations'=>function($query){
//             $query->select(['organizations.id','name','featured_image','subdomain']);
//         }])->find($user_id);
         $organization=$this->repo->find($user_id)->organizations->where('is_default',1);
         return $organization;
    }

//    public function recovery($request)
//    {
//        $response=new \stdClass();
//        if(empty($request->get('email'))){
//            $response->success=false;
//            $response->message="Invalid email address";
//            return $response;
//        }
//
//        $account=$this->repo->where('email',$request->get('email'))->first();
//        if($account){
//            $data['first_name']=$account->first_name;
//            $data['email']=$request->get('email');
//            $data['token']=$data['request_id']=md5(time());
//            $data['code']=random_int(111111,999999).substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -2);
//            $data['user_id']=$account->id;
//            $log=$this->recoveryRepo->create($data);
//            if($log){
//                Mail::to($request->get('email'))->send(new PasswordResetMail($data));
//                $response->success=true;
//                $response->message="An email has been sent to the registered email address";
//            }
//            else{
//                $response->success=false;
//                $response->message="Something went wrong, try again later";
//            }
//
//        }
//        else{
//            $response->success=false;
//            $response->message="Unable to find your account";
//        }
//
//        return $response;
//    }
//
//
//    public function checkResetCode($code){
//        $response=new \stdClass();
//        if(empty($code)){
//            $response->success=false;
//            $response->data=null;
//            $response->message="Please enter the recovery code";
//            return $response;
//        }
//
//        $recovery_log=$this->recoveryRepo->where('code',$code)->first();
//        if($recovery_log) {
//            $account = $this->repo->find($recovery_log->user_id);
//            if($account){
//                $response->success=true;
//                $response->data=['user_id'=>$account->id];
//                $response->message="Account found";
//            }
//            else{
//                $response->success=false;
//                $response->data=null;
//                $response->message="Account not found";
//            }
//        }
//        else{
//            $response->success=true;
//            $response->data=null;
//            $response->message="Invalid code";
//        }
//
//        return $response;
//    }
//
//
//    public function updatePassword($request)
//    {
//        $response=new \stdClass();
//        if(empty($request->get('user_id'))){
//            $response->success=false;
//            $response->message="Invalid user id";
//            return $response;
//        }
//
//        $account=$this->repo->find($request->get('user_id'));
//
//        $validator=new UserValidator($request->all(),'update');
//        if($validator->fails()){
//            $response->success=false;
//            $response->message=$validator->messages()->first();
//            return $response;
//        }
//
//        if($account){
//            $data=$request->except('user_id');
//            $query=$this->repo->fillUpdate($account,$data);
//            if($query){
//                $response->success=true;
//                $response->message="Password has been updated";
//            }
//            else{
//                $response->success=false;
//                $response->message="Unable to update password";
//            }
//        }
//        else{
//            $response->success=false;
//            $response->message="Account not found";
//        }
//
//        return $response;
//    }
}