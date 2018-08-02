<?php

namespace App\Listeners;

use App\Events\OrganizationCreated;
use App\Services\RoleService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SetupRolePermission
{

    protected $roleService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Handle the event.
     *
     * @param  OrgazanitionCreated  $event
     * @return void
     */
    public function handle(OrganizationCreated $event)
    {
         // Log event
        Log::debug("Event: Setting up roles");

        $organization = $event->organization;
        Log::info($organization->name);

        if(isSuperadmin()){
            $user=$organization->users()->first();
        }
        else{
            $user= auth()->user();
        }

        if(empty($user))
            return;

        // Create an Admin role for the organization
        $data = [
            'name' => 'Admin',
            'display_name' => 'Admin',
            'description' => 'Top level user with all rights'
        ];
        $admin = $this->roleService->create($data, $organization);
        Log::debug("Event: Admin role created");

        // Assign current user to the Admin role
        $user->attachRole($admin, $organization);

        Log::debug("Event: Admin role assigned to user");
    }
}
