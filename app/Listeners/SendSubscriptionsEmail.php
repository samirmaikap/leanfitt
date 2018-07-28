<?php

namespace App\Listeners;

use App\Events\NotifySubscriptions;
use App\Jobs\SendSubscriptionMail;
use App\Mail\SubscriptionMail;
use App\Models\Organization;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionsEmail
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
     * @param  NotifySubscriptions  $event
     * @return void
     */
    public function handle(NotifySubscriptions $event)
    {
        try{
            $organization=Organization::find($event->data['organization_id']);
            if($organization){
                $invoice=$organization->invoices()->first();
                $data['contact_person']=$organization->contact_person;
                $data['organization_name']=$organization->name;
                $data['invoice']=isset($invoice->invoice_pdf) ? $invoice->invoice_pdf : null;
                $data['email']=$organization->email;
                SendSubscriptionMail::dispatch($data)->onQueue('emails');
                Log::info($data['invoice']);
            }
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }

    }
}
