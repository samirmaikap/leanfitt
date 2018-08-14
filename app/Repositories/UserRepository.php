<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository //implements UserRepositoryInterface
{
    public function model()
    {
        return new User();
    }


    public function profile($user,$organization){
        $query=$this->model()
            ->with(['roles' => function($query) use($organization) {
                if(!empty($organization))
                {
                    $query = $query->join('organization_role', function ($join) use($organization){
                        $join->on('organization_role.role_id', '=', 'roles.id')
                            ->where('organization_role.organization_id', '=', $organization);
                    });
                }
                return $query;
            }])
            ->with(['departments'=>function($query) use($organization){
            if(!empty($organization)){
                $query->where('organization_id',$organization)->get();
            }
        }])->where('id',$user)->first();
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


    public function getUsers($organization = null, $department = null, $role = null){
        $query = $this->model()
//            ->with(['roles', function($query) use($organization) {
//                if(!empty($organization))
//                {
//                    $query = $query->join('organization_role', function ($join) use($organization){
//                        $join->on('organization_role.role_id', '=', 'roles.id')
//                            ->where('organization_role.organization_id', '=', $organization);
//                    });
//                }
//                return $query;
//            }])
            ->join('organization_user as ou','ou.user_id','users.id')
            ->leftJoin('department_user as du','users.id','=','du.user_id')
            ->leftjoin('organization_role as or','ou.organization_id','=','or.organization_id')
            ->leftjoin('role_user as ru','or.role_id','=','ru.role_id')
            ->leftjoin('roles as r','ru.role_id','=','r.id')
            ->where('ou.organization_id',empty($organization) ? '!=' : '=',empty($organization) ? null : $organization );

        if(!empty($department)){
            $query=$query->where('du.department_id',$department);
        }

        if(!empty($role)){
            $query=$query->where('r.id',$role);
        }

        $result=$query->select([DB::raw('
        count(r.id) as roles_count,
        max(users.first_name) as first_name,
        max(users.last_name) as last_name,
        max(users.email) as email,
        max(users.phone) as phone,
        max(users.avatar) as avatar,
        max(users.created_at) as created_at,
        max(users.id) as id,
        max(ou.is_suspended) as is_suspended,
        max(ou.is_invited) as is_invited
        ')])
            ->distinct()
            ->groupBy('users.id')
            ->get();
        return $result;
    }

    function userList($organization,$department){
        $query = $this->model()->join('organization_user as ou','ou.user_id','users.id')
            ->leftJoin('department_user as du','users.id','=','du.user_id')
            ->where('ou.organization_id',empty($organization) ? '!=' : '=',empty($organization) ? null : $organization );

        if(!empty($department)){
            $query=$query->where('du.department_id',$department);
        }

        $query=$query->select(['users.id','users.first_name','users.last_name'])
            ->distinct()
            ->orderBy('users.first_name')->get();
        return $query;
    }
}
