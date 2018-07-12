<?php

namespace App\Http\Controllers\Web;

use App\Services\RoleService;
use App\Services\UserService;
use function auth;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrganizationService;
use function redirect;
use function view;

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
        try
        {
            $data['organizations'] = $this->service->all();

            return view('app.organizations.index', $data);
        }
        catch(\Exception $e)
        {
            dd($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function create()
    {
        return view('app.organizations.create');
    }

    public function store(Request $request){
        try
        {
            $organization = $this->service->create($request->all());

            $relatedOrganizations = $this->userService->getRelatedOrganization(auth()->user());

//            dd($relatedOrganizations);
            // Set related organizations for switching between organizations
            session(['relatedOrganizations' => $relatedOrganizations]);

            // Redirect to newly created organization
            $url = 'http://' . $organization->subdomain . "." . $request->getHost() . '/dashboard';

            return redirect($url)->with('success', 'Welcome ' . $organization->name);

        }
        catch(\Exception $e)
        {
            return redirect()->back()->withInput($request->all())->withErrors([$e->getMessage(), $e->getTraceAsString()]);
        }
    }

    public function update(Request $request,$organization_id){
        try{
            $result=$this->service->updateOrganization( $request,$organization_id);
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }


    public function show($organization_id){
        try{
            $result=$this->service->details($organization_id);
            $data['organization'] = $result->data;
            return view('app.organizations.index', $data);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
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

    public function changeAdmin(Request $request){
        $organization_id=$request->get('organization_id');
        $employee_id=$request->get('employee_id');
        try{
            $result=$this->service->changeAdmin($employee_id,$organization_id);
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }

    public function delete($organization_id,$user_id){
        try{
            $result=$this->service->removeOrganization($organization_id,$user_id);
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }
}
