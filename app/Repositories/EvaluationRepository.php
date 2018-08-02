<?php

namespace App\Repositories;


use App\Models\Evaluation;

class EvaluationRepository extends BaseRepository
{
    public function model()
    {
        return new Evaluation();
    }

    public function getEvaluation($org_users){
        return $this->model()->join('organization_user as ou','ou.id','=','evaluations.organization_user_id')
            ->join('organizations as o','o.id','=','ou.organization_id')
            ->select('o.name as organization_name','evaluations.*')
            ->whereIn('evaluations.organization_user_id',$org_users)
            ->get()
            ->groupBy('organization_name');
    }
}