<?php

namespace App\Services;

use App\Events\NotifySubscriptions;
use App\Events\SubscriptionResumed;
use App\Events\SubscriptionStopped;
use App\Repositories\AdminRepository;
use App\Repositories\DeleteRepository;
use App\Repositories\MediaRepository;
use App\Repositories\OrganizationAdminRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use App\Validators\CardValidator;
use App\Validators\OrganizationValidator;
use App\Validators\UserValidator;
use function auth;
use function dd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

        $subdomain_exist=$this->organizationRepository->where('subdomain',$subdomain)->exists();
        if($subdomain_exist){
            $data['organization']['subdomain']=$subdomain.rand(00,99);
        }

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
                ->trialDays(7)
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

        $event['organization_id']=$organization->id;
        event(new NotifySubscriptions($event));

        DB::commit();
        return $organization;
    }

    public function createCustom($data){
        $subdomain = str_slug(arrayValue($data['organization'],'name'));
        $data['organization']['subdomain'] = $subdomain;
        $data['organization']['featured_image']=env('UI_AVATAR').arrayValue($data['organization'],'name');

        DB::beginTransaction();
        $organization = $this->organizationRepository->create(arrayValue($data,'organization'));
        if(!$organization){
            DB::rollBack();
            throw new \Exception(config("messages.common_error"));
        }

        $subscription=$organization->newSubscription( 'main', arrayValue($data['subscription'],'plan'))
            ->trialDays(7);
//            ->create(null,[
//            'email' => $organization->email,
//            'description' => $organization->name
//        ]);
        if(!$subscription){
            DB::rollBack();
            throw new \Exception(config("messages.common_error"));
        }

        $data['admin']['password']=$data['admin']['password_confirmation']='password';
        $data['admin']['avatar']=env('UI_AVATAR').urlencode(arrayValue($data['admin'],'first_name').' '.arrayValue($data['admin'],'last_name'));
        $validator = new UserValidator($data['admin'], 'create');

        if($validator->fails()){
            throw new \Exception($validator->messages());
        }

        $admin = $this->userRepository->create($data['admin']);
        dd($admin);
        $user=$this->userRepository->find($admin->id);
        dd($user);
        $user->organizations()->attach([ $organization->id => ['is_default' => $isDefault]]);
        if(isset($organization))
        {
            $user->organizations()->attach($organization);
        }

        if(isset($data['admin']['departments']))
        {
            $user->departments()->sync($data['admin']['departments']);
        }

        if(isset($data['admin']['roles']))
        {
            $user->syncRoles($data['admin']['roles']);
        }

        if($user){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config("messages.common_error"));
        }
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

        if($proDelCount > 0 && $this->organizationRepository->forceDeleteRecord($organization)){
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

    public function cancelSubscription($organization_id){
        if(empty($organization_id))
            throw new \Exception('Organization id field is required');

        $organization=$this->organizationRepository->find($organization_id);
        if(empty($organization))
            throw new \Exception('Organization not found');

        $query=$organization->subscription('main')->cancel();
        if(!$query){
           throw new \Exception(config('messages.common_error'));
        }

        event(new SubscriptionStopped($organization));
        return;

    }

    public function resumeSubscription($organization_id){
        if(empty($organization_id))
            throw new \Exception('Organization id field is required');

        $organization=$this->organizationRepository->find($organization_id);
        if(empty($organization))
            throw new \Exception('Organization not found');

        $query=$organization->subscription('main')->resume();
        if(!$query){
            throw new \Exception(config('messages.common_error'));
        }

        event(new SubscriptionResumed($organization));
        return;
    }
}