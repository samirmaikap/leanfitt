<?php

namespace App\Http\Controllers\Web;

use App\Repositories\OrganizationRepository;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrganizationService;

class OrganizationController extends Controller
{
    protected $service;
    protected $userService;
    protected $roleService;

    public function __construct(OrganizationService $organizationService, UserService $userService, RoleService $roleService)
    {
        $this->service=$organizationService;
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index(){
        $data['page']='organizations';
        $data['organizations'] = $this->service->all();
        return view('app.organizations.index', $data);
    }

    public function create()
    {
        $data['page']='organizations';
        return view('app.organizations.create');
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
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage(), $e->getTraceAsString()]);
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
        $data['stripe']=$data['organization']->asStripeCustomer();
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
        if(empty($organization_id))
            return redirect()->back()->withErrors([config('messages.common_error')]);

        $orgRepo=new OrganizationRepository();

        $organization=$orgRepo->find($organization_id);
        if(empty($organization))
            return redirect()->back()->withErrors([config('messages.common_error')]);

        $query=$organization->subscription('main')->cancel();
        if($query){
            return redirect()->back()->with('success', 'Subscription cancelled');
        }
        else{
            return redirect()->back()->withErrors([config('messages.common_error')]);
        }
    }

    public function resumeSubscription(){
        $organization_id=is_null(session('organization')) ? null : pluckOrganization('id');
        if(empty($organization_id))
            return redirect()->back()->withErrors([config('messages.common_error')]);

        $orgRepo=new OrganizationRepository();

        $organization=$orgRepo->find($organization_id);
        if(empty($organization))
            return redirect()->back()->withErrors([config('messages.common_error')]);

        $query=$organization->subscription('main')->resume();
        if($query){
            return redirect()->back()->with('success', 'Subscription cancelled');
        }
        else{
            return redirect()->back()->withErrors([config('messages.common_error')]);
        }
    }
}
