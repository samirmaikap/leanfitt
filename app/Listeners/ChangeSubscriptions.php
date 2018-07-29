<?php

namespace App\Listeners;

use App\Events\NotifySubscriptions;
use App\Events\UsersUpdated;
use App\Jobs\ProcessUpdateSubscription;
use App\Mail\SubscriptionMail;
use App\Models\Organization;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ChangeSubscriptions
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
     * @param  UsersUpdated  $event
     * @return void
     */
    public function handle(UsersUpdated $event)
    {
        try{
            $organization=Organization::withCount(['organizationUsers'=>function($query){
                $query->where('is_invited',0)->where('is_suspended',0);
            }])->find($event->data['organization_id']);
            ProcessUpdateSubscription::dispatch($organization)->onQueue('subscription');
        }catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
