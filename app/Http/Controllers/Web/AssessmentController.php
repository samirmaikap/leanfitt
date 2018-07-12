<?php

namespace App\Http\Controllers\Web;

use App\Repositories\LeantoolRepository;
use App\Services\AssessmentService;
use App\Services\LeanToolService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\DepartmentService;
use App\Services\UserService;
use App\Services\OrganizationService;

class AssessmentController extends Controller
{
    protected $service;
    protected $orgService;
    protected $depService;
    protected $userService;
    protected $toolService;
    public function __construct(AssessmentService $assessmentService,
                                OrganizationService $organizationService,
                                DepartmentService $departmentService,
                                UserService $userService,
                                LeanToolService $leanToolService)
    {
        $this->service=$assessmentService;
        $this->orgService=$organizationService;
        $this->depService=$departmentService;
        $this->userService=$userService;
        $this->toolService=$leanToolService;
    }

    public function index(Request $request){
        $req_data=$request->all();
        $req_data['organization']=session('organization')['id'];
        $request=new Request($req_data);

        $data['page']='Quiz';
        $data['organization_id']=$request->get('organization');
        $data['department_id']=$request->get('department');
        $data['user_id']=$request->get('user');

        $query=$this->service->list($request);
        if($query->success){
            $data['assessments']=$query->data;

        }else{
            $data['assessments']=null;
        }
        $organizations=$this->orgService->list();
        $data['organizations']=$organizations->success ? $organizations->data : null;
        if(!empty($request->get('organization'))){
            $departments=$this->depService->list($request);
            $data['departments']=$departments->success ? $departments->data : null;
        }
        else{
            $data['departments']=null;
        }
        if(!empty($request->get('department'))){
            $users=$this->userService->list($request);
            $data['users']=$users->success ? $users->data : null;
        }
        else{
            $data['users']=null;
        }

        return view('app.assessment.index',$data);
    }

    public function show(){
        $query=$this->service->show();
        $data['assessments']=$query->success ? $query->data :null;
        return view('app.assessment.show',$data);
    }

    public function create(Request $request){
        $query=$this->service->create($request);
        if($query->success){
            return redirect()->back()->with('success', $query->message);
        }
        else{
            return redirect()->back()->withErrors([$query->message]);
        }
    }
}
