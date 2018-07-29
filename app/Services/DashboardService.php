<?php

namespace App\Services;


use App\Repositories\ActionItemAssignmentRepository;
use App\Repositories\ActionItemRepository;
use App\Repositories\AssessmentRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\KpiDataPointRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\OrganizationUserRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\QuizRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SavingsRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    protected $userRepo;
    protected $orgUserRepo;
    protected $departmentRepo;
    protected $roleRepo;
    protected $projectRepo;
    protected $actionRepo;
    protected $kpiRepo;
    protected $savingsRepo;
    protected $organizationRepo;
    protected $assessmentRepo;
    protected $quizRepo;
    public function __construct(UserRepository $userRepository,
                                OrganizationUserRepository $organizationUserRepository,
                                DepartmentRepository $departmentRepository,
                                RoleRepository $roleRepository,
                                ProjectRepository $projectRepository,
                                ActionItemRepository $actionItemRepository,
                                KpiDataPointRepository $kpiDataPointRepository,
                                SavingsRepository $savingsRepository,
                                OrganizationRepository $organizationRepository,
                                QuizRepository $quizRepository,
                                AssessmentRepository $assessmentRepository)
    {
        $this->userRepo=$userRepository;
        $this->orgUserRepo=$organizationUserRepository;
        $this->departmentRepo=$departmentRepository;
        $this->roleRepo=$roleRepository;
        $this->projectRepo=$projectRepository;
        $this->actionRepo=$actionItemRepository;
        $this->kpiRepo=$kpiDataPointRepository;
        $this->savingsRepo=$savingsRepository;
        $this->organizationRepo=$organizationRepository;
        $this->quizRepo=$quizRepository;
        $this->assessmentRepo=$assessmentRepository;
    }

    public function getUsers($organization=null){
        $query=$this->orgUserRepo
            ->where('organization_id',is_null($organization) ? null : $organization,is_null($organization) ? '!=' : '=')
            ->get();

        $data['active']=count($query->where('is_invited',0));
        $data['invited']=count($query->where('is_invited',1));
        return renderCollection($data);
    }

    public function getDepartments($organization=null){
        $query=$this->departmentRepo
            ->where('organization_id',empty($organization) ? null : $organization,empty($organization) ? '!=':'=')->count();
        return $query;
    }

    public function userDepartments($user){
        $query=$this->userRepo->find($user)->departments()->count();
        return $query;
    }

    public function getRoles($organization=null){
        return $this->organizationRepo->getRoles($organization);
    }

    public function userRoles($user){
        $query=$this->userRepo->find($user)->roles()->count();
        return $query;
    }


    public function getProjects($organization=null){
        $query=$this->projectRepo
            ->where('organization_id',empty($organization) ? null : $organization, empty($organization) ? '!=' : '=')
            ->select(['is_completed','is_archived'])->get();
        $data['completed']=count($query->where('is_completed',1));
        $data['active']=count($query->where('is_completed',0)->where('is_archived',0));
        return renderCollection($data);
    }


    public function userProjects($user){
         $query=$this->projectRepo->whereHas('members',function ($query) use($user) {
             $query->where('user_id', $user);
         })->select(['is_completed','is_archived'])->get();
        $data['completed']=count($query->where('is_completed',1));
        $data['active']=count($query->where('is_completed',0)->where('is_archived',0));
        return renderCollection($data);
    }

    public function quizTaken($organization=null,$user=null){
        return $this->assessmentRepo->allAssessment($organization,null,$user)->count();
    }

    public function assessmentTaken($organization=null,$user=null){
         return $this->quizRepo->allTaken($organization,null,$user)->count();
    }

    public function getActionItems($organization=null,$user=null){
          $query=$this->actionRepo->actionItems($organization,$user);
          return $query;
    }

    public function getTangible($organization=null){
        $query=$this->savingsRepo->whereHas('project',function($query) use ($organization) {
               $query->where('organization_id',empty($organization) ? '!=' : '=', empty($organization) ? null : $organization );
        })->where('type','tangible')->get();
//        $query= $query->map(function($item){
//            return ['created_at'=>Carbon::parse($item->created_at)->format('Y-m-d'),'value'=>$item->value];
//        });
//        return renderCollection($query);
        return $query;
    }

    public function userTangible($user){
        $query=$this->savingsRepo->whereHas('project',function($query) use ($user) {
            $query->whereHas('members',function ($query) use($user) {
                $query->where('user_id', $user);
            });
        })->where('type','tangible')->get();
        return $query;
    }


}