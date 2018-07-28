<?php

namespace App\Jobs;

use App\Events\NotifySubscriptions;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessUpdateSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $organization;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($organization)
    {
        $this->organization=$organization;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->organization->subscription('main')->updateQuantity($this->organization->organization_users_count);
        $data['organization_id']=$this->organization->id;
        event(new NotifySubscriptions($data));
    }
}
