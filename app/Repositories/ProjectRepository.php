<?php

namespace App\Repositories;

use App\Models\ActionItem;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProjectRepository extends BaseRepository //implements ProjectRepositoryInterface
{

    public function model()
    {
        return new Project();
    }

    public function allProject($organization,$department,$user)
    {
        $query = $this->model()
            ->leftJoin('project_members as mem','projects.id','=','mem.project_id')
            ->leftJoin('department_user as du','mem.user_id','=','du.user_id')
            ->where('projects.organization_id', $organization);
        if(!empty($user)){
            $query=$query->where('mem.user_id',$user);
        }

        if(!empty($department)){
            $query=$query->where('du.department_id',$department);
        }
        $query=$query->select(['projects.*'])
            ->withCount('members')
            ->withCount('attachments')
            ->withCount('comments')
            ->with('owner')
            ->distinct()
            ->get();
        return $query;
    }

    public function getProject($project_id)
    {
        $query = $this->model()
            ->with([
                'members.user',
                'comments.user' => function ($query) {
                    return $query->orderBy('created_at', 'DESC');
                },
                'attachments',
                'boards.processes.actionItems' => function ($query) {
                    return $query->with([
                        'assignor',
                        'attachments',
                        'comments.user' => function ($query) {
                            return $query->orderBy('created_at', 'DESC');
                        }])->orderBy('position', 'ASC');
                },'owner'])
            ->where('id', $project_id)
            ->first();
        return $query;
    }

    public function getMembers($project_id)
    {
        $query = $this->model()
            ->join('organization_user as ou', 'ou.organization_id', '=', 'projects.organization_id')
            ->join('users as u', 'u.id', '=', 'ou.user_id')
            ->where('projects.id', $project_id)
            ->select('u.avatar', 'u.id', 'u.first_name', 'u.last_name')
            ->distinct()->get();
        return $query;
    }

    public function getTangibles($organization,$user){
        $query=$this->model()->with(['tangibleIntangible'=>function($query){
            $query->where('type','tangible')->get();
        }])->where('organization_id',empty($organization) ? '!=' : '=', empty($organization) ? null : $organization );

        if(!empty($user)){
            $query=$query->whereHas('members',function ($query) use($user) {
                $query->where('user_id', $user);
            });
        }
        return $query->get();
    }
}