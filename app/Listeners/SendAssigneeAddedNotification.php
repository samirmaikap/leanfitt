<?php

namespace App\Listeners;

use App\Events\AssigneeAdded;
use App\Mail\AssigneeAddedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
        $actionItem = $event->actionItem;

        Mail::to($actionItem->assignor->email)->send(new AssigneeAddedMail($actionItem));
    }
}
