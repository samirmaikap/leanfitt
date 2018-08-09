<?php

namespace App\Observers;

use App\Events\ProjectMemberUpdated;
use App\Models\ProjectMember;

class ProjectMemberObserver
{
    /**
     * Handle to the project member "created" event.
     *
     * @param  \App\Models\ProjectMember  $projectMember
     * @return void
     */
    public function created(ProjectMember $projectMember)
    {
        $member=ProjectMember::where('id',$projectMember->id)->with(['projects','user'])->first();
        $data['first_name']=$member->user->first_name;
        $data['project']=$member->projects->name;
        $data['project_id']=$member->projects->id;
        $data['type']='added';
        event(new ProjectMemberUpdated($data));
    }

    /**
     * Handle the project member "updated" event.
     *
     * @param  \App\Models\ProjectMember  $projectMember
     * @return void
     */
    public function updated(ProjectMember $projectMember)
    {
        //
    }

    /**
     * Handle the project member "deleted" event.
     *
     * @param  \App\Models\ProjectMember  $projectMember
     * @return void
     */
    public function deleted(ProjectMember $projectMember)
    {
        $member=ProjectMember::where('id',$projectMember->id)->with(['projects','user'])->first();
        $data['first_name']=$member->user->first_name;
        $data['project']=$member->projects->name;
        $data['project_id']=$member->projects->id;
        $data['type']='deleted';
        $data['email']=$member->user->email;
        event(new ProjectMemberUpdated($data));
    }
}
