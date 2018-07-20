<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use App\Repositories\DeleteRepository;
use App\Repositories\MediaRepository;
use App\Repositories\OrganizationAdminRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use App\Validators\CardValidator;
use App\Validators\OrganizationValidator;
use function auth;
use function dd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function str_slug;
use Stripe\Stripe;
use Stripe\Token;

class OrganizationService
{
    protected $organizationRepository;
    protected $mediaRepo;
    protected $deleteRepo;
    protected $userRepository;
    
    public function __construct(OrganizationRepository $organizationRepository,
                                MediaRepository $mediaRepository,
                                DeleteRepository $deleteRepository,
                                UserRepository $userRepository)
    {
        $this->organizationRepository=$organizationRepository;
        $this->mediaRepo=$mediaRepository;
        $this->deleteRepo=$deleteRepository;
        $this->userRepository = $userRepository;
    }


    public function all()
    {
        $query=$this->organizationRepository->with('subscriptions')->withCount('users')->withCount('departments')->withCount('project')->get();
        if(!$query)
            throw new \Exception('Organization not found');
        return $query;
    }

    public function create($data)
    {
        $subdomain = str_slug(arrayValue($data['organization'],'name'));
        $data['organization']['subdomain'] = $subdomain;
        $data['organization']['featured_image']=env('UI_AVATAR').arrayValue($data['organization'],'name');

        $org_validator=new OrganizationValidator(arrayValue($data,'organization'),'create');
        if($org_validator->fails())
            throw new \Exception($org_validator->messages()->first());

        $card_validator=new CardValidator(arrayValue($data,'subscription'),'create');
        if($card_validator->fails())
            throw new \Exception($card_validator->messages()->first());

        DB::beginTransaction();
        $organization = $this->organizationRepository->create(arrayValue($data,'organization'));

        if(!empty(arrayValue($data['subscription'],'number'))){
            Stripe::setApiKey(env('STRIPE_KEY'));
            $token=Token::create(array(
                "card" => array(
                    "number" => $data['subscription']['number'],
                    "exp_month" => $data['subscription']['exp_month'],
                    "exp_year" => $data['subscription']['exp_year'],
                    "cvc" => $data['subscription']['cvc']
                )
            ));
            $stripe_token=isset($token->id) ? $token->id : null;
        }

        if(!empty($stripe_token)){
            $organization->newSubscription( 'main', arrayValue($data['subscription'],'plan'))
                ->create($stripe_token, [
                    'email' => $organization->email,
                    'description' => $organization->name
                ]);
        }

        $user = auth()->user();

        $isDefault = $user->organizations->count() ? 0 : 1;
        $user->organizations()->attach([ $organization->id => ['is_default' => $isDefault]]);
        if(!$organization){
            DB::rollBack();
            throw new \Exception(config("messages.common_error"));
        }

        DB::commit();
        return $organization;
    }

    public function updateOrganization($data,$image,$org)
    {
        if(empty($org)){
            throw  new \Exception("Organization id is required");
        }

        if(empty($data)){
            throw  new \Exception("Please provide some valid data");
        }

        DB::beginTransaction();
        if(!empty($image))
        {
            $path=Storage::putFile('public/organizations/'.$org,$image);
            $url=url(Storage::url($path));
        }
        else{
            $url=null;
        }

        if(!empty($url)){
            $data['featured_image']=$url;
        }
        $query=$this->organizationRepository->update($org,$data);
        if(!$query){
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

        DB::commit();
        return;
    }

    public function show($organization)
    {
        if(empty($organization)){
            throw new \Exception('Orgnaization field is required');
        }

        $query=$this->organizationRepository->with(['departments'=>function($query){
            $query->withCount('users')->get();
        },'roles'=>function($query){
            $query->withCount('users')->get();
        },'project','subscriptions'])->find($organization);

        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        return $query;
    }

    public function list(){
        $query=$this->organizationRepository->get(['id','name']);
        if(!$query)
            throw new \Exception(config('messages.common_error'));

//        $data=$query->map(function($item){
//            return ['id'=>$item['id'],'name'=>$item['name']];
//        });
        return $query;
    }

    public function removeOrganization($organization_id)
    {

        if(empty($organization_id)){
            throw new \Exception("organization_id is required");
        }

        DB::beginTransaction();
        $proDelCount=0;

        $organization=$this->organizationRepository->with('project.actionItem')->where('id',$organization_id)->first();

        $actonitems=isset($organization['project'][0]['actionItem']) ? $organization['project'][0]['actionItem'] : null;
        $pro_actions=count($actonitems) > 0 ? $actonitems->map(function($action){
            return $action->id;
        })->toArray() : [];

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
           return;
        }

        throw new \Exception(config('messages.common_error'));
    }

    
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


}