<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return new User();
    }


    public function profile($user){
        $query=$this->model()->with(['employee.department','admin.organizationAdmin.organization'])->withCount('quiz')->withCount('award')->withCount('assignee')->where('id',$user)->first();
        return $query;
    }

    public function isMemberOf($subdomain)
    {

    }

    public function getUsersByOrganization($organizationId, $with)
    {
        return $this->model->with($with)->whereHas('organizations' , function($query) use ($organizationId) {
            $query->where('organizations.id', '=', $organizationId );
        })->get();
    }

    /*Added by samir 7/10*/
    public function getEmployees()
    {
        $query=$this->model()
            ->join('department_user as du','du.user_id','=','users.id')
            ->join('departments as dep','dep.id','=','du.department_id')
            ->select(['users.*','dep.organization_id','dep.name as department_name']);
        return $query;
    }

    public function getAdmin($organization_id)
    {
        $query=$this->model()
            ->join('organization_user as ou','ou.user_id','=','users.id')
            ->leftJoin('departments as dep','ou.organization_id','=','dep.organization_id')
            ->where('ou.organization_id',$organization_id)
            ->select(['users.*','dep.organization_id','dep.name as department_name'])->first();
        return $query;
    }

    public function logResponse($user_id){
        $query=$this->model()->with(['organizations'=>function($query){
            $query->select(['organizations.id','name','featured_image','subdomain']);
        },'roles.permissions'])->find($user_id);

        return $query;
    }
}