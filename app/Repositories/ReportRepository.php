<?php

namespace App\Repositories;

use App\Models\Report;
use App\Repositories\Contracts\ReportRepositoryInterface;

class ReportRepository extends BaseRepository //implements ReportRepositoryInterface
{
    public function model()
    {
        return new Report();
    }

    public function allReports($organization,$project){
        return $this->model()->join('projects as p','p.id','=','reports.project_id')
            ->join('report_categories as cat','cat.id','reports.report_category_id')
            ->where('p.organization_id',empty($organization) ? '!=':'=',empty($organization) ? null : $organization)
            ->where('p.id',empty($project) ? '!=':'=',empty($project) ? null : $project)
            ->select(['reports.*','p.organization_id','p.name as project_name','p.report_date','cat.name as report_category'])->get();
    }

    public function showReport($report_id)
    {
        return $this->model()->join('projects as p','p.id','=','reports.project_id')
            ->join('report_categories as cat','cat.id','reports.report_category_id')
            ->where('reports.id',$report_id)
            ->select([
                'reports.*',
                'cat.name as report_name',
                'p.organization_id',
                'p.id as project_id',
                'p.name as project_name',
                'p.report_date',
                'p.start_date',
                'p.end_date',
            ])->first();
    }

    public function getCategory($report_id)
    {
        $query=$this->model()->find($report_id);
        return count($query) > 0 ? $query->report_category_id : null;
    }
}