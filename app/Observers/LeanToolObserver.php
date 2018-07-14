<?php

namespace App\Observers;

use App\Models\LeanTool;
use App\Notifications\PushNotification;

class LeanToolObserver
{
    /**
     * Handle to the lean tool "created" event.
     *
     * @param  \App\Models\LeanTool  $leanTool
     * @return void
     */
    public function created(LeanTool $leanTool)
    {
        $data['notification']='A new leantool has been added';
        $data['users']='all';
        $data['title']='New Leantool Added';
        event(New PushNotification($data));
    }
}
