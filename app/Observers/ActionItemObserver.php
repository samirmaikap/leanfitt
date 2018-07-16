<?php

namespace App\Observers;

use App\Events\PushNotification;
use App\Models\ActionItems;

class ActionItemObserver
{
    /**
     * Handle to the action items "created" event.
     *
     * @param  \App\Models\ActionItems  $actionItems
     * @return void
     */
    public function created(ActionItems $actionItems)
    {
        $ids=$actionItems->project()->member()->pluck('user_id')->toArray();
        $data['title']='New action item';
        $data['notification']=$actionItems->name." has been added";
        $data['users']=$ids;
        event(new PushNotification($data));
    }

    /**
     * Handle the action items "updated" event.
     *
     * @param  \App\Models\ActionItems  $actionItems
     * @return void
     */
    public function updated(ActionItems $actionItems)
    {
        $ids=$actionItems->project()->member()->pluck('user_id')->toArray();
        $data['title']='Action item updated';
        $data['notification']=$actionItems->name." has been updated";
        $data['users']=$ids;
        event(new PushNotification($data));
    }

    /**
     * Handle the action items "deleted" event.
     *
     * @param  \App\Models\ActionItems  $actionItems
     * @return void
     */
    public function deleted(ActionItems $actionItems)
    {
        //
    }
}
