<?php

namespace App\Repositories;


use App\Models\Evaluation;

class EvaluationRepository extends BaseRepository
{
    public function model()
    {
        return new Evaluation();
    }

    public function getEvaluation($org_users,$user=null,$evaluator=null){
        $query= $this->model()->join('organization_user as ou','ou.id','=','evaluations.organization_user_id')
            ->join('organizations as o','o.id','=','ou.organization_id')
            ->select('o.name as organization_name','evaluations.*')
            ->whereIn('evaluations.organization_user_id',$org_users);
            if(!empty($user)){
                $query=$query->where('ou.user_id',$user);
            }

            if(!empty($evaluator)){
                $query=$query->where('evaluations.evaluated_by',$evaluator);
            }
            return $query->with('evaluator')->get();
    }

    public function getEvaluators($organization){
        $query= $this->model()->join('organization_user as ou','ou.id','=','evaluations.organization_user_id')
            ->join('users as u','u.id','=','evaluations.evaluated_by')
            ->where('ou.organization_id',$organization)
            ->select(['u.first_name','u.last_name','u.id'])
            ->distinct()
            ->get();
        return $query;
    }
}