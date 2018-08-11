<?php

namespace App\Observers;

use App\Events\ProjectMemberUpdated;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\Log;

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
        $member=ProjectMember::where('id',$projectMember->id)->with(['project','user'])->first();
        $data['first_name']=$member->user->first_name;
        $data['project']=$member->project->name;
        $data['project_id']=$member->project->id;
        $data['type']='added';
        $data['email']=$member->user->email;
        Log::info('Member Observer added');
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
//    public function deleted(ProjectMember $projectMember)
//    {
//        $member=ProjectMember::where('id',$projectMember->id)->with(['project','user'])->first();
//        Log::info($member->id);
//        $data['first_name']=$member->user->first_name;
//        $data['project']=$member->project->name;
//        $data['project_id']=$member->project->id;
//        $data['type']='deleted';
//        $data['email']=$member->user->email;
//        Log::info('Member Observer deleted');
//        event(new ProjectMemberUpdated($data));
//    }
}
