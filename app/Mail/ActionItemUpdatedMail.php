<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActionItemUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $actionItem;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($actionItem, $user)
    {
        $this->actionItem = $actionItem;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Action Item Updated")->view('emails.action-items.updated');
    }
}
