<?php

namespace App\Repositories;

use App\Models\Award;
use App\Models\Employee;
use App\Models\Organization;
use App\Repositories\Contracts\AwardRepositoryInterface;
use Illuminate\Support\Collection;

class AwardRepository extends BaseRepository //implements AwardRepositoryInterface
{

    public function model()
    {
        return new Award();
    }

    public function getAwards($organization,$department,$user){
        $query=$this->model()->join('users as u','u.id','=','awards.user_id')
            ->join('organization_user as ou','ou.user_id','=','awards.user_id')
            ->leftJoin('department_user as du',function($leftJoin) use($department) {
                $leftJoin->on('awards.user_id','=','du.user_id')
                    ->where('du.organization_id',empty($department)? '!=' : '=',empty($department) ? null : $department);
            })
            ->leftJoin('departments as dep','du.department_id','=','dep.id')
            ->where('ou.organization_id',empty($organization)? '!=' : '=',empty($organization) ? null : $organization)
            ->where('u.id',empty($user)? '!=' : '=',empty($user) ? null : $user)
            ->select(['awards.*','u.first_name','u.last_name','u.avatar','dep.name as department_name'])
            ->distinct()->orderBy('u.first_name')->get();
        return $query;
    }
}