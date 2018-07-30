<?php

namespace App\Listeners;

use App\Events\ActionItemUpdated;
use App\Mail\ActionItemUpdatedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendActionItemUpdatedNotification
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
     * @param  ActionItemUpdated  $event
     * @return void
     */
    public function handle(ActionItemUpdated $event)
    {
        $actionItem = $event->actionItem;

        foreach ($actionItem->assignees as $assignee)
        {
            Mail::to($assignee->user->email)->send(new ActionItemUpdatedMail($actionItem));
        }
    }
}
