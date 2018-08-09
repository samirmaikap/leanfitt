<?php

namespace App\Listeners;

use App\Events\OrganizationInvited;
use App\Mail\SendOrganizationInvitation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class AlertOrganization
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
     * @param  OrganizationInvited  $event
     * @return void
     */
    public function handle(OrganizationInvited $event)
    {
        $data=$event->data;
        Mail::to($data['email'])->send(new SendOrganizationInvitation($data));
    }
}
