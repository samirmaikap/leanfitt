<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssigneeRemovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $actionItem;
    public $assignee;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($actionItem, $assginee, $user)
    {
        $this->actionItem = $actionItem;
        $this->assignee = $assginee;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.action-items.removed');
    }
}
