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
        if(!isSuperadmin() && !isAdmin()){
            return redirect(url('assessment/take'));
        }

        $data['page']='assessment';
        $data['organization_id']=empty($request->get('organization')) ? pluckSession('id') : $request->get('organization');
        $data['department_id']=$request->get('department');
        $data['user_id']=$request->get('user');

        $data['assessments']=$this->service->index($request->all());
        $data['organizations']=$this->orgService->list();
        $data['departments']=$this->depService->list($request->all());
        $data['users']=$this->userService->list($data['organization_id'],$data['department_id']);

        return view('app.assessment.index',$data);
    }

    public function show(){
        $data['page']='assessment';
        $data['assessments']=$this->service->show();
        return view('app.assessment.show',$data);
    }

    public function create(Request $request){
        try{
            $query=$this->service->create($request->all());
            return redirect()->back()->with('success', $query->message);
        }catch (\Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}
