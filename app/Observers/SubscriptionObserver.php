<?php

namespace App\Observers;

use App\Mail\SubscriptionMail;
use App\Models\Organization;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use Stripe\Invoice;

class SubscriptionObserver
{
    /**
     * Handle to the subscription "created" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function created(Subscription $subscription)
    {
        if(!empty($subscription)){
            $organization=Organization::find($subscription->organization_id);
            $customer=$organization->asStripeCustomer();
            $data['currency']=$customer->currency;
            $data['contact_person']=$organization->contact_person;
            $data['organization_name']=$organization->name;
            $data['card_end']=$customer['sources']->data[0]['last4'];
            $data['billing']=$customer['subscriptions']->data[0]['billing'];
            $data['current_period_end']=$customer['subscriptions']->data[0]['current_period_end'];
            $data['plan_name']=$customer['subscriptions']->data[0]['plan']->id;
            $data['amount']=$customer['subscriptions']->data[0]['plan']->amount;
            $data['quantity']=$customer['subscriptions']->data[0]['quantity'];
            $data['status']=$customer['subscriptions']->data[0]['status'];
            if($organization){
                Mail::to($customer->email)->send(new SubscriptionMail($data));
            }
        }

    }

    /**
     * Handle the subscription "updated" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function updated(Subscription $subscription)
    {
        //
    }

    /**
     * Handle the subscription "deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function deleted(Subscription $subscription)
    {
        //
    }
}
