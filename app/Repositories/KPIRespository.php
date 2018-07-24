<?php

namespace App\Repositories;

use App\Models\KpiChart;
use App\Repositories\Contracts\KPIRepositoryInterface;
use Illuminate\Support\Collection;

class KPIRespository extends BaseRepository //implements KPIRepositoryInterface
{

    public function model()
    {
        return new KpiChart();
    }

    public function allKpi($project,$organization)
    {
        $query=$this->model()
            ->join('projects as p','p.id','kpi_charts.project_id')
            ->where('kpi_charts.project_id',empty($project) ? '!=':'=',empty($project) ? null : $project)
            ->where('p.organization_id',empty($organization) ? '!=':'=',empty($organization) ? null : $organization)
            ->select('kpi_charts.*')->get();
        return $query;
    }
}