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
        $query=$this->model()->with(['member.user','activity.user','comments.user','attachments'])->where('id',$project_id)->first();
        return $query;
    }

}