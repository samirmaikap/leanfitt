<?php

namespace App\Listeners;

use App\Events\NotifySubscriptions;
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
                $customer=$organization->asStripeCustomer();
                $data['currency']=$customer->currency;
                $data['contact_person']=$organization->contact_person;
                $data['organization_name']=$organization->name;
                $data['card_end']=$customer['sources']->data[0]['last4'];
                $data['billing']=$customer['subscriptions']->data[0]['billing'];
                $data['current_period_end']=$customer['subscriptions']->data[0]['current_period_end'];
                $data['plan_name']=$customer['subscriptions']->data[0]['plan']->id;
                $data['quantity']=$customer['subscriptions']->data[0]['quantity'];
                $data['amount']=$data['quantity']*($customer['subscriptions']->data[0]['plan']->amount);
                $data['status']=$customer['subscriptions']->data[0]['status'];
                Mail::to($organization->email)->send(new SubscriptionMail($data));
                Log::info('Email send');
            }
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }

    }
}
