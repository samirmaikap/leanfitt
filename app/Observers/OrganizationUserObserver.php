<?php

namespace App\Observers;

use App\Mail\InvitationMail;
use App\Models\User;
use App\OrganizationUser;
use Illuminate\Support\Facades\Mail;

class OrganizationUserObserver
{
    /**
     * Handle to the organization user "created" event.
     *
     * @param  \App\OrganizationUser  $organizationUser
     * @return void
     */
    public function created(OrganizationUser $organizationUser)
    {
        $user=User::find($organizationUser->user_id);
        $data['token']=$organizationUser->invitation_token;
        $data['first_name']=$user->first_name;
        Mail::to($user->email)->send(new InvitationMail($data));
    }

    /**
     * Handle the organization user "updated" event.
     *
     * @param  \App\OrganizationUser  $organizationUser
     * @return void
     */
    public function updated(OrganizationUser $organizationUser)
    {
        $user=User::find($organizationUser->user_id);
        $data['token']=$organizationUser->invitation_token;
        $data['first_name']=$user->first_name;
        Mail::to($user->email)->send(new InvitationMail($data));
    }

}
