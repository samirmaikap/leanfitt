<?php

namespace App\Http\Controllers\Web;

use App\Services\DashboardService;
use function auth;
use Barryvdh\Snappy\Facades\SnappyPdf;
use function config;
use function dd;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Knp\Snappy\Pdf;
use function url;
use function view;

class DashboardController extends Controller
{
    protected $service;
    public function __construct(DashboardService $dashboardService)
    {
        $this->service=$dashboardService;
    }

    public function index(Request $request)
    {
        $organization_id=pluckOrganization('id');
        $user_id=session()->get('user')->id;
        if(isSuperadmin()){
            $data=$this->adminDashboard();
        }
        elseif(isAdmin()){
            $data=$this->adminDashboard($organization_id);
        }
        else{
            $data=$this->userDashboard($organization_id,$user_id);
        }

        $data['page']='dashboard';

        return view('app.dashboard',$data);
    }

    protected function adminDashboard($organization=null){
        $data['user']=$this->service->getUsers($organization);
        $data['department']=$this->service->getDepartments($organization);
        $data['role']=$this->service->getRoles($organization);
        $data['project']=$this->service->getProjects($organization);
        $data['quiz']=$this->service->quizTaken($organization);
        $data['assessment']=$this->service->assessmentTaken($organization);
        $data['action_items']=$this->service->getActionItems($organization);
        $data['tangibles']=$this->service->getTangible($organization);

        return $data;
    }

    protected function userDashboard($organization,$user=null){
        $data['department']=$this->service->userDepartments($user);
        $data['role']=$this->service->userRoles($user);
        $data['project']=$this->service->userProjects($user);
        $data['quiz']=$this->service->quizTaken($organization,$user);
        $data['assessment']=$this->service->assessmentTaken($organization,$user);
        $data['action_items']=$this->service->getActionItems($organization,$user);
        $data['tangibles']=$this->service->userTangible($user);

        return $data;
    }

    function makePdf(){
        $organization_id=pluckOrganization('id');
        $user_id=session()->get('user')->id;
        if(isSuperadmin()){
            $data=$this->adminDashboard();
        }
        elseif(isAdmin()){
            $data=$this->adminDashboard($organization_id);
        }
        else{
            $data=$this->userDashboard($organization_id,$user_id);
        }

//        SnappyPdf::
//        return $file->download('Dashbboard-'.date('Y-m-d').'.pdf');
    }
}
