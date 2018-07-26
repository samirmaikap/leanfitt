<?php

namespace App\Services;


use App\Mail\PasswordResetMail;
use App\Repositories\DeviceRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\OrganizationUserRepository;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;

use App\Validators\UserValidator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    protected $repo;
    protected $deviceRepo;
    protected $recoveryRepo;
    protected $organizationRepo;
    protected $orgUserRepo;
    public function __construct(UserRepository $userRepository,
                                DeviceRepository $deviceRepository,
                                PasswordResetRepository $passwordResetRepository,
                                OrganizationRepository $organizationRepository,
                                OrganizationUserRepository $organizationUserRepository)
    {
        $this->repo=$userRepository;
        $this->deviceRepo=$deviceRepository;
        $this->recoveryRepo=$passwordResetRepository;
        $this->organizationRepo=$organizationRepository;
        $this->orgUserRepo=$organizationUserRepository;
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

            return $this->repo->logResponse($user->id);
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

        DB::beginTransaction();
        $user=$this->repo->create($data);
        if(!$user){
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

        DB::commit();
        return $this->repo->logResponse($user);

    }

    public function checkInvitation($data){
        if(empty(arrayValue($data,'token'))){
            throw  new \Exception('Invalid invitation token');
        }

        $orgUser=$this->orgUserRepo->where('invitation_token',$data['token'])->first();
        if(!$orgUser){
            throw  new \Exception('Unable to find your account');
        }

        $query=$this->orgUserRepo->fillUpdate($orgUser,['is_invited'=>0]);
        if($query){
            $this->repo->update($orgUser->user_id,['is_verified'=>1]);
            return;
        }

        throw  new \Exception(config('messages.common_error'));

    }

    public function recovery($data)
    {
        if(empty(arrayValue($data,'email'))){
           throw new \Exception('Email field is required');
        }

        $account=$this->repo->where('email',arrayValue($data,'email'))->first();
        if(!$account){
            throw new \Exception('The email address not associated with any account');
        }

        $recovery['first_name']=$account->first_name;
        $recovery['email']=arrayValue($data,'email');
        $recovery['token']=$recovery['request_id']=md5(time());
        $recovery['code']=random_int(111111,999999).substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -2);
        $recovery['user_id']=$account->id;
        $log=$this->recoveryRepo->create($recovery);

        if(!$log){
            throw new \Exception(config('messages.common_error'));
        }

        Mail::to(arrayValue($data,'email'))->send(new PasswordResetMail($recovery));
        return true;
    }

    public function updatePassword($data)
    {
        if(empty(arrayValue($data,'token'))){
            throw new \Exception('Invalid token provided');
        }

        $log=$this->recoveryRepo->where('token',$data['token'])->first();
        if(!$log){
            throw new \Exception('The request does not exist');
        }

        $account=$this->repo->find($log->user_id);

        $validator=new UserValidator($data,'update');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $query=$this->repo->fillUpdate($account,$data);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return;
    }
}