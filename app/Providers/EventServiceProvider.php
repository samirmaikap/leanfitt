<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\PushNotification' => [
            'App\Listeners\SendNotification',
        ],
        'App\Events\OrganizationCreated' => [
//            'App\Listeners\SendWelcomeMail',
            'App\Listeners\SetupRolePermission',
        ],
        'App\Events\ProjectCreated' => [
            'App\Listeners\SetupDefaultBoard',
        ],
        'App\Events\UsersUpdated' => [
            'App\Listeners\ChangeSubscriptions',
        ],
        'App\Events\NotifySubscriptions' => [
            'App\Listeners\SendSubscriptionsEmail',
        ],
        'App\Events\SubscriptionStopped' => [
            'App\Listeners\StopSubscriptionEmail',
        ],
        'App\Events\SubscriptionResumed' => [
            'App\Listeners\ResumeSubscriptionEmail',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

    }
}
