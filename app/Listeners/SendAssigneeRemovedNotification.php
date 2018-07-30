<?php

namespace App\Listeners;

use App\Events\AssigneeRemoved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAssigneeRemovedNotification
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
     * @param  AssigneeRemoved  $event
     * @return void
     */
    public function handle(AssigneeRemoved $event)
    {
        //
    }
}
