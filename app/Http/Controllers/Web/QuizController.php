<?php

namespace App\Http\Controllers\Web;

use App\Repositories\LeantoolRepository;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\LeanToolService;
use App\Services\OrganizationService;
use App\Services\QuizService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    protected $service;
    protected $orgService;
    protected $depService;
    protected $toolService;
    protected $userService;

    public function __construct(QuizService $quizService,
                                OrganizationService $organizationService,
                                DepartmentService $departmentService,
                                LeanToolService $leanToolService,
                                UserService $userService)
    {
        $this->service=$quizService;
        $this->orgService=$organizationService;
        $this->depService=$departmentService;
        $this->toolService=$leanToolService;
        $this->userService=$userService;
    }

    public function index(Request $request){
        if(!isSuperadmin() && !isAdmin()){
            $toolRepo=new LeantoolRepository();
            $tool=$toolRepo->first(['id']);
            return redirect(url('quizzes/take').'/'.$tool->id);
        }

        $data['page']='quizzes';
        $data['organization_id']=empty($request->get('organization')) ? pluckOrganization('id') : $request->get('organization') ;
        $data['department_id']=$request->get('department');
        $data['user_id']=$request->get('user');


        $data['quizs']=$this->service->taken($request->all());

        $data['organizations']=$this->orgService->list();
        $data['departments']=$this->depService->list($request->all());
        $data['users']=$this->userService->list($data['organization_id'],$data['department_id']);

        return view('app.quiz.index',$data);
    }

    public function show($tool_id){
        $data['page']='quizzes';
        $user_id=auth()->user()->id;
        $data['active_tool']=$tool_id;
        $data['tools']=$this->service->index($user_id);
        $data['quiz']=$this->service->show($tool_id,$user_id);

        return view('app.quiz.view',$data);
    }

    public function create(Request $request){
        try{
            $query=$this->service->create($request->all());
            return redirect()->back()->with(['success',$query->message]);
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
