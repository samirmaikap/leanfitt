<?php

namespace App\Repositories;


use App\Models\ReportDefaultAssignment;
use App\Repositories\Contracts\ReportDefaultAssignemntRepositoryInterface;

class ReportDefaultAssignmentRepository extends BaseRepository //implements ReportDefaultAssignemntRepositoryInterface
{
    public function model()
    {
        return new ReportDefaultAssignment();
    }

    public function getAssignments($report_id,$level)
    {
        $query=$this->model()
            ->join('report_defaults as rd','rd.id','=','report_default_assignments.report_default_id')
            ->where('report_default_assignments.report_id',$report_id)
            ->where('report_default_assignments.level',$level)
            ->select(['report_default_assignments.id','report_default_assignments.level','rd.label'])
            ->get();
        return $query;
    }
}