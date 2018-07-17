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
    protected $inviteRepo;
    public function __construct(UserRepository $userRepository,
                                OrganizationRepository $organizationRepository,
                                MediaRepository $mediaRepository,
                                InvitationRepository $invitationRepository)
    {
        $this->userRepo=$userRepository;
        $this->organizationRepo=$organizationRepository;
        $this->mediaRepo=$mediaRepository;
        $this->inviteRepo=$invitationRepository;
    }

    public function all($data)
    {
        $active_organization = session('organization');
        $organization=isset($data['organization']) ? $data['organization'] : arrayValue($active_organization,'id');

//        return $this->userRepo->getUsersByOrganization($organization['id'], ['departments']);
        $query=$this->userRepo->getUsers($organization,arrayValue($data['department']));
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return renderCollection($query);
    }

    public function find($id)
    {
        return $this->userRepo->find($id);
    }

    public function list($data)
    {
        $organization=arrayValue($data,'organization');
        $department=arrayValue($data,'department');

        $query=$this->userRepo->getUsers($organization,$department);
        $query=$query->map(function($item){
            return [
                'id'=>$item['id'],
                'first_name'=>$item['first_name'],
                'last_name'=>$item['last_name']
            ];
        });
        if(!$query){
            throw  new \Exception(config('messages.common_fetch'));
        }

        return renderCollection($query);
    }

    public function profile()
    {
        $user_id=auth()->user()->id;
        if(empty($user_id)){
            throw new \Exception('User id field is required');
        }

        $query=$this->userRepo->profile($user_id);

        if(!$query){
            throw  new \Exception(config('messages.common_error'));
        }

        return $query;
    }

    public function update($data,$image,$id=null)
    {
        $user_id=empty($id) ? auth()->user()->id : $id;
        $validator=new UserValidator($$data,'update');
        if($validator->fails()){
           throw new \Exception($validator->messages()->first());
        }

        if(empty($user_id)){
            throw new \Exception('User id field is required');
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

        if (empty(arrayValue($data,'password')))
        {
            unset($data['password']);
        }

        $user = $this->userRepo->find($user_id);

        if(isset($data['departments']))
        {
            $user->departments()->sync($data['departments']);
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
        return;
    }

    public function getRelatedOrganization($id)
    {
        $user_id=empty($id) ? auth()->user()->id : $id;

        $organizations = $this->userRepo->getRelated($user_id);
        return $organizations;
    }



    public function create($data)
    {
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


    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }



}