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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($actionItem)
    {
        $this->actionItem = $actionItem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Action Item Updated")->view('emails.action-item-updated');
    }
}
