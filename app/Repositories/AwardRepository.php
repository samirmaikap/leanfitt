<?php

namespace App\Repositories;

use App\Models\Award;
use App\Models\Employee;
use App\Models\Organization;
use App\Repositories\Contracts\AwardRepositoryInterface;
use Illuminate\Support\Collection;

class AwardRepository extends BaseRepository implements AwardRepositoryInterface
{

    public function model()
    {
        return new Award();
    }

    public function getAwards(){
        $query=$this->model()->join('users as u','u.id','=','awards.user_id')
            ->join('department_user as du','du.user_id','=','awards.user_id')
            ->join('departments as dep','dep.id','=','du.department_id')
            ->select(['awards.*','u.id as user_id','u.first_name','u.last_name','u.avatar','dep.id as department_id','dep.organization_id']);
        return $query;
    }
}