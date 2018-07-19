<?php

namespace App\Observers;

use App\Events\OrganizationCreated;
use App\Models\Organization;

class OrganizationObserver
{
    /**
     * Handle to the organization "created" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function created(Organization $organization)
    {
        event(new OrganizationCreated($organization));
    }

    /**
     * Handle the organization "updated" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function updated(Organization $organization)
    {
        //
    }

    /**
     * Handle the organization "deleted" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function deleted(Organization $organization)
    {
        //
    }
}
