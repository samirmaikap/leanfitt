<?php

namespace App\Http\Controllers\Web;

use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\LeanToolService;
use App\Services\OrganizationService;
use App\Services\QuizService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    protected $service;
    protected $orgService;
    protected $depService;
    protected $toolService;
    public function __construct(QuizService $quizService,
                                OrganizationService $organizationService,
                                DepartmentService $departmentService,
                                LeanToolService $leanToolService)
    {
        $this->service=$quizService;
        $this->orgService=$organizationService;
        $this->depService=$departmentService;
        $this->toolService=$leanToolService;
    }

    public function index(Request $request){
        $req_data=$request->all();
//        if(session('role')=='admin'){
//            $req_data['organization']=session('organization_id');
//        }
        $req_data['organization']=session('organization')['id'];
        $request=new Request($req_data);
        $data['page']='Quiz';
        $data['organization_id']=$request->get('organization');
        $data['department_id']=$request->get('department');
        $data['user_id']=$request->get('user');


        $query=$this->service->taken($request);
        if($query->success){
            $data['quizs']=$query->data;

        }else{
            $data['quizs']=null;
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

        return view('app.quiz.index',$data);
    }

    public function show($domain,$tool_id){
        $user_id=auth()->user()->id;
        $data['active_tool']=$tool_id;
        $tools=$this->service->index($user_id);
        $data['tools']=$tools->success ? $tools->data : null;
        $query=$this->service->show($tool_id,$user_id);
        $data['quiz']=$query->success ? $query->data : null;
        return view('app.quiz.view',$data);
    }

    public function create(Request $request){
        $query=$this->service->create($request);
        if($query->success){
            return redirect()->back()->with(['success',$query->message]);
        }
        else{
            return redirect()->back()->withErrors($query->message);
        }
    }
}
