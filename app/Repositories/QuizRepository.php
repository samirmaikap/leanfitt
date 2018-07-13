<?php

namespace App\Repositories;

use App\Models\QuizResult;
use App\Repositories\Contracts\QuizRepositoryInterface;

class QuizRepository extends BaseRepository //implements QuizRepositoryInterface
{

    public function model()
    {
        return new QuizResult();
    }

    public function allTaken($organization,$department,$user)
    {
        $query=$this->model()->join('users as u','u.id','=','quiz_results.user_id')
            ->join('department_user as du','du.user_id','=','quiz_results.user_id')
            ->join('organization_user as ou','ou.user_id','=','quiz_results.user_id')
            ->join('departments as dep','dep.id','=','du.department_id')
            ->join('organizations as org','org.id','=','ou.organization_id')
            ->join('lean_tools as lt','lt.id','=','quiz_results.lean_tool_id')
            ->where('ou.organization_id',empty($organization) ? '!=':'=',empty($organization) ? null : $organization )
            ->where('du.department_id',empty($department) ? '!=':'=',empty($department) ? null : $department )
            ->where('u.id',empty($user) ? '!=':'=',empty($user) ? null : $user )
            ->select(['u.first_name','u.last_name','u.avatar','quiz_results.*','lt.name as tool_name','dep.name as department_name'])
            ->distinct()->orderBy('u.first_name')->get();
        return $query;
    }
}