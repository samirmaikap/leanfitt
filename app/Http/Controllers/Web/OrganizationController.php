<?php

namespace App\Http\Controllers\Web;

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
        try
        {
            $data['organizations'] = $this->service->all();

            return view('app.organizations.index', $data);
        }
        catch(\Exception $e)
        {
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
        try{
            $result=$this->service->updateOrganization( $request->all(),null,$organization_id);
            return response()->json($result);
        }catch(\Exception $e){
            $response['success']=false;
            $response['message']=$e->getMessage();
            return response()->json($response);
        }
    }


    public function show($organization_id){
        try{
            $result=$this->service->show($organization_id);
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

//    public function delete($organization_id){
//        try{
//            $result=$this->service->removeOrganization($organization_id);
//            return response()->json($result);
//        }catch(\Exception $e){
//
//        }
//    }
}
