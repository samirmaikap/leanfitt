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
            ->join('organization_user as ou','ou.user_id','=','assessment_results.user_id')
            ->join('organizations as org','org.id','=','ou.organization_id')
            ->leftJoin('department_user as du','assessment_results.user_id','=','du.user_id')
            ->where('ou.organization_id',empty($organization) ? '!=':'=',empty($organization) ? null : $organization )
            ->where('u.id',empty($user) ? '!=':'=',empty($user) ? null : $user );

        if(!empty($department)){
            $query=$query->where('du.department_id',$department);
        }

        $query=$query->select([
                'assessment_results.*',
                'u.id as user_id',
                'u.first_name',
                'u.last_name',
                'u.avatar',
            ])
            ->distinct()->orderBy('u.first_name')
            ->get();

        return $query;
    }
}