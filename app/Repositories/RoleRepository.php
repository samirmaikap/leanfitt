<?php

namespace App\Repositories;


// use Spatie\Permission\Models\Role;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return new Role();
    }

    public function currentRoles($organization,$user){
        return $this->model()->join('role_user as ru','ru.role_id','=','roles.id')
            ->join('organization_role as or','or.role_id','=','roles.id')
            ->select(['roles.name'])
            ->where('or.organization_id',$organization)
            ->where('ru.user_id',$user)
            ->distinct()
            ->get();
    }
}