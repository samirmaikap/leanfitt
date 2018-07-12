<?php

namespace App\Repositories;


use App\Models\AssessmentResult;
use App\Repositories\Contracts\AssessmentRepositoryInterface;

class AssessmentRepository extends BaseRepository implements AssessmentRepositoryInterface
{
    public function model()
    {
        return new AssessmentResult();
    }

    public function allAssessment()
    {
        $query=$this->model()
            ->join('users as u','u.id','=','assessment_results.user_id')
            ->join('department_user as du','du.user_id','=','du.user_id')
            ->join('departments as dep','dep.id','=','du.department_id')
            ->select([
                'assessment_results.*',
                'u.id as user_id',
                'u.first_name as employee_first_name',
                'u.last_name as employee_last_name',
                'u.avatar as employee_avatar',
                'dep.id as department_id',
                'dep.name as depart_name',
                'dep.organization_id'
                ]);

        return $query;
    }
}