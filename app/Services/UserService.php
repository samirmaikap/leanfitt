<?php
namespace App\Services;

use App\Mail\DeactivationMail;
use App\Mail\VerificationMail;
use App\Repositories\AdminRepository;
use App\Repositories\DeviceRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\InvitationRepository;
use App\Repositories\MediaRepository;
use App\Repositories\OrganizationAdminRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\UserServiceInterface;
use App\Validators\EmployeeValidator;
use App\Validators\UserValidator;
use function array_values;
use function dd;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use function is_integer;
use function is_null;
use function session;

class UserService //implements UserServiceInterface
{
    protected $userRepo;
    protected $employeeRepo;
    protected $adminRepo;
    protected $orgAdminRepo;
    protected $organizationRepo;
    protected $mediaRepo;
    protected $deviceRepo;
    protected $inviteRepo;
    public function __construct(UserRepository $userRepository,
                                EmployeeRepository $employeeRepository,
                                AdminRepository $adminRepository,
                                OrganizationAdminRepository $organizationAdminRepository,
                                OrganizationRepository $organizationRepository,
                                MediaRepository $mediaRepository,
                                DeviceRepository $deviceRepository,
                                InvitationRepository $invitationRepository)
    {
        $this->userRepo=$userRepository;
        $this->employeeRepo=$employeeRepository;
        $this->adminRepo=$adminRepository;
        $this->organizationRepo=$organizationRepository;
        $this->orgAdminRepo=$organizationAdminRepository;
        $this->mediaRepo=$mediaRepository;
        $this->inviteRepo=$invitationRepository;
    }


//    public function signup($request)
//    {
//        $response=new \stdClass();
//
//        $validator=new UserValidator($request->all(),'create');
//        if($validator->fails()){
//            $response->success=false;
//            $response->message=$validator->messages()->first();
//            return $response;
//        }
//
//        $exist_email=$this->userRepo->where('email',$request->get('email'))->exists();
//        if($exist_email){
//            $response->success=false;
//            $response->message="Email already been taken";
//            return $response;
//        }
//
//        $exist_phone=$this->userRepo->where('phone',$request->get('phone'))->exists();
//        if($exist_phone){
//            $response->success=false;
//            $response->message="Phone has already been taken";
//            return $response;
//        }
//
//        DB::beginTransaction();
//        $user_data=$request->all();
//        $user_data['verification_token']=md5(time());
//        $user=$this->userRepo->create($user_data);
//        if($user){
//            $data['user_id']=$user->id;
//            $admin=$this->adminRepo->create($data);
//            $contact_person=$user->first_name.' '.$user->last_name;
//            $organization=$this->organizationRepo->create(['contact_person'=>$contact_person]);
//            $org_data['organization_id']=$organization->id;
//            $org_data['admin_id']=$admin->id;
//            $orgadmin=$this->orgAdminRepo->create($org_data);
//            if($admin && $organization && $orgadmin){
//                Mail::to($user->email)->send(new VerificationMail($user->toArray()));
//                DB::commit();
//                $response->success=true;
//                $response->message="An verification email has been sent";
//            }
//            else{
//                DB::rollBack();
//                $response->success=false;
//                $response->message="Something went wrong, try again later";
//            }
//        }
//        else{
//            DB::rollBack();
//            $response->success=false;
//            $response->message="Something went wrong, try again later";
//        }
//
//        return $response;
//    }
//
//    public function accounts($user_id)
//    {
//        $response=new \stdClass();
//        if(empty($user_id)){
//            $response->success=false;
//            $response->message="Invalid user selection";
//            return $response;
//        }
//
//        $admins=$this->orgAdminRepo->AllOrganizationByAdmin($user_id);
//        $data=$admins->map(function($item){
//           return ['organization_name'=>$item['name'],'organization_id'=>$item['id'],'role'=>'admin'];
//        });
//
//        $employee=$this->employeeRepo->checkEmployee($user_id);
//        if($employee){
//            $data_employee['organization_name']=$employee['department']['organization']['name'];
//            $data_employee['organization_id']=$employee['department']['organization']['id'];
//            $data_employee['role']='employee';
//            $data=$data->push(new Collection($data_employee));
//        }
//
//        return $data;
//    }
//
//    public function profile($user_id)
//    {
//        $response=new \stdClass();
//        if(empty($user_id)){
//            $response->success=false;
//            $response->message="Invalid account selection";
//            return $response;
//        }
//
//        $query=$this->userRepo->profile($user_id);
//
//        if($query){
//            if(count($query['employee']) > 0){
//                $is_employee=true;
//                $department=$query['employee']['department']['name'];
//                $department_id=$query['employee']['department']['id'];
//            }
//            else{
//                $is_employee=false;
//                $department=$department_id=null;
//            }
//            $data= [
//                'full_name'=>$query['first_name'].' '.$query['last_name'],
//                'email'=>$query['email'],
//                'phone'=>$query['phone'],
//                'avatar'=>$query['avatar'],
//                'is_verified'=>$query['is_verified'],
//                'is_employee'=>$is_employee,
//                'department_name'=>$department,
//                'department_id'=>$department_id,
//                'is_admin'=>count($query['admin']['organizationAdmin'][0]['organization']) > 0 ? true : false,
//                'organization_count'=>count($query['admin']['organizationAdmin'][0]['organization']),
//                'organizations'=>isset($query['admin']['organizationAdmin'][0]['organization']) ? $query['admin']['organizationAdmin'][0]['organization'] : null,
//                'assignee_count'=>$query['assignee_count'],
//                'award_count'=>$query['award_count'],
//                'quiz_count'=>$query['quiz_count'],
//            ];
//
//            $response->success=true;
//            $response->data=$data;
//            $response->message="Profile found";
//        }
//        else{
//            $response->success=false;
//            $response->data=null;
//            $response->message="Something went wrong, try again later";
//        }
//
//        return $response;
//    }
//
//    public function update($request, $user_id)
//    {
//        $response=new \stdClass();
//        $validator=new UserValidator($request->all(),'update');
//        if($validator->fails()){
//            $response->success=false;
//            $response->message=$validator->messages()->first();
//            return $response;
//        }
//
//        if(empty($user_id)){
//            $response->success=false;
//            $response->message="Invalid user selection";
//            return $response;
//        }
//
//        if(!empty($request->get('email'))){
//            $email_exist=$this->userRepo->where('email',$request->email)->exists();
//            if($email_exist){
//                $response->success=false;
//                $response->message="The email address is associated with another account";
//                return $response;
//            }
//        }
//
//        if(!empty($request->get('phone'))){
//            $email_exist=$this->userRepo->where('phone',$request->phone)->exists();
//            if($email_exist){
//                $response->success=false;
//                $response->message="The phone number is associated with another account";
//                return $response;
//            }
//        }
//
//        DB::beginTransaction();
//        if($request->file('image') != null)
//        {
//            $file=$request->file('image');
//            $path=Storage::putFile('public/users/'.$user_id,$file);
//            $url=url(Storage::url($path));
//        }
//        else{
//            $url=null;
//        }
//
//        $data=$request->all();
//        if(!empty($url)){
//            $data['avatar']=$url;
//        }
//
//        $query=$this->userRepo->update($user_id,$data);
//        if($query){
//            DB::commit();
//            $response->success=true;
//            $response->message="Profile has been updated";
//            return $response;
//        }
//        else{
//            DB::rollBack();
//            $response->success=false;
//            $response->message="Something went wrong, try again later";
//            return $response;
//        }
//    }
//
//    public function delete($user_id)
//    {
//        $response=new \stdClass();
//        if(empty($user_id)){
//            $response->success=false;
//            $response->message="user_id is required";
//            return $response;
//        }
//
//        DB::beginTransaction();
//        $user=$this->userRepo->find($user_id);
//
//        /*Stop Subscription*/
//
//        $query=$user->forceDelete($user_id);
//        if($query){
//            Mail::to($user->email)->send(new DeactivationMail($user->toArray()));
//            DB::commit();
//            $response->success=true;
//            $response->message="Account has been deleted";
//            return $response;
//        }
//        else{
//            DB::rollBack();
//            $response->success=false;
//            $response->message="Something went wrong, try again later";
//            return $response;
//        }
//
//        return $response;
//    }
//
//    public function joinEmployee($request)
//    {
//        $response=new \stdClass();
//        $validator=new EmployeeValidator($request->all(),'create');
//        if($validator->fails()){
//            $response->success=false;
//            $response->message=$validator->messages()->first();
//            return $response;
//        }
//
//        $exists=$this->employeeRepo->where('user_id',$request->get('user_id'))->exists();
//        if($exists){
//            $response->success=false;
//            $response->message="You have already joined as employee";
//            return $response;
//        }
//
//        DB::beginTransaction();
//        $query=$this->employeeRepo->create($request->all());
//        if($query){
//            DB::commit();
//            $response->success=true;
//            $response->message="You've joined as employee";
//        }
//        else{
//            DB::rollBack();
//            $response->success=false;
//            $response->message="Something went wrong, try again later";
//        }
//
//        return $response;
//    }

   //Added on 7/10 Samir
    public function index($request){
        $response=new \stdClass();
        $organization=$request->get('organization');
        $department=$request->get('department');

        $users=$this->userRepo->getEmployees();
        $admin=$this->userRepo->getAdmin($organization);


        if(!empty($organization)){
            $query=$users->where('organization_id',$organization);
            $invited=$this->inviteRepo->where('organization_id',$organization)->where('is_joined',0)->get();
            if($invited){
                $invited_col=$invited->map(function($item){
                    return  [
                        "id"=> null,
                        "user_id"=> null,
                        "department_id"=> $item['department_id'],
                        "designation"=> null,
                        "is_archived"=> 0,
                        "created_at"=> Carbon::parse($item['created_at'])->format('Y-m-d H:i:s'),
                        "updated_at"=> Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s'),
                        "organization_id"=> $item['organization_id'],
                        "department_name"=> null,
                        "first_name"=> $item['first_name'],
                        "last_name"=> $item['last_name'],
                        "email"=> $item['email'],
                        "phone"=> $item['phone'],
                        "avatar"=> "https://ui-avatars.com/api/?name=".$item['first_name'],
                        "invitaion_id"=>$item['id'],
                        "status"=> "Invited"
                    ];
                });
            }
            else{
                $invited_col=null;
            }
        }

        if(!empty($department)){
            $query=$query->where('department_id',$department);
        }

        $data= $query->orderBy('created_at','desc')->get();
        $data=$data->map(function($item){
            $item=collect($item);
            $return=$item->except('user')->toArray();
            $return['status']='Joined';
            return $return;
        });

        dd($data->merge(new Collection($admin)));
        if(isset($invited_col) && count($invited_col) > 0){
            $data=$data->merge($invited_col->toArray());
        }

        if($data->count() > 0){
            $response->success=true;
            $response->data=$data;
            $response->message="Employees available";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="No employees available";
        }

        return $response;
    }


    // New methods

    public function getRelatedOrganization($user)
    {
        if(is_integer($user))
        {
            $user = $this->userRepo->with(['organizations'])->find($user);
        }
        return $user->organizations;
    }

    public function getDefaultOrganization($user)
    {
//        if(is_integer($user))
//        {
//            $user = $this->userRepo->find($user);
//        }
//
//         return $user->load(['organizations' => function($query) {
//            return $query->where('organization_user.is_default', '=', 1);
//        }])->organizations()->first();

        $organizations = $this->getRelatedOrganization($user);
    }

    public function all()
    {
        $organization = session('organization');
//        return $this->userRepo->with(['organizations'])->get();
//        return $this->userRepo->getUsersByOrganization($organization->id, ['departments']);
        return $this->userRepo->getUsersByOrganization($organization['id'], ['departments']);
    }

    public function create($data)
    {
//        dd($data);
        $validator = new UserValidator($data, 'create');

        if($validator->fails()){
            throw new \Exception($validator->messages());
        }
        $user = $this->userRepo->create($data);

        if(isset($data['organization']))
        {
            $user->organizations()->attach($data['organization']);
        }

        if(isset($data['departments']))
        {
            $user->departments()->sync($data['departments']);
        }

        if(isset($data['roles']))
        {
//            $user->roles()->sync([$data['roles']]);
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    public function update($data, $id)
    {
//        dd($data);

        if (is_null($data['password']))
        {
            unset($data['password']);
        }

        $user = $this->userRepo->find($id);

        if(isset($data['departments']))
        {
            $user->departments()->sync($data['departments']);
        }

        if(isset($data['roles']))
        {
//            $user->roles()->sync([$data['roles']]);
            $user->syncRoles($data['roles']);
        }

        return $this->userRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }

    public function find($id)
    {
        return $this->userRepo->find($id);
    }

    /*Samir 7/10*/
    public function list($request)
    {
        $response=new \stdClass();
        $organization=$request->get('organization');
        $department=$request->get('department');

        $query=$this->userRepo->getEmployees();
        if(!empty($organization)){
            $query=$query->where('organization_id',$organization);
        }

        if(!empty($department)){
            $query=$query->where('department_id',$department);
        }

        $query=$query->get();

        $data=$query->map(function($item){
            return ['id'=>$item['id'],'name'=>$item['first_name'].' '.$item['last_name']];
        });

        if($data->count() > 0){
            $response->success=true;
            $response->data=$data->sortBy('full_name');
            $response->message="List available";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="List not available";
        }

        return $response;
    }
}