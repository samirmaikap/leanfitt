<?php

namespace App\Observers;

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
        //
    }

    /**
     * Handle the action items "updated" event.
     *
     * @param  \App\Models\ActionItems  $actionItems
     * @return void
     */
    public function updated(ActionItems $actionItems)
    {
        //
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
