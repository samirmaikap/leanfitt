<?php

namespace App\Repositories;

use App\Models\QuizResult;
use App\Repositories\Contracts\QuizRepositoryInterface;

class QuizRepository extends BaseRepository implements QuizRepositoryInterface
{

    public function model()
    {
        return new QuizResult();
    }

    public function allTaken()
    {
        $query=$this->model()->join('users as u','u.id','=','quiz_results.user_id')
            ->join('department_user as du','du.user_id','=','quiz_results.user_id')
            ->join('departments as dep','dep.id','=','du.department_id')
            ->join('organizations as org','org.id','=','dep.organization_id')
            ->join('lean_tools as lt','lt.id','=','quiz_results.lean_tool_id')
            ->select(['u.first_name','u.last_name','u.email','u.avatar','quiz_results.*','lt.name as tool_name','dep.id as department_id','dep.name as department_name','org.id as organization_id','org.name as organizaton_name']);

        return $query;
    }
}