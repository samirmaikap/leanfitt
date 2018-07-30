<?php

namespace App\Listeners;

use App\Events\AssigneeAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAssigneeAddedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AssigneeAdded  $event
     * @return void
     */
    public function handle(AssigneeAdded $event)
    {
        //
    }
}
