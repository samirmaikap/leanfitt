<?php

namespace App\Listeners;

use App\Events\ProjectMemberUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class AlertMember
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
     * @param  ProjectMemberUpdated  $event
     * @return void
     */
    public function handle(ProjectMemberUpdated $event)
    {
        $data=$event->data;
        Mail::to($data['email'])->send(new AlertMember($data));
    }
}
