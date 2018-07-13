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
            if($organization){
//                $invoice=Invoice::retrieve()
                $data=array_merge($subscription->toArray(),['name'=>$organization->name]);
                Mail::to($organization->email)->send(new SubscriptionMail($data));
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
