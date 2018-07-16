<?php

namespace App\Observers;

use App\Models\Report;

class ReportObserver
{
    /**
     * Handle to the report "created" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function created(Report $report)
    {
        //
    }

    /**
     * Handle the report "updated" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function updated(Report $report)
    {
        //
    }

    /**
     * Handle the report "deleted" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function deleted(Report $report)
    {
        //
    }
}
