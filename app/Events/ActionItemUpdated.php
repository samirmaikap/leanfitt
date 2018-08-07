<?php

namespace App\Events;

use App\Models\ActionItem;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ActionItemUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actionItem;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ActionItem $actionItem, User $user)
    {
        $this->actionItem = $actionItem;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
