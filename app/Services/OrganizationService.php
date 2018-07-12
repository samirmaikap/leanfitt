<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use App\Repositories\DeleteRepository;
use App\Repositories\MediaRepository;
use App\Repositories\OrganizationAdminRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\OrganizationServiceInterface;
use function auth;
use function dd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function str_slug;

class OrganizationService implements OrganizationServiceInterface
{
    protected $organizationRepository;
    protected $adminRepo;
    protected $orgAdminRepo;
    protected $mediaRepo;
    protected $deleteRepo;
    
    protected $userRepository;
    
    public function __construct(OrganizationRepository $organizationRepository,
                                OrganizationAdminRepository $organizationAdminRepository,
                                AdminRepository $adminRepository,
                                MediaRepository $mediaRepository,
                                DeleteRepository $deleteRepository,
                                UserRepository $userRepository)
    {
        $this->orgAdminRepo=$organizationAdminRepository;
        $this->organizationRepository=$organizationRepository;
        $this->adminRepo=$adminRepository;
        $this->mediaRepo=$mediaRepository;
        $this->deleteRepo=$deleteRepository;

        $this->userRepository = $userRepository;
    }

    public function all()
    {
//        $response=new \stdClass();
//        $query=$this->organizationRepository->withCount('employees')->withCount('departments')->withCount('project')->get();
//        if(!empty($query)){
//            $response->success=true;
//            $response->data=$query;
//            $response->message="Organizations found";
//        }
//        else{
//            $response->success=false;
//            $response->data=null;
//            $response->message="Organizations not found";
//        }
//
//        return $response;

        return $this->organizationRepository->with(['users', 'subscriptions'])->get();
    }

    public function updateOrganization($request, $org)
    {
        $response=new \stdClass();
        if(empty($org)){
            $response->success=false;
            $response->message="Invalid organization selection";
            return $response;
        }

        if(empty($request->all())){
            $response->success=false;
            $response->message="Invalid data";
            return $response;
        }

        DB::beginTransaction();
        if($request->file('image') != null)
        {
            $file = $request->file('image');
            $path=Storage::putFile('public/organizations/'.$org,$file);
            $url=url(Storage::url($path));
        }
        else{
            $url=null;
        }

        $data=$request->all();
        if(!empty($url)){
            $data['featured_image']=$url;
        }
        $query=$this->organizationRepository->update($org,$data);
        if($query){
            DB::commit();
            $response->success=true;
            $response->message="Organization has bee updated";
        }
        else{
            DB::rollBack();
            $response->success=false;
            $response->message="Something went worng, try again later";
        }

        return $response;
    }

    public function details($organization)
    {
        $response=new \stdClass();
        if(empty($organization)){
            $response->success=false;
            $response->data=null;
            $response->message="Invalid organization selection";
            return $response;
        }

        $query=$this->organizationRepository->find($organization)->with('employees','project','departments','organizationAdmin.admin')->first();
        if($query){
            $response->success=true;
            $response->data=$query;
            $response->message="Organization found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="No details available";
        }

        return $response;
    }

    public function changeAdmin($employee_id, $org)
    {
        $response=new \stdClass();
        if(empty($org)){
            $response->success=false;
            $response->message="organization_id is required";
            return $response;
        }

        if(empty($employee_id)){
            $response->success=false;
            $response->message="employee_id is required";
            return $response;
        }

        DB::beginTransaction();
        $user_id=$this->adminRepo->getUser($employee_id,'employee');
        $admin=$this->adminRepo->where('user_id',$user_id)->first();
        if(count($admin) > 0){
            $query=$this->orgAdminRepo->where('organization_id',$org)->first()->update(['admin_id'=>$admin->id]);
        }
        else{
            $admin_data['user_id']=$user_id;
            $admin_re=$this->adminRepo->create($admin_data);
            $query=$this->orgAdminRepo->where('organization_id',$org)->first()->update(['admin_id'=>$admin_re->id]);
        }

        if($query){
            DB::commit();
            $response->success=true;
            $response->message="Admin has been changed";
        }
        else{
            DB::rollBack();
            $response->success=false;
            $response->message="Something went wrong, tray again later";
        }

        return $response;
    }

    public function list(){
        $response=new \stdClass();
        $query=$this->organizationRepository->get();
        if($query){
            $data=$query->map(function($item){
                return ['id'=>$item['id'],'name'=>$item['name']];
            });
            $response->success=true;
            $response->data=$data;
            $response->message="Organization found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="Organization not found";
        }

        return $response;
    }

    public function removeOrganization($organization_id,$user_id)
    {
        $response=new \stdClass();
        if(empty($organization_id)){
            $response->success=false;
            $response->messge="organization_id is required";
            return $response;
        }

//        if(!$this->organizationRepository->isSuperAdmin($user_id) || !$this->organizationRepository->isAdmin($user_id)){
//            $response->success=false;
//            $response->messge="You don't have enough permission to delete the organization";
//            return $response;
//        }

        DB::beginTransaction();
        $proDelCount=0;

        $organization=$this->organizationRepository->with('project.actionItem')->where('id',$organization_id)->first();

        $pro_actions=count($organization['project'][0]['actionItem']) > 0 ? $organization['project'][0]['actionItem']->map(function($action){
            return $action->id;
        })->toArray() : [];

//        $report_actions=count($organization['report'][0]['actionItem']) > 0 ? $organization['report'][0]['actionItem']->map(function($action){
//            return $action->id;
//        })->toArray() : [];

        if(count($pro_actions) > 0){
            for ($i=0;$i<count($pro_actions);$i++){
                $proDel=$this->deleteRepo->deleteActionItems('project',$pro_actions[$i]);
                if($proDel){
                    $proDelCount++;
                }
            }
        }
        else{
            $proDelCount++;
        }

        if($proDelCount > 0 && $organization->forceDelete()){
            DB::commit();
            $response->success=false;
            $response->messge="Organziation has been deleted";
        }
        else{
            DB::rollBack();
            $response->success=false;
            $response->messge="Something went wrong, try again later";
        }

        return $response;
    }
    
    // New methods
    
    public function isMember($user, $subdomain)
    {
        $organizations = [];

        if(is_integer($user))
        {
            $user = $this->userRepository->find($user);
        }

        $organizations = $user->organizations;

        return $organizations;
    }

    // New methods

    public function create($data)
    {
//        dd($data);
//        $validator = new UserValidator($data, 'create');
//
//        if($validator->fails()){
//            throw new \Exception($validator->messages());
//        }

        // Set subdomain for the Organization
        $subdomain = str_slug($data['organization']['name']);
        $data['organization']['subdomain'] = $subdomain;

        $organization = $this->organizationRepository->create($data['organization']);

        // Create subscription
        //
        $organization->newSubscription( 'main', $data['subscription']['plan'])
            ->create($data['subscription']['stripeToken'], [
            'email' => $organization->email,
            'description' => $organization->name
        ]);

        // Logged in User
        $user = auth()->user();

        //  If user does not belongs to any organization, set this organization as default
        //
        $isDefault = $user->organizations->count() ? 0 : 1;
        $user->organizations()->attach([ $organization->id => ['is_default' => $isDefault]]);

        return $organization;
    }
}