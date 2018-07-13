<?php

namespace App\Repositories;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Support\Collection;

class DepartmentRepository extends BaseRepository //implements DepartmentRepositoryInterface
{

    public function model(){
        return new Department();
    }

    public function getDepartments($organization){
        $query=$this->model()->where('organization_id',empty($organization) ? '!=' : '=',empty($organization) ? null : $organization)->get(['id','name']);
        return $query;
    }
}