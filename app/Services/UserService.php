<?php
namespace App\Services;

use App\Events\UsersUpdated;
use App\Jobs\SendRestoreMail;
use App\Jobs\SendSuspendMail;
use App\Mail\DeactivationMail;
use App\Mail\InvitationMail;
use App\Mail\UserSuspendMail;
use App\Mail\VerificationMail;
use App\Repositories\AdminRepository;
use App\Repositories\DeviceRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\InvitationRepository;
use App\Repositories\MediaRepository;
use App\Repositories\OrganizationAdminRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\OrganizationUserRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\UserServiceInterface;
use App\Validators\EmployeeValidator;
use App\Validators\InvitationValidator;
use App\Validators\UserValidator;
use function array_values;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use function is_integer;
use function is_null;
use function session;

class UserService
{
    protected $userRepo;
    protected $organizationRepo;
    protected $mediaRepo;
    protected $orgUserRepo;
    protected $evRepo;
    public function __construct(UserRepository $userRepository,
                                OrganizationRepository $organizationRepository,
                                MediaRepository $mediaRepository,
                                OrganizationUserRepository $organizationUserRepository,
                                EvaluationRepository $evaluationRepository)
    {
        $this->userRepo=$userRepository;
        $this->organizationRepo=$organizationRepository;
        $this->mediaRepo=$mediaRepository;
        $this->orgUserRepo=$organizationUserRepository;
        $this->evRepo=$evaluationRepository;
    }

    public function all($organizationId = null, $departmentId = null, $roleId = null)
    {
//        $active_organization = session()->get('organization');
//        $organization=isset($data['organization']) ? $data['organization'] : $active_organization->id;

//        return $this->userRepo->getUsersByOrganization($organization['id'], ['departments']);
//        $query=$this->userRepo->getUsers($organization,arrayValue($data,'department'));

        $query=$this->userRepo->getUsers($organizationId, $departmentId, $roleId);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return renderCollection($query);
    }

    public function find($id)
    {
        return $this->userRepo->find($id);
    }

    public function list($organization=null,$department=null)
    {

        $query=$this->userRepo->userList($organization,$department);

        if(!$query){
            throw  new \Exception(config('messages.common_fetch'));
        }

        return renderCollection($query);
    }

    public function profile($user_id=null)
    {
        $user_id=empty($user_id) ? auth()->user()->id : $user_id;
        $organization=pluckOrganization('id');
        if(empty($user_id)){
            throw new \Exception('User id field is required');
        }

        $query=$this->userRepo->profile($user_id,$organization);
        if(!$query){
            throw  new \Exception(config('messages.common_error'));
        }

        return $query;
    }

    public function update($data,$image,$id=null)
    {
        $user_id=empty($id) ? auth()->user()->id : $id;
        if (empty(arrayValue($data,'password')))
        {
            unset($data['password']);
        }

        $validator=new UserValidator($data,'update');
        if($validator->fails()){
           throw new \Exception($validator->messages()->first());
        }

        if(empty($user_id)){
            throw new \Exception('User id field is required');
        }

        if(empty($data['roles'])){
            throw new \Exception("Roles can't be empty");
        }

        DB::beginTransaction();
        if(!empty($image))
        {
            $path=Storage::putFile('public/users/'.$user_id,$image);
            $url=url(Storage::url($path));
        }
        else{
            $url=null;
        }

        if(!empty($url)){
            $data['avatar']=$url;
        }

        $user = $this->userRepo->find($user_id);

        if(isset($data['department']))
        {
            $user->departments()->sync($data['department']);
        }

        if(isset($data['roles']))
        {
            $user->syncRoles($data['roles']);
        }

        $query=$this->userRepo->update($user_id,$data);
        if(!$query){
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

        DB::commit();
        return $query;
    }

    public function getRelatedOrganization($id)
    {
        $user_id=empty($id) ? auth()->user()->id : $id;

        $organizations = $this->userRepo->getRelated($user_id);
        return $organizations;
    }



    public function create($data)
    {
        $data['avatar']=env('UI_AVATAR').urlencode(arrayValue($data,'first_name').' '.arrayValue($data,'last_name'));
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
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    public function invitaton($data){
        if(empty(pluckOrganization('id'))){
            throw new \Exception('Unable to find your organization');
        }
        $data['organization_id']=$orgUser['organization_id']=pluckOrganization('id');

        if(empty(arrayValue($data,'email'))){
            throw new \Exception('Email id is required');
        }

        DB::beginTransaction();
        $user=$this->userRepo->where('email',arrayValue($data,'email'))->first();
        $orgUser['is_invited']=1;
        $orgUser['invitation_token']=md5(time());
        if($user){
            $orgUser['user_id']=$user->id;
        }
        else{
            $data['password']=$data['password_confirmation']='password';
            $validator=new UserValidator($data,'create');
            if($validator->fails()){
                DB::rollBack();
                throw new \Exception($validator->messages()->first());
            }

//            $query=$this->userRepo->create($data);
            $new_user=$this->create($data);
            if(!$new_user){
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
            $orgUser['user_id']=$new_user->id;
        }

        $exists=$this->orgUserRepo->where('user_id',$orgUser['user_id'])->where('organization_id',$orgUser['organization_id'])->exists();
        if(!$exists){
            $query=$this->orgUserRepo->create($orgUser);
            if(!$query){
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
            DB::commit();
            return;
        }

        DB::rollBack();
        throw new \Exception('The user already invited');

    }


    public function reInvite($user_id){
        if(empty($user_id)){
            throw new \Exception('User id is required');
        }

        if(empty(pluckOrganization('id'))){
            throw new \Exception('Unable to find your organization');
        }

        $organization_id=pluckOrganization('id');
        $user=$this->orgUserRepo->with('user')->where('organization_id',$organization_id)->where('user_id',$user_id)->first();
        if($user){
            $data['token']=$user->invitation_token;
            $data['first_name']=$user->user->first_name;
            Mail::to($user->user->email)->send(new InvitationMail($data));
            return;
        }

        throw new \Exception(config('messages.common_error'));
    }

    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }

    public function suspend($user_id){
        if(empty($user_id)){
            throw new \Exception('User id is required');
        }

        if(empty(pluckOrganization('id'))){
            throw new \Exception('Unable to find your organization');
        }

        $organization_id=pluckOrganization('id');
        $user=$this->orgUserRepo->with(['user','organization'])->where('organization_id',$organization_id)->where('user_id',$user_id)->first();
        if(!$user){
            throw new \Exception('User not found');
        }

        $query=$this->orgUserRepo->fillUpdate($user,['is_suspended'=>1]);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        $data['organization']=$user->organization->name;
        $data['first_name']=$user->user->first_name;
        $data['email']=$user->user->email;
        $event['organization_id']=$organization_id;
        event(new UsersUpdated($event));
        SendSuspendMail::dispatch($data)->onQueue('emails');
        return;
    }

    public function restore($user_id){
        if(empty($user_id)){
            throw new \Exception('User id is required');
        }

        if(empty(pluckOrganization('id'))){
            throw new \Exception('Unable to find your organization');
        }

        $organization_id=pluckOrganization('id');
        $user=$this->orgUserRepo->with(['user','organization'])->where('organization_id',$organization_id)->where('user_id',$user_id)->first();
        if(!$user){
            throw new \Exception('User not found');
        }

        $query=$this->orgUserRepo->fillUpdate($user,['is_suspended'=>0]);
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        $data['organization']=$user->organization->name;
        $data['first_name']=$user->user->first_name;
        $event['organization_id']=$organization_id;
        event(new UsersUpdated($event));
        $data['email']=$user->user->email;
        SendRestoreMail::dispatch($data)->onQueue('emails');
        return;
    }

    public function getEvaluation($user_id,$organization_id){
        if(isSuperadmin()){
            $organization=$this->orgUserRepo->where('user_id',$user_id)->get();
            $orgusers_id=$organization->pluck('id')->toArray();
        }
        else{
            $orguser=$this->orgUserRepo->where('user_id',$user_id)->where('organization_id',$organization_id)->first(['id']);
            $orgusers_id=array($orguser->id);
        }
        if(!$orgusers_id){
            throw new \Exception('User not found');
        }

        $query=$this->evRepo->getEvaluation($orgusers_id);

        return $query;
    }

    public function evaluation($data){
        $orguser=$this->orgUserRepo->where('user_id',arrayValue($data,'user_id'))->where('organization_id',arrayValue($data,'organization_id'))->first(['id']);
        if(!$orguser->id){
            throw new \Exception('User not found');
        }

        if(empty(arrayValue($data,'evaluated_by'))){
            throw new \Exception('Evaluated by field is required');
        }

        $data['organization_user_id']=$orguser->id;
        if(empty(arrayValue($data,'evaluation_id'))){
            $query=$this->evRepo->create($data);
        }
        else{
            $query=$this->evRepo->update(arrayValue($data,'evaluation_id'),$data);
        }

        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return;
    }
}