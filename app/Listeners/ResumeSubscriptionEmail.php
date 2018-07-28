<?php

namespace App\Listeners;

use App\Events\SubscriptionResumed;
use App\Jobs\SendSubscriptionResumedMail;
use App\Mail\ResumeSubscriptionMail;
use App\Models\Subscription;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ResumeSubscriptionEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  SubscriptionResumed  $event
     * @return void
     */
    public function handle(SubscriptionResumed $event)
    {
        $data=$event->data;
        $subscripton=Subscription::where('organization_id',$data->id)->first();
        $mail['contact_person']=$data->contact_person;
        $mail['ends_at']=$subscripton->ends_at;
        $mail['email']=$data->email;
        SendSubscriptionResumedMail::dispatch($mail)->onQueue('emails');
        Log::info('Dispacthed');
    }
}
