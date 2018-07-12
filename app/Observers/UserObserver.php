<?php

namespace App\Observers;

use App\Mail\DeactivationMail;
use App\Mail\SignupMail;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle to the user "created" event.
     *
     * @param $user
     * @return void
     */
    public function created($user)
    {
        if(!empty($user))
            Mail::to($user->email)->send(new SignupMail($user->toArray()));

    }

    /**
     * Handle the user "deleted" event.
     *
     * @param $user
     * @return void
     */
    public function deleted($user)
    {
        if(!empty($user))
            Mail::to($user->email)->send(new DeactivationMail($user->toArray()));
    }
}
