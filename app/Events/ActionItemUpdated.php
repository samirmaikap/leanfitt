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
use function json_encode;

class ActionItemUpdated
{
    use SerializesModels;

    public $actionItem;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ActionItem $actionItem, $user)
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
//        return new PrivateChannel('action-item');
        return new Channel('action-items');
//        return new PrivateChannel('action-item-' . $this->actionItem->id);
    }
}
