<?php

namespace App\Repositories;


use App\Models\AssessmentResult;
use App\Repositories\Contracts\AssessmentRepositoryInterface;

class AssessmentRepository extends BaseRepository //implements AssessmentRepositoryInterface
{
    public function model()
    {
        return new AssessmentResult();
    }

    public function allAssessment($organization,$department,$user)
    {
        $query=$this->model()
            ->join('users as u','u.id','=','assessment_results.user_id')
            ->leftJoin('department_user as du',function($leftJoin) use($department) {
                $leftJoin->on('assessment_results.user_id','=','du.user_id')
                    ->where('du.department_id',empty($department) ? '!=':'=',empty($department) ? null : $department);
            })
            ->join('organization_user as ou','ou.user_id','=','assessment_results.user_id')
            ->leftJoin('departments as dep','du.department_id','=','dep.id')
            ->join('organizations as org','org.id','=','ou.organization_id')
            ->where('ou.organization_id',empty($organization) ? '!=':'=',empty($organization) ? null : $organization )
            ->where('u.id',empty($user) ? '!=':'=',empty($user) ? null : $user )
            ->select([
                'assessment_results.*',
                'u.id as user_id',
                'u.first_name',
                'u.last_name',
                'u.avatar',
                'dep.name as department_name',
                ])
            ->distinct()->orderBy('u.first_name')->get();;

        return $query;
    }
}