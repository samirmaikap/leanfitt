<?php

namespace App\Providers;

use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\User;
use App\Observers\OrganizationObserver;
use App\Observers\OrganizationUserObserver;
use App\Observers\ProjectObserver;
use App\Observers\SubscriptionObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Organization::observe(OrganizationObserver::class);
        Project::observe(ProjectObserver::class);
        OrganizationUser::observe(OrganizationUserObserver::class);
        Subscription::observe(SubscriptionObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
