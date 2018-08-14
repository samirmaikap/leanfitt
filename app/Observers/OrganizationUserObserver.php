<?php

namespace App\Observers;

use App\Mail\InvitationMail;
use App\Models\User;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrganizationUserObserver
{
    /**
     * Handle to the organization user "created" event.
     *
     * @param  \App\Models\OrganizationUser  $organizationUser
     * @return void
     */
    public function created(OrganizationUser $organizationUser)
    {
        $orgUser=OrganizationUser::where('id',$organizationUser->id)->with(['user','organization'])->first();
        $data['token']=$organizationUser->invitation_token;
        $data['first_name']= $orgUser->user->first_name;
        $data['email']= $orgUser->user->email;
        $data['organization']=$orgUser->organization->name;
        Log::info($data['organization']);
        Mail::to($orgUser->user->email)->send(new InvitationMail($data));
    }
}
