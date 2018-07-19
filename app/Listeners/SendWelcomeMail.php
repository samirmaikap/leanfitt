<?php

namespace App\Listeners;

use App\Events\OrganizationCreated;
use App\Mail\WelcomeMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendWelcomeMail
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
     * @param  OrganizationCreated  $event
     * @return void
     */
    public function handle(OrganizationCreated $event)
    {
        $organization = $event->organization;

        // Log event
        Log::debug("Event: Sending welcome mail to: " . $organization->id . "=>" . $organization->name);

        // Send mail
        Mail::to($organization)->send(new WelcomeMail($organization));
    }
}
