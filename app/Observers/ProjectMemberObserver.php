<?php

namespace App\Observers;

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
        //
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
        //
    }
}
