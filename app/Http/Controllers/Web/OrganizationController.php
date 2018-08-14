<?php

namespace App\Http\Controllers\Web;

use App\Repositories\OrganizationRepository;
use App\Services\RoleService;
use App\Services\SubscriptionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrganizationService;
use Stripe\Plan;
use Stripe\Stripe;

class OrganizationController extends Controller
{
    protected $service;
    protected $userService;
    protected $roleService;
    protected $subscriptionService;

    public function __construct(OrganizationService $organizationService,
                                UserService $userService,
                                RoleService $roleService,
                                SubscriptionService $subscriptionService)
    {
        $this->service=$organizationService;
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->subscriptionService=$subscriptionService;
    }

    public function index(){
        $data['page']='organizations';
        $data['organizations'] = $this->service->all();
        return view('app.organizations.index', $data);
    }

    public function create()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $data['plans']=Plan::all();
        return view('app.organizations.create',$data);
    }

    public function store(Request $request){
        try
        {
            $organization = $this->service->create($request->all());

            $relatedOrganizations = $this->userService->getRelatedOrganization(session()->get('user')->id);
//            $this->roleService->create(['name' => 'Admin'], $organization->id);

            session()->forget('relatedOrganizations');

            session(['relatedOrganizations' => $relatedOrganizations]);

            $url = 'http://' . $organization->subdomain  . config('session.domain') . '/dashboard';

//            return redirect()->route($url)->with('success', 'Welcome ' . $organization->name);
            return redirect($url)->with('success', 'Welcome ' . $organization->name);

        }
        catch(\Exception $e)
        {
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage()]);
        }
    }

    public function update(Request $request,$organization_id){

        $image=$request->hasFile('image') ? $request->file('image') : null;
        try{
            $this->service->updateOrganization( $request->all(),$image,$organization_id);
            return redirect()->back()->with('success', 'Organization has been updated');
        }catch(\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function show($organization_id){
        $data['page']='organizations';
        $data['organization'] =$this->service->show($organization_id);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $data['plans']=Plan::all();
        $data['stripe']=isset($data['organization']['stripe_id']) ? $data['organization']->asStripeCustomer() : null;
        return view('app.organizations.view', $data);
    }

    public function list(){
        try{
            $result=$this->service->list();
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }

    public function cancelSubscription(){
        $organization_id=is_null(session('organization')) ? null : pluckOrganization('id');
        try{
            $this->service->cancelSubscription($organization_id);
            return redirect()->back()->with('success', 'Subscription cancelled');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function resumeSubscription(){
        $organization_id=is_null(session('organization')) ? null : pluckOrganization('id');
        try{
            $this->service->resumeSubscription($organization_id);
            return redirect()->back()->with('success', 'Subscription resumed');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function addSubscription(Request $request){
        try{
            $this->subscriptionService->create($request->all());
            return redirect()->back()->with('success', 'Subscription has been added');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function updateCard(){

    }

    public function customOrganization(Request $request){
        try{
            $this->service->createCustom($request->all());
            return redirect()->back()->with('success', 'Organization has been added');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function deleteOrganization($organization_id){
        try{
            $this->service->removeOrganization($organization_id);
            return redirect()->back()->with('success', 'Organization has been deleted');
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}
