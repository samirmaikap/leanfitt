<?php
namespace App\Repositories;


use App\Models\ProjectMember;
use Illuminate\Support\Facades\DB;

class ProjectMemberRepository extends BaseRepository
{
    public function model()
    {
       return new ProjectMember();
    }

    public function allMembers($project_id){
        $query=$this->model()->join('role_user as ru','ru.user_id','project_members.user_id')
            ->join('roles as r','r.id','=','ru.role_id')
            ->join('users as u','u.id','=','ru.user_id')
            ->where('project_members.project_id',$project_id)
            ->select(['u.id','u.first_name','u.last_name','u.avatar','project_members.id as member_id','r.name as role'])
            ->distinct()
            ->get();
        return $query;
    }
}