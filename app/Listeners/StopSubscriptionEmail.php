<?php

namespace App\Listeners;

use App\Events\SubscriptionStopped;
use App\Jobs\SendSubscriptionStoppedMail;
use App\Mail\StopSubscriptionMail;
use App\Models\Subscription;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class StopSubscriptionEmail
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
     * @param  SubscriptionStopped  $event
     * @return void
     */
    public function handle(SubscriptionStopped $event)
    {
        $data=$event->data;
        $subscripton=Subscription::where('organization_id',$data->id)->first();
        $mail['contact_person']=$data->contact_person;
        $mail['ends_at']=$subscripton->ends_at;
        $mail['email']=$data->email;
        SendSubscriptionStoppedMail::dispatch($mail)->onQueue('emails');
    }
}
