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
        $query=$this->model()->with(['organizations','subscriptions'])->withCount('quiz')->withCount('award')->withCount('assignee')->where('id',$user)->first();
        return $query;
    }

    public function isMemberOf($subdomain)
    {

    }

    public function getUsersByOrganization($organizationId, $with)
    {
        return $this->model()->with($with)->whereHas('organizations' , function($query) use ($organizationId) {
            $query->where('organizations.id', '=', $organizationId );
        })->get();
    }

    public function logResponse($user_id){
        $query=$this->model()->with(['organizations'=>function($query){
            $query->select(['organizations.id','name','featured_image','subdomain']);
        },'roles.permissions'])->find($user_id);

        return $query;
    }

    public function getRelated($user_id){
        $query=$this->model()->join('organization_user as ou','ou.user_id','users.id')
            ->join('organizations as o','o.id','=','ou.organization_id')
            ->where('users.id',$user_id)
            ->select(['o.id','o.name','o.featured_image','o.subdomain'])->get();
        return $query;
    }


    public function getUsers($organization,$department){
        $query=$this->model()->join('organization_user as ou','ou.user_id','users.id')
            ->leftJoin('department_user as du','users.id','=','du.user_id')
            ->where('du.department_id',$department )
            ->where('ou.organization_id',empty($organization) ? '!=' : '=',empty($organization) ? null : $organization )
            ->select(['users.id','users.first_name','users.last_name','users.phone','users.avatar','users.email','users.created_at','ou.is_invited','ou.is_suspended'])->distinct()->orderBy('users.first_name')->get();
        return $query;
    }
}