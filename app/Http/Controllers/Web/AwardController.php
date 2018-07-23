<?php

namespace App\Http\Controllers\Web;

use App\Services\AwardService;
use App\Services\DepartmentService;
use App\Services\OrganizationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AwardController extends Controller
{
    protected $awardService;
    protected $orgService;
    protected $depService;
    protected $userService;

    public function __construct(AwardService $awardService,
                                OrganizationService $organizationService,
                                DepartmentService $departmentService,
                                UserService $userService)
    {
        $this->awardService=$awardService;
        $this->orgService=$organizationService;
        $this->depService=$departmentService;
        $this->userService=$userService;
    }

    public function index(Request $request){
        $data['page']='awards';
        $data['department_id']=$request->get('department');
        $data['organization_id']=$request->query('organiztion') ? $request->get('organization') : pluckSession('id');
        $data['user_id']=$request->query('user') ? $request->get('user') : auth()->user()->id;

        $data['organizations']=$this->orgService->list();
        $data['departments']=$this->depService->list($request->all());
        $data['users']=$this->userService->list($data['organization_id'],$data['department_id']);

        $data['awards']=$this->awardService->index($data['organization_id'],$data['department_id'],$data['user_id']);

        return view('app.awards.index',$data);
    }
}
