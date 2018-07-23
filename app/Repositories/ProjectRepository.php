<?php

namespace App\Repositories;

use App\Models\ActionItem;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectRepository extends BaseRepository //implements ProjectRepositoryInterface
{

    public function model()
    {
        return new Project();
    }

    public function allProject($organization)
    {
        $query=$this->model()->withCount('member')->withCount('attachments')->withCount('comments')->where('organization_id',$organization)->get();
        return $query;
    }

    public function getProject($project_id)
    {
        $query=$this->model()->with(['member','comments.user','attachments','boards.processes.actionItems' => function($query) {
            return $query->with(['assignor','attachments', 'comments'])->orderBy('position', 'ASC');
        }])->where('id',$project_id)->first();
        return $query;
    }

    public function getMembers($project_id){
        $query=$this->model()
            ->join('organization_user as ou','ou.organization_id','=','projects.organization_id')
            ->join('users as u','u.id','=','ou.user_id')
            ->where('projects.id',$project_id)
            ->select('u.avatar','u.id','u.first_name','u.last_name')
            ->distinct()->get();
        return $query;
    }
}