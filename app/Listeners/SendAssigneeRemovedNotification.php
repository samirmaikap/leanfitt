<?php

namespace App\Listeners;

use App\Events\AssigneeRemoved;
use App\Mail\AssigneeRemovedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
        $actionItem = $event->actionItem;
        $assignee = $event->assignee;
        $user = $event->user;

        Mail::to($assignee->email)->send(new AssigneeRemovedMail($actionItem, $assignee, $user));
    }
}
